<?php

namespace App\Imports;

use App\Models\Code;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CodesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
             '*.code' => 'required|integer|max:8',
             '*.brand' => 'required'
         ])->validate();

        // initial veriables
        $domain = URL::to('/'); // generate url
        $url = $domain.'/vp';
  
        foreach ($rows as $row) {
            $currentTime = time(); // time in sec
            $imageName = 'qrcode-'.$currentTime.'-'.$row['code'].'.png'; // full image name
            $imgPath = 'qrcode-'.$row['brand'].'/'.$imageName; // full path
            $qrCode = QrCode::format('png')->margin(2)->size(30)->eye('square')->style('square')->errorCorrection('M')->generate($url . '/' . $row['code']); // Generate QR
            Storage::disk('public')->put($imgPath, $qrCode); // image save

            Code::create([
                'security_no' => $row['code'],
                'qr_path' => $imgPath,
                'brand_id' => $row['brand']
            ]);
        }
    }
}
