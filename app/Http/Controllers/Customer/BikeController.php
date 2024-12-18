<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Bike;

class BikeController extends Controller
{
    public function index()
    {
        $bikes = Bike::orderBy('created_at', 'asc')->paginate(20);
        return view('customer.bike.index', compact('bikes'));
    }
}
