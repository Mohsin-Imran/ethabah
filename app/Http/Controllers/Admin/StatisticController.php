<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;

class StatisticController extends Controller
{
    public function index()
    {
        $companies = Company::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        $investors = User::orderBy('created_at', 'desc')->where('role', 0)->get();
        return view('admin.statistic.index', get_defined_vars());

    }
}
