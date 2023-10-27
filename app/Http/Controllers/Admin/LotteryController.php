<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Lottery;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotteryController extends Controller
{
    public $error;

    public function lists()
    {
        $lotteries = Lottery::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.pages.lottery.lists', compact('lotteries'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $isExist = Lottery::where('is_active', 1)->exists();
            // if($isExist)
            // {
            //     return redirect()->route('admin.lottery.lists')->with('error-message', 'Close the open lottery first to create new lottery.');
            // }
            $brands = Brand::where('status', 1)->select('name', 'id')->get();
            return view('dashboard.pages.lottery.create', compact('brands'));
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'date' => 'required',
                'brand' => 'required|integer',
            ]);

            DB::beginTransaction();

            try {
                $lottery = new Lottery();
                $lottery->title = $request->title;
                $lottery->description = $request->description;
                $lottery->from_date = $request->from_date;
                $lottery->to_date = $request->to_date;
                $lottery->is_active = 1;
                $lottery->brand_id = $request->brand;


                // Store the uploaded image in the 'public/uploads' directory
                $imageName = time() . '.' . $request->file->extension();
                $request->file->storeAs('uploads', $imageName, 'public');

                $lottery->file = $imageName;
                $lottery->save(); // saving code
                DB::commit();
                return redirect()->route('admin.lottery.lists')->with('success', 'Lottery has been created successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                $this->error = 'Ops! looks like we had some problem';
                $this->error = $e->getMessage();
                return redirect()->route('admin.lottery.create')->with('error-message', $this->error);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $lottery = Lottery::find($id);
        $brands = Brand::where('status', 1)->select('name', 'id')->get();

        if (!$lottery) {
            return redirect()->back()->with('error-message', "Action denied!");
        }

        if ($request->isMethod('get')) {
            return view('dashboard.pages.lottery.update', compact('lottery', 'brands'));
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'date' => 'required'
            ]);

            DB::beginTransaction();

            try {
                $lottery->title = $request->title;
                $lottery->description = $request->description;
                $lottery->from_date = $request->from_date;
                $lottery->to_date = $request->to_date;
                if ($request->brand) {
                    $lottery->brand_id = $request->brand;
                }

                if ($request->hasFile('file')) {
                    // Store the uploaded image in the 'public/uploads' directory
                    $imageName = time() . '.' . $request->file->extension();
                    $request->file->storeAs('uploads', $imageName, 'public');
                    $lottery->file = $imageName;
                }

                $lottery->save(); // saving code

                DB::commit();
                return redirect()->route('admin.lottery.lists')->with('success', 'Lottery has been updated successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                $this->error = 'Ops! looks like we had some problem';
                // $this->error = $e->getMessage();
                return redirect()->route('admin.lottery.create')->with('error-message', $this->error);
            }
        }
    }

    public function changeStatus($id)
    {
        $lottery = Lottery::find($id);

        if (!$lottery) {
            return redirect()->back()->with('error-message', "Action denied!");
        }

        if ($lottery->has_winner) {
            return redirect()->back()->with('error-message', "Action denied! current lottery is already finished.");
        }

        if (count($lottery->applicants)) {
            return redirect()->back()->with('error-message', "Action denied! current lottery has active members.");
        }

        $lottery->is_active = $lottery->is_active ? 0 : 1;
        $lottery->save();

        return redirect()->back()->with('success', "Lottery status updated.");
    }

    public function delete($id)
    {
        $lottery = Lottery::find($id);

        if (!$lottery) {
            return redirect()->back()->with('error-message', "Action denied!");
        }

        if (count($lottery->applicants)) {
            return redirect()->back()->with('error-message', "Action denied! current lottery has active members.");
        }

        $lottery->delete();

        return redirect()->back()->with('success', "Lottery deleted successfully.");
    }

    public function applicants($id)
    {
        $lottery = Lottery::find($id);

        $now = date("m/d/Y");
        $toDate = Carbon::createFromFormat('m/d/Y', $lottery->to_date);
        $date = Carbon::createFromFormat('m/d/Y', $now);

        $lotteryEnds = $toDate->gt($date);
        $applicants = Lottery::find($id)->applicants()->paginate(10);

        if (!$applicants) {
            return redirect()->back()->with('error-message', "Action denied!");
        }

        return view('dashboard.pages.lottery.applicants', compact('applicants', 'lotteryEnds', 'lottery'));
    }

    public function selectWinner($id)
    {
        $applicant = Applicant::find($id);

        if (!$applicant) {
            return redirect()->back()->with('error-message', "Action denied! There are no such applicant.");
        }

        DB::beginTransaction();
        try {
            $applicant->is_winner = 1;
            $applicant->save();

            $lottery = Lottery::find($applicant->lottery_id);
            $lottery->has_winner = 1;
            $lottery->winner = $applicant->fullname;
            $lottery->is_active = 0;
            $lottery->save();
            DB::commit();
            return redirect()->back()->with('success', 'Lottery winner is selected.');
        } catch (\Exception $e) {
            DB::rollback();
            $this->error = 'Ops! looks like we had some problem';
            // $this->error = $e->getMessage();
            return redirect()->route('admin.lottery.create')->with('error-message', $this->error);
        }
    }

    public function randomWinner($lotteryId)
    {
        $lottery = Lottery::find($lotteryId);

        if (!$lottery) {
            return redirect()->back()->with('error-message', "Action denied! There are no such lottery open.");
        }

        $applicant = $lottery->applicants()->inRandomOrder()->first();

        DB::beginTransaction();
        try {
            $applicant->is_winner = 1;
            $applicant->save();

            $lottery->has_winner = 1;
            $lottery->winner = $applicant->fullname;
            $lottery->is_active = 0;
            $lottery->save();
            DB::commit();
            return redirect()->back()->with('success', $applicant->fullname . ' is selected as winner.');
        } catch (\Exception $e) {
            DB::rollback();
            $this->error = 'Ops! looks like we had some problem';
            // $this->error = $e->getMessage();
            return redirect()->route('admin.lottery.create')->with('error-message', $this->error);
        }
    }
}
