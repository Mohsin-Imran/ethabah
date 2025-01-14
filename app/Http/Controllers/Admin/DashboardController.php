<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\InvestorRequest;
use App\Models\RequestBike;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $companies  = Company::all();
        $companiesCounts  = Company::count();
        $investorCounts  = User::where('role', 0)->get()->count();
        $investorFunds  = InvestorRequest::sum('amount');
        $requestBikes  = RequestBike::where('status',1)->count();
        $investors = User::orderBy('created_at', 'desc')->where('role', 0)->get();
        return view('admin.dashboard', get_defined_vars());
    }
}
