<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\RequestBike;

class DashboardController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        if (auth()->user()->status == 0) {
           return view('company.under_review');
        } else {
            $totalFunds = RequestBike::selectRaw('MONTH(created_at) as month, SUM(total_funds) as sum')
                ->whereYear('created_at', date('Y'))
                ->where('user_id', $id)
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $labels = [];
            $fundsData = [];
            for ($i = 1; $i <= 12; $i++) {
                $month = date('F', mktime(0, 0, 0, $i, 1));
                $fundSum = $totalFunds->firstWhere('month', $i)->sum ?? 0;
                $fundsData[] = $fundSum;
                $labels[] = $month;
            }
            $colors = [
                '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd',
                '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf',
                '#aec7e8', '#ffbb78',
            ];
            $requestApproved = RequestBike::where('user_id', $id)
                ->where('status', 1)
                ->count();
            $requestPending = RequestBike::where('user_id', $id)
                ->where('status', 0)
                ->count();
            $requestFundsSum = RequestBike::where('user_id', $id)
                ->sum('total_funds');
            $requestTotal = RequestBike::count();
            $requestesDatas = RequestBike::where('user_id', auth()->user()->id)->get();

            return view('company.dashboard', [
                'labels' => $labels,
                'fundsData' => $fundsData,
                'colors' => $colors,
                'requestApproved' => $requestApproved,
                'requestPending' => $requestPending,
                'requestFundsSum' => $requestFundsSum,
                'requestTotal' => $requestTotal,
                'requestesDatas' => $requestesDatas,
            ]);
        }
    }

}
