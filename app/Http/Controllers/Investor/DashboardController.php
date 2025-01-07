<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\InvestorRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        if (auth()->user()->status == 0) {
            return view('company.under_review');
        } else {
            $investmentGraph = InvestorRequest::selectRaw('SUM(amount) as total_amount, MONTH(created_at) as month')
                ->where('user_id', $userId)
                ->whereYear('created_at', date('Y')) // Filter for the current year
                ->groupBy('month') // Group by the month number
                ->orderBy('month') // Order by the month number
                ->get();
    
            $chartLabels = [];
            $chartDataValues = [];
    
            for ($monthIndex = 1; $monthIndex <= 12; $monthIndex++) {
                $monthName = date('F', mktime(0, 0, 0, $monthIndex, 1)); // Get the full month name
                $monthlyTotal = 0;
    
                foreach ($investmentGraph as $entry) {
                    if ($entry->month == $monthIndex) {
                        $monthlyTotal = $entry->total_amount; // Use the correct field name
                        break;
                    }
                }
    
                array_push($chartLabels, $monthName);
                array_push($chartDataValues, $monthlyTotal);
            }
    
            $chartColors = [
                '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b',
                '#e377c2', '#7f7f7f', '#bcbd22', '#17becf', '#aec7e8', '#ffbb78',
            ];
    
            $dataSets = [
                [
                    'label' => 'Monthly Investment Amount',
                    'data' => $chartDataValues,
                    'bgColor' => $chartColors,
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
}
