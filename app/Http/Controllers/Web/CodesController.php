<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Code;
use App\Models\Information;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

class CodesController extends Controller
{
    public $error;

    public function verify($brand = Null, $security_no = Null)
    {
        // if no security no in parameter return view
        if (!$brand || !$security_no ) {
            // return view('web.pages.verify.verify-product');
            abort('404');
        }

        // if security no exist get the first data
        $brandObj = Brand::where('slug', $brand)->first();
        
        if (!$brandObj) {
            abort(404);
        }

        $getCode = Code::where("brand_id", $brandObj->id)->where('security_no', $security_no)->first();

        // check if exist getCode
        if (!$getCode) {
            abort(404);
        }

        // $ip = '103.98.130.143';
        $ip = request()->ip(); // current request ip
        $currentUserInfo = Location::get($ip); // user location information
        date_default_timezone_set('America/New_York');
        $currentTime = Carbon::now(); // according to set timezone

        try {
            DB::beginTransaction();

            $information = new Information(); // Add New Information
            $information->code_id = $getCode->id;

            if ($currentUserInfo) {
                $information->ip          = $currentUserInfo->ip;
                $information->countryName = $currentUserInfo->countryName;
                $information->countryCode = $currentUserInfo->countryCode;
                $information->regionCode  = $currentUserInfo->regionCode;
                $information->regionName  = $currentUserInfo->regionName;
                $information->cityName    = $currentUserInfo->cityName;
                $information->zipCode     = $currentUserInfo->zipCode;
                $information->isoCode     = $currentUserInfo->isoCode;
                $information->postalCode  = $currentUserInfo->postalCode;
                $information->latitude    = $currentUserInfo->latitude;
                $information->longitude   = $currentUserInfo->longitude;
                $information->metroCode   = $currentUserInfo->metroCode;
                $information->areaCode    = $currentUserInfo->areaCode;
                $information->timezone    = $currentUserInfo->timezone;
            }

            $information->currentTime = $currentTime;

            $information->save(); // saving information

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($this->error);
            abort(404);
            $this->error = 'Ops! looks like we had some problem';
            // $this->error = $e->getMessage();
            return redirect()->route('web.contact')->with('error-message', $this->error);
        }


        // if exist and not scanned
        if (!$getCode->scanned) {
            DB::beginTransaction();
            try {

                $getCode->scanned = $getCode->scanned + 1;
                $getCode->save();
                DB::commit();

                return view('web.pages.verify.correct', [
                    'code' => $getCode,
                    'information' => $getCode->informations->first(),
                    'brand' => $brandObj
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                $this->error = 'Ops! looks like we had some problem';
                // $this->error = $e->getMessage();
                return redirect()->route('web.contact')->with('error-message', $this->error);
            }
        }

        // if exist and scanned
        DB::beginTransaction();
        try {
            $getCode->scanned = $getCode->scanned + 1;
            $getCode->save();
            
            DB::commit();

            return view('web.pages.verify.repeat', [
                'code' => $getCode,
                'information' => $getCode->informations->first(),
                'brand' => $brandObj
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->error = 'Ops! looks like we had some problem';
            // $this->error = $e->getMessage();
            return redirect()->route('web.contact')->with('error-message', $this->error);
        }
    }
}
