<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\InvestorRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $investmentFunds = InvestorRequest::where('user_id', auth()->user()->id)
            ->with('investmentFund')
            ->get();
        $allInvestmentFunds = $investmentFunds->pluck('investmentFund')->flatten();
        $investorpendingStatus = $allInvestmentFunds->where('status', '!=', 1)->count();
        $investorapprovedStatus = $allInvestmentFunds->where('status', 1)->count();
        $investorAmount = InvestorRequest::where('user_id', auth()->user()->id)->sum('amount');
        $investorRequest = InvestorRequest::where('user_id', auth()->user()->id)->count();
        return view('investor.dashboard',get_defined_vars());
    }
}
