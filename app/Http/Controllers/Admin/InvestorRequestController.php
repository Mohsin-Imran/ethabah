<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestorRequest;
use App\Models\Payment;

class InvestorRequestController extends Controller
{
    public function index()
    {
        $investorReqs = InvestorRequest::with('user')->get();
        return view('admin.investor_request.index', get_defined_vars());
    }
    public function view($id)
    {
        $investorReq = InvestorRequest::with('investmentFund.companies')->find(id: $id);
        if (!$investorReq) {
            return back()->with('error', 'Investor Request not found.');
        }
        $payment = Payment::where('user_id',$investorReq->user_id)->sum('amount');
        $profitPercentage = $investorReq->investmentFund->profit_percentage ?? 0;
        $calculatedProfit = ($investorReq->amount * $profitPercentage) / 100;

        return view('admin.investor_request.view', compact('payment','investorReq', 'profitPercentage', 'calculatedProfit'));
    }

    public function acceptRequest($id)
    {
        $request = InvestorRequest::findOrFail($id);
        $request->status = 1;
        $request->save();

        return redirect()->back()->with('success', 'Request accepted successfully!');
    }

    public function declineRequest($id)
    {
        $request = InvestorRequest::findOrFail($id);
        $request->status = 0;
        $request->save();

        return redirect()->back()->with('error', 'Request declined successfully!');
    }
}
