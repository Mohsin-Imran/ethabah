<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestorRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InvestorRequestController extends Controller
{
    public function index()
    {
        $investorReqs = InvestorRequest::with('user')->get();
        return view('admin.investor_request.index', get_defined_vars());
    }
    public function view($id)
    {
        $investorReq = InvestorRequest::find($id);
        return view('admin.investor_request.view', data: get_defined_vars());
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
