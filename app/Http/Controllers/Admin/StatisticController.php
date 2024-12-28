<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestorRequest;
use App\Models\RequestBike;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        return view('admin.statistic.index');
    }

    public function getData(Request $request)
    {
        $period = $request->get('period', 'monthly'); // Default to 'monthly'
        $currentYear = date('Y');

        if ($period === 'monthly') {
            $currentMonth = date('m');

            $totalFunds = RequestBike::selectRaw('DAY(created_at) as day, SUM(total_funds) as sum')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            $totalAmounts = InvestorRequest::selectRaw('DAY(created_at) as day, SUM(amount) as sum')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            $labels = range(1, 31);
        } elseif ($period === 'yearly') {
            $totalFunds = RequestBike::selectRaw('MONTH(created_at) as month, SUM(total_funds) as sum')
                ->whereYear('created_at', $currentYear)
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $totalAmounts = InvestorRequest::selectRaw('MONTH(created_at) as month, SUM(amount) as sum')
                ->whereYear('created_at', $currentYear)
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $labels = array_map(fn($m) => date('F', mktime(0, 0, 0, $m, 1)), range(1, 12));
        }

        $fundsData = [];
        $amountsData = [];

        foreach ($labels as $index => $label) {
            $index += 1; // Convert to 1-based index
            $fundSum = $totalFunds->firstWhere($period === 'monthly' ? 'day' : 'month', $index)->sum ?? 0;
            $amountSum = $totalAmounts->firstWhere($period === 'monthly' ? 'day' : 'month', $index)->sum ?? 0;

            $fundsData[] = $fundSum;
            $amountsData[] = $amountSum;
        }

        return response()->json([
            'labels' => $labels,
            'fundsData' => $fundsData,
            'amountsData' => $amountsData,
        ]);
    }

}
