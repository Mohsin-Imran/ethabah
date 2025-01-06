<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\InvestorRequest;

class DashboardController extends Controller
{
    public function index()
    {

        $investorGraph = InvestorRequest::selectRaw('SUM(amount) as total_amount, MONTH(created_at) as month')
            ->whereYear('created_at', date('Y')) // Filter for the current year
            ->groupBy('month') // Group by the month number
            ->orderBy('month') // Order by the month number
            ->get();

        $labels = [];
        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1)); // Get the full month name
            $count = 0;

            foreach ($investorGraph as $user) {
                if ($user->month == $i) {
                    $count = $user->total_amount; // Use the correct field name
                    break;
                }
            }

            array_push($labels, $month);
            array_push($data, $count);
        }

        $colors = [
            '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b',
            '#e377c2', '#7f7f7f', '#bcbd22', '#17becf', '#aec7e8', '#ffbb78',
        ];

        $dataSets = [
            [
                'label' => 'Investor Investment Amount',
                'data' => $data,
                'bgColor' => $colors,
            ],
        ];

        $investmentFunds = InvestorRequest::where('user_id', auth()->user()->id)
            ->with('investmentFund')
            ->get();
        $allInvestmentFunds = $investmentFunds->pluck('investmentFund')->flatten();
        $investorpendingStatus = $allInvestmentFunds->where('status', '!=', 1)->count();
        $investorapprovedStatus = $allInvestmentFunds->where('status', 1)->count();
        $investorAmount = InvestorRequest::where('user_id', auth()->user()->id)->sum('amount');
        $investorRequest = InvestorRequest::where('user_id', auth()->user()->id)->count();
        return view('investor.dashboard', get_defined_vars());
    }
}