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
             '*.codes' => 'required',
             '*.qrs' => 'required',
         ])->validate();

        // initial veriables
        $domain = URL::to('/'); // generate url
        $url = $domain.'/vp';
  
        foreach ($rows as $row) {

            $currentTime = time(); // time in sec
            $imageName = 'qrcode-'.$currentTime.'-'.$row['codes'].'.png'; // full image name
            $date = Carbon::now()->format('Y-m-d'); // folder date
            $imgPath = 'qrcode-'.$date.'/'.$imageName; // full path
            $qrCode = QrCode::format('png')->size(100)->errorCorrection('H')->generate($url.'/'.$row['codes']); // Generate QR
            Storage::disk('public')->put($imgPath, $qrCode); // image save

            Code::create([
                'security_no' => $row['codes'],
                'qrs' => $row['qrs'],
                'qr_path' => $imgPath
            ]);
        }
    }
}
