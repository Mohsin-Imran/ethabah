<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleFunds;
use Illuminate\Http\Request;

class VehicleFundsController extends Controller
{
    public function index()
    {
        $fundsBikes = VehicleFunds::all();
        return view('admin.funds_bike.index', get_defined_vars());
    }
}
