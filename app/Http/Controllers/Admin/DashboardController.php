<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apbd;
use App\Models\Article;
use App\Models\Role;
use App\Models\Umkm;
use App\Models\UmkmReview;
use App\Models\User;
use App\Models\VillageOfficial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Lane 1
        $userActive = User::where('isActive', true)->count();
        $userInactive = User::where('isActive', false)->count();
        $official = VillageOfficial::count();
        $umkm = Umkm::count();

        // Lane 2
        $umkmReview = UmkmReview::orderBy('created_at', 'desc')->take(5)->get();
        
        // Fetch APBD data grouped by type, month, and year
        $apbdData = Apbd::select(
            'type',
            DB::raw('YEAR(date) as year'),
            DB::raw('MONTH(date) as month'),
            DB::raw('SUM(amount) as total_amount')
        )
            ->groupBy('type', 'year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->orderBy('type')
            ->get();

        $typeLabels = [
            1 => 'Pelaksanaan',
            2 => 'Pendapatan',
            3 => 'Pembelanjaan'
        ];

        $monthNames = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun',
            7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];

        // Get the current year and month
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $chartData = [];
        // Initialize all months with zero values
        for ($month = 1; $month <= $currentMonth; $month++) {
            $chartData[$currentYear][$month] = [
                'Pelaksanaan' => 0,
                'Pendapatan' => 0,
                'Pembelanjaan' => 0
            ];
        }

        foreach ($apbdData as $data) {
            $year = $data->year;
            $month = $data->month;
            $type = $typeLabels[$data->type] ?? 'Unknown';
            $amount = $data->total_amount;

            if (!isset($chartData[$year][$month])) {
                $chartData[$year][$month] = [
                    'Pelaksanaan' => 0,
                    'Pendapatan' => 0,
                    'Pembelanjaan' => 0
                ];
            }
            $chartData[$year][$month][$type] = $amount;
        }

        // Prepare data for the chart
        $labels = [];
        $datasets = [
            'Pelaksanaan' => [],
            'Pendapatan' => [],
            'Pembelanjaan' => []
        ];

        foreach ($chartData as $year => $monthData) {
            foreach ($monthData as $month => $typeData) {
                $labels[] = $monthNames[$month] . ' ' . $year;
                foreach ($typeData as $type => $amount) {
                    $datasets[$type][] = $amount;
                }
            }
        }

        $formattedDatasets = [];
        $colors = [
            'Pelaksanaan' => 'rgba(255, 99, 132, 0.2)',
            'Pendapatan' => 'rgba(54, 162, 235, 0.2)',
            'Pembelanjaan' => 'rgba(255, 206, 86, 0.2)'
        ];

        foreach ($datasets as $type => $data) {
            $formattedDatasets[] = [
                'label' => $type,
                'data' => $data,
                'backgroundColor' => $colors[$type],
                'borderColor' => str_replace('0.2', '1', $colors[$type]),
                'borderWidth' => 1
            ];
        }

        // Lane 3
        $articles = Article::orderBy('created_at', 'desc')->take(5)->get();
        return view('pages.admin.dashboard', compact(
            'userActive', 'userInactive', 'official', 'umkm', 'umkmReview',
            'labels', 'formattedDatasets','articles'
        ));
    }
}
