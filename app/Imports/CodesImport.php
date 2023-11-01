<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Code;
use Carbon\Carbon;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\File;
use chillerlan\QRCode\QRCode;

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
             '*.brand_id' => 'required|integer'
         ])->validate();

        // initial veriables
        $domain = URL::to('/'); // generate url
  
        foreach ($rows as $row) {
            $brand = Brand::find($row['brand_id']);
            $url = $domain . '/' . $brand->slug;
            if($brand)
            {
                $currentTime = time(); // time in sec
                $imageName = 'qrcode-'.$currentTime.'-'.$row['code'].'.png'; // full image name
                $imgPath = 'qrcode-'.$row['brand_id'].'/'.$imageName; // full path
                // $qrCode = QrCode::format('png')->margin(2)->size(30)->eye('square')->style('square')->errorCorrection('M')->generate($url . '/' . $row['code']); // Generate QR
                // Storage::disk('public')->put($imgPath, $qrCode); // image save
                $options = new QROptions([
                    'imageBase64' => false,
                    'outputType' => QRCode::OUTPUT_IMAGICK,
                    'eccLevel' => QRCode::ECC_M,
                    'version' => 4,
                    'scale' => 1.3228346457,
                    'returnResource' => true,
                    // 'imageTransparent' => true,
                    // 'addQuietzone' => false,
                    // 'markupLight' => 'rgba(0,0,0,0)',
                    // 'markupDark' => '#000000',
                ]);
                $qr = new QRCode($options);
    
                /** @var \Imagick */
                $img = $qr->render($url . '/' . $row['code']);
    
                $img->setImageFormat('png');
                // $img->setOption('png:compression-level', 6);
    
                // dd(storage_path("public/" . $imgPath));
                // Laravel can only display saved files
                $directoryPath = storage_path("app/public/" . 'qrcode-' . $row['brand_id']);
                File::isDirectory($directoryPath) or File::makeDirectory($directoryPath, 0777, true, true);
                $img->writeImage(str_replace("\\", '/', storage_path("app/public/" . $imgPath)));
    
                Code::create([
                    'security_no' => $row['code'],
                    'qr_path' => $imgPath,
                    'brand_id' => $row['brand_id']
                ]);
            }
        }
    }
}
