<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\InvestorRequest;
use App\Models\RequestBike;
use App\Models\User;

class StatisticController extends Controller
{
    public function index()
    {
        $totalFunds = RequestBike::selectRaw('MONTH(created_at) as month, SUM(total_funds) as sum')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $totalamounts = InvestorRequest::selectRaw('MONTH(created_at) as month, SUM(amount) as sum')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $fundsData = [];
        $amountsData = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $fundSum = $totalFunds->firstWhere('month', $i)->sum ?? 0;
            $amountSum = $totalamounts->firstWhere('month', $i)->sum ?? 0;

            $fundsData[] = $fundSum;
            $amountsData[] = $amountSum;
            $labels[] = $month;
        }

        $data = [
            'labels' => $labels,
            'fundsData' => $fundsData,
            'amountsData' => $amountsData,
        ];

        $companies = Company::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $investors = User::orderBy('created_at', 'desc')->where('role', 0)->get();

        return view('admin.statistic.index', compact('data', 'companies', 'investors'));
    }

}
