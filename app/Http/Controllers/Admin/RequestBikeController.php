<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use App\Models\RequestBike;
use App\Models\InvestorRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;

class RequestBikeController extends Controller
{
    public function index()
    {
        $requestBikes = RequestBike::with('user', 'category')->get();
        $companies = Company::all();
        $companiesCounts = Company::count();
        $investorCounts = User::where('role', 0)->get()->count();
        $investorFunds = InvestorRequest::sum('amount');
        $requestBikesCount  = RequestBike::where('status',1)->count();
        $investors = User::orderBy('created_at', 'desc')->where('role', 0)->get();
        return view('admin.request_bike.index', get_defined_vars());
    }

    public function view($id)
    {
        $requestBike = RequestBike::find($id);
        return view('admin.request_bike.view', data: get_defined_vars());
    }

    public function destroy($id)
    {
        $bike = RequestBike::find($id);
        $bike->delete();
        return back()->with('message', 'Data Delete SuccessFully');
    }

    public function acceptRequest($id)
    {
        $request = RequestBike::findOrFail($id);
        $request->status = 1;
        $request->save();

        return redirect()->back()->with('success', 'Request accepted successfully!');
    }

    public function declineRequest($id)
    {
        $request = RequestBike::findOrFail($id);
        $request->status = 0;
        $request->save();

        return redirect()->back()->with('error', 'Request declined successfully!');
    }
}
