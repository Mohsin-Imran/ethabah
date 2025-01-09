<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\InvestorFunds;
use App\Models\InvestorRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestorFundsController extends Controller
{
    public function index()
    {
        $investorCounts = InvestorRequest::select('investor_funds_id', DB::raw('COUNT(*) as count'))
            ->groupBy('investor_funds_id')
            ->pluck('count', 'investor_funds_id');
        // $investorFundsCount = InvestorFunds::withCount(['investmentFundCompanies as investmentFundCount'])->get();
        $investorFunds = InvestorFunds::with('category')->withCount(['investmentFundCompanies as investmentFundCounts'])->get();
        foreach ($investorFunds as $fund) {
            $fund->amountSum = InvestorRequest::where('investor_funds_id', $fund->id)->sum('amount');
            $fund->total_funds = $fund->amount; // Example: total funds logic
            $fund->amount_received = $fund->amountSum; // Sum of all received amounts
            $fund->progress_percentage = $fund->amount > 0 ? ($fund->amount_received / $fund->amount) * 100 : 0;
            $fund->investorCounts = $investorCounts[$fund->id] ?? 0; // Default to 0 if no investors
        }

        return view('investor.investor_funds.index', compact('investorFunds'));
    }

    public function view($id)
    {
        $investor = InvestorRequest::with(['investmentFund.companies'])->where('investor_funds_id', $id)->first();
        // $companyData = Project::where('company_id')
        $investorFund = InvestorFunds::with('investmentFundCompanies')->findOrFail($id);
        $amountSum = InvestorRequest::where('investor_funds_id', $id)->sum('amount');
        $investorRequest = InvestorRequest::with(['user', 'investmentFund.companies'])->where('investor_funds_id', $id)->get();
        foreach ($investorRequest as $request) {
            $profitPercentage = $request->investmentFund->profit_percentage ?? 0;
            $request->calculatedProfit = ($request->amount * $profitPercentage) / 100;
            $request->profitPercentage = $profitPercentage;
        }
        return view('investor.investor_funds.view', compact('investorFund', 'amountSum', 'investorRequest'));
    }



}
