<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Lottery;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LotteryController extends Controller
{
    public $error;

    public function view($brand)
    {
        $brand = Brand::where('name', $brand)->first();
        if ($brand){
            $currentDate = date('m/d/Y');
            $lottery = Lottery::where('is_active', 1)->where("brand_id", $brand->id)->where('to_date', '>', $currentDate)->get()->reverse()->first();

            if ($lottery)
            {
                $now = date("m/d/Y");
                $toDate = Carbon::createFromFormat('m/d/Y', $lottery->to_date);
                $date = Carbon::createFromFormat('m/d/Y', $now);
        
                $lotteryEnds = $toDate->gt($date);
                return view('web.pages.brand_lottery', compact('lottery', 'lotteryEnds', 'brand'));
            } else {
                $lotteryEnds = '';
                return view('web.pages.brand_lottery', compact('lottery', 'lotteryEnds', 'brand'));
            }
        } else {
            abort(404);
        }
    }

    public function joinLottery(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required|min:3',
            'email' => 'required|min:3|unique:applicants,email',
            'phone' => 'required|min:3|unique:applicants,phone'
        ]);

        $id = Crypt::decrypt($id);
        $lottery = Lottery::find($id);
        if(!$lottery)
        {
            return redirect()->route('web.contact')->with('error-message', "Action denied! Invalid Action");
        }

        DB::beginTransaction();

        try {
            $applicant = new Applicant();
            $applicant->lottery_id = $id;
            $applicant->fullname = $request->fullname;
            $applicant->email = $request->email;
            $applicant->phone = $request->phone;
            $applicant->save();
            DB::commit();
            return redirect()->route('web.contact')->with('success', "We will update you by email or text message about the outcome of the lottery. Good luck!.");
        } catch (\Exception $e) {
            DB::rollback();
            $this->error = 'Ops! looks like we had some problem';
            // $this->error = $e->getMessage();
            return redirect()->route('web.contact')->with('error-message', $this->error);
        }       
    }
}
