<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CodesExport;
use App\Http\Controllers\Controller;
use App\Imports\CodesImport;
use App\Models\Brand;
use App\Models\Code;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\Output\{
    QRImage
};
use chillerlan\QRCode\QROptions;
use ZipArchive;

class CodesController extends Controller
{
    public $error;

    public function scanned_lists(Request $request)
    {
        $brands = Brand::where('status', 1)->select('name', 'id')->get();
        $brandId = null;

        if ($request->isMethod('get')) {
            $codes = Code::where("scanned", ">", 0)->orderBy('scanned', 'asc')->paginate(10)->fragment('codes');
            return view('dashboard.pages.codes.scanned_lists', compact('codes', 'brands', 'brandId'));
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'brand' => 'nullable|integer',
                "scanned_times" => "nullable|integer"
            ]);

            $brandId = $request->brand;

            $codesQuery = Code::where("scanned", ">", 0)->orderBy('scanned', 'asc');

            if($request->brand) {
                $codesQuery = $codesQuery->where("brand_id", $brandId);
            }

            if($request->scanned_times) {
                $codesQuery = $codesQuery->where("scanned", $request->scanned_times);
            }

            $codes = $codesQuery->paginate(10)->fragment('codes');
            return view('dashboard.pages.codes.scanned_lists', compact('codes', 'brands', 'brandId'));
        }
    }

    public function lists(Request $request)
    {
        $brands = Brand::where('status', 1)->select('name', 'id')->get();
        $brandId = null;

        if ($request->isMethod('get')) {
            $codes = Code::orderBy('id', 'desc')->paginate(10)->fragment('codes');
            return view('dashboard.pages.codes.lists', compact('codes', 'brands', 'brandId'));
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'brand' => 'nullable|integer',
                "scanned_times" => "nullable|integer"
            ]);

            $brandId = $request->brand;

            $codesQuery = Code::where("scanned", ">=", 0)->orderBy('scanned', 'asc');

            if($request->brand) {
                $codesQuery = $codesQuery->where("brand_id", $brandId);
            }

            if($request->scanned_times) {
                $codesQuery = $codesQuery->where("scanned", $request->scanned_times);
            }

            $codes = $codesQuery->paginate(10)->fragment('codes');
            return view('dashboard.pages.codes.lists', compact('codes', 'brands', 'brandId'));
        }
    }

    public function exportToExcel($brandId = null)
    {
        return Excel::download(new CodesExport($brandId), 'exported-data.csv');
    }

    public function generate(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('dashboard.pages.codes.generate');
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls,csv,txt'
            ]);

            set_time_limit(5000);
            ini_set('memory_limit', -1);
            DB::beginTransaction();

            try {
                set_time_limit(0);
                Excel::import(new CodesImport, $request->file('file'));
                DB::commit();
                return redirect()->route('admin.code.lists')->with('success', 'File imported successfully');
            } catch (\Exception $e) {
                DB::rollback();
                $this->error = 'Ops! looks like we had some problem';
                // $this->error = $e->getMessage();
                return redirect()->route('admin.code.generate')->with('error-message', $this->error);
            }
        }
    }

    public function generateEach(Request $request)
    {
        if ($request->isMethod('get')) {
            $brands = Brand::where('status', 1)->select('name', 'id')->get();
            return view('dashboard.pages.codes.each_generate', compact('brands'));
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'number' => 'required|integer|min:1|digits_between:1,6',
                'brand' => 'required|integer',
            ]);

            $brand = Brand::find($request->brand);

            set_time_limit(5000);
            ini_set('memory_limit', -1);
            DB::beginTransaction();

            // initial veriables
            $currentCodeQuery = Code::where("brand_id", $brand->id); 
            if($currentCodeQuery->exists()){
                $qrCount = $currentCodeQuery->max("security_no");
            }else{
                $qrCount = 0;
            }
            // dd($qrCount);
            // $qrCountNo = Code::get()->count(); // current no of qr in table
            $count = $request->number; // user define
            $domain = URL::to('/'); // generate url
            $url = $domain . '/' . $brand->slug;

            try {
                // multiple qr generate
                for ($i = 0; $i < $count; $i++) {
                    $qrCount++;
                    $securityNo = str_pad($qrCount, 8, '0', STR_PAD_LEFT); // generate security number
                    // $securityNo = $this->random_sn($qrCountNo, 8); // generate security number
                    $currentTime = time(); // time in sec
                    $imageName =   $securityNo . '.png'; // full image name
                    $imgPath = 'qrcodes-' . $brand->name . '/' . $imageName; // full path
                    // $qrCode = QrCode::format('png')->margin(2)->size(30.4)->eye('square')->style('square')->errorCorrection('M')->generate($url . '/' . $securityNo); // Generate QR
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
                    $img = $qr->render($url . '/' . $securityNo);

                    $img->setImageFormat('png');
                    // $img->setOption('png:compression-level', 6);

                    // dd(storage_path("public/" . $imgPath));
                    // Laravel can only display saved files
                    $directoryPath = storage_path("app/public/" . 'qrcodes-' . $brand->name);
                    File::isDirectory($directoryPath) or File::makeDirectory($directoryPath, 0777, true, true);
                    $img->writeImage(str_replace("\\", '/', storage_path("app/public/" . $imgPath)));

                    // Storage::disk('public')->put($imgPath, $qrCode); // image save
                    // create code
                    $code = new Code;
                    $code->brand_id = $request->brand;
                    $code->security_no = $securityNo;
                    $code->qr_path = $imgPath;
                    $code->scanned = 0;
                    $code->save(); // saving code

                    DB::commit();
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $this->error = 'Ops! looks like we had some problem';
                $this->error = $e->getMessage();
                return redirect()->route('admin.code.generate.each')->with('error-message', $this->error);
            }

            return redirect()->route('admin.code.lists')->with('success', 'Code has been generated successfully.');
        }
    }

    public function show($codeId = 0)
    {
        $code = Code::find($codeId);
        $information = $code->informations->first();
        $informations = $code->informations->take(5);
        $inject1 = "";
        $inject2 = "";
        $domain = URL::to('/'); // generate url
        $url = $domain . '/vp';

        if (!$code->scanned) {
            $inject1 = "<span class='badge badge-gradient-success'></span><p>The security code you have queried has not been scanned yet and the product is <span>genuine</span>.</p>";
        } else if ($code->scanned == 1) {
            $inject1 = "<span class='badge badge-gradient-success'>Correct Sacn: </span><p>The security code has been queried <span>" . $code->scanned . " time</span>";
        }else {
            $inject1 = "<span class='badge badge-gradient-danger'>Repeat Scan: </span><p style='color: red;'>The security code has been queried <span>" . $code->scanned . " time(s)</span>";
        }

        if (count($informations) > 0) {
            $inject2 = "<h4>Last Scans: </h4><div class='update-section'>";
            for ($i=0; $i < count($informations); $i++) { 
                $inject2 .= "<p><span style='color: red;'>Scan Number ".($i + 1)."</span>:<br>Server Time: <span>" . $informations[$i]->currentTime . "</span><br> Scanning info:<br> Address: <span>" . $informations[$i]->cityName . ', ' . $informations[$i]->countryName . "</span></p>";
            }
            // foreach ($informations as $info) {
            // }
            $inject2 .= "</div>";
        }

        $html = "";
        if (!empty($code)) {
            $html = "<div class='informations'>
                        <div class='top-infos'>
                            <div class='qr-holder'>
                                <img src='/storage/" . $code->qr_path . "' alt=''>
                            </div>
                            <div class='info-data'>
                                <p><span class='badge badge-gradient-primary'>S.No.: " . $code->security_no . "</span></p>" .
                $inject1 .
                "</div>
                        </div>" .
                $inject2 . "
                    </div>";
        }
        $response['html'] = $html;

        return response()->json($response);
    }

    public function zipDownload($brandId = null)
    {
        $zip = new ZipArchive;
        $fileName = 'download-file.zip';

        if ($zip->open($fileName, ZipArchive::CREATE)) {
            if ($brandId) {
                if (file_exists(public_path('storage/qrcode-' . $brandId))) {
                    $files = File::files(public_path('storage/qrcode-' . $brandId));

                    foreach ($files as $file) {
                        $nameInZipFile = basename($file);
                        $zip->addFile($file, $nameInZipFile);
                    }

                    $zip->close();

                    return response()->download($fileName)->deleteFileAfterSend(true);
                }
            }
            return redirect()->back();
        }
    }

    public function fileDownload($filename)
    {
        $filePath = public_path($filename); // Build the full path to the file

        if (file_exists($filePath)) {
            // Generate the response for the file download
            return response()->download($filePath, $filename);
        } else {
            return redirect()->route('code.generate.each')->with('errors', 'File not found.');
        }
    }

    public function random_sn($qrCountNo, $length) 
    {
        // Calculate the number of random digits to add
        $randomDigitsLength = $length - strlen($qrCountNo);
        // Generate a random string of numbers
        $randomDigits = strval(mt_rand(pow(10, $randomDigitsLength - 1), pow(10, $randomDigitsLength) - 1));
        // Pad the original string with the random numbers to the left
        $result = $randomDigits . $qrCountNo;

        return $result;
    }
}
