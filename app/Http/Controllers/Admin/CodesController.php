<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Code;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CodesController extends Controller
{
    public $error; 

    public function lists() 
    {
        $codes = Code::orderBy('id','desc')->paginate(5);
        return view('dashboard.pages.codes.lists', compact('codes'));
    }

    public function generate(Request $request) 
    {
        if ($request->isMethod('get'))
        {
            return view('dashboard.pages.codes.generate');
        }

        if ($request->isMethod('POST')) 
        {
            // dd($request->all());
            $request->validate([
                'number' => 'required|integer|min:1|digits_between:1,6'
            ]);

            DB::beginTransaction();

            // initial veriables
            $qrCountNo = Code::get()->count(); // current no of qr in table
            $count = $request->number; // user define
            $domain = URL::to('/'); // generate url
            $url = $domain.'/verify-product';

            try {
                // multiple qr generate
                for($i=0;$i<$count;$i++)
                {
                    $qrCountNo++;
                    $securityNo = str_pad($qrCountNo, 10, '0', STR_PAD_LEFT); // generate security number
                    $currentTime = time(); // time in sec
                    $imageName = 'qrcode-'.$currentTime.'-'.$securityNo.'.png'; // full image name
                    $date = Carbon::now()->format('Y-m-d'); // folder date
                    $imgPath = 'qrcode-'.$date.'/'.$imageName; // full path
                    $qrCode = QrCode::format('png')->size(100)->errorCorrection('H')->generate($url.'/'.$securityNo); // Generate QR
                    Storage::disk('public')->put($imgPath, $qrCode); // image save
                    // create code
                    $code = new Code;
                    $code->security_no = $securityNo;
                    $code->qr_path = $imgPath;
                    $code->scanned = 0;
                    $code->save(); // saving code
                }
		DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $this->error = 'Ops! looks like we had some problem';
                // $this->error = $e->getMessage();
                return redirect()->route('admin.code.generate')->with('error-message', $this->error);
            }
    
            return redirect()->route('admin.code.generate')->with('success','Code has been generated successfully.');
        }
    }

    public function show($codeId = 0)
    {
        $code = Code::find($codeId);
        $information = $code->informations->first();
        $informations = $code->informations->take(5);
        $inject1 = "";
        $inject2 = "";

        if(!$code->scanned)
        {
            $inject1 = "<span class='badge badge-gradient-success'>Correct Sacn: </span><p>The security code you have queried has been scanned <span>1st time</span> and the product is <span>genuine</span>.</p>";
        } else {
            $inject1 = "<span class='badge badge-gradient-danger'>Repeat Sacn: </span><p>The security code has been queried <span>". $code->scanned ."time(s)</span>, 
            first query <span> Israel Time:". $information->currentTime ." (UTC+2), IP:". $information->ip ." </span></p>";
        }

        if($informations)
        {
            $inject2 = "<h4>Last 5 Scanned: </h4><div class='update-section'>";
            foreach($informations as $info)
            {
                $inject2 .= "<p>Israel Time: ". $info->currentTime ." (UTC+2), IP: ". $info->ip ." </span></p>";
            }
            $inject2 .= "</div>";
        }

        $html = "";
        if(!empty($code)){
           $html = "<div class='informations'>
                        <div class='top-infos'>
                            <div class='qr-holder'>
                                <img src='". asset('storage/'.$code->qr_path) ."' alt='qr-code'>
                            </div>
                            <div class='info-data'>
                                <p><span class='badge badge-gradient-primary'>S.No.: ".$code->security_no."</span></p>".
                                $inject1 .
                            "</div>
                        </div>".
                        $inject2 ."
                    </div>";
        }
        $response['html'] = $html;
  
        return response()->json($response);
    }
}
