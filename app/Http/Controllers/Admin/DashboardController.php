<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index() {
        $totalCode = Code::count();
        $scannedCode = Code::where('scanned', 1)->count();
        $multScannedCode = Code::where('scanned', '>', 1)->count();
        $recentScanned = Information::latest()->take(10)->get();

        $stats = Code::query()
                ->select('id')
                ->addSelect(['last_30' => Code::selectRaw('count(*) as total')
                                ->whereDate('created_at', '<', now()->subDays(7))])
                ->addSelect(['new_codes' => Code::selectRaw('count(*) as total')
                                ->whereDate('created_at', '>=', now()->subDays(7))])
                ->addSelect(['scanned_codes' => Code::where('scanned', 1)->selectRaw('count(*) as total')
                                ->whereDate('created_at', '<', now()->subDays(7))])
                ->addSelect(['new_scanned_codes' => Code::where('scanned', 1)->selectRaw('count(*) as total')
                                ->whereDate('created_at', '>=', now()->subDays(7))])
                ->addSelect(['multi_scanned_codes' => Code::where('scanned', '>', 1)->selectRaw('count(*) as total')
                                ->whereDate('created_at', '<', now()->subDays(7))])
                ->addSelect(['new_multi_scanned_codes' => Code::where('scanned', '>', 1)->selectRaw('count(*) as total')
                                ->whereDate('created_at', '>=', now()->subDays(7))])
                ->first();

        $last_30 = isset($stats->last_30) ? $stats->last_30 : 0;
        $scanned_codes = isset($stats->scanned_codes) ? $stats->scanned_codes : 0;
        $multi_scanned_codes = isset($stats->multi_scanned_codes) ? $stats->multi_scanned_codes : 0;

        $new_codes = isset($stats->new_codes) ? $stats->new_codes : 0;
        $new_scanned_codes = isset($stats->new_scanned_codes) ? $stats->new_scanned_codes : 0;
        $new_multi_scanned_codes = isset($stats->new_multi_scanned_codes) ? $stats->new_multi_scanned_codes : 0;

        $growthPercentage = $this->calculatePercentage($last_30, $new_codes);
        $scannedGrowthPercentage = $this->calculatePercentage($scanned_codes, $new_scanned_codes);
        $multiScannedGrowthPercentage = $this->calculatePercentage($multi_scanned_codes, $new_multi_scanned_codes);

        return view('dashboard.pages.dashboard', compact('totalCode', 'scannedCode', 'multScannedCode', 'recentScanned', 'growthPercentage', 'scannedGrowthPercentage', 'multiScannedGrowthPercentage'));
    }

    public function calculatePercentage($oldNumber, $newNumber){
        $decreaseValue =  $newNumber - $oldNumber;
        if($decreaseValue == 0 || $oldNumber == 0) {
            return 0;
        }
        return ($decreaseValue / $oldNumber) * 100;
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
