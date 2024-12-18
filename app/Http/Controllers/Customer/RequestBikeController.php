<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Bike;
use App\Models\Category;
use App\Models\RequestBike;
use App\Models\VehicleFunds;
use Illuminate\Http\Request;

class RequestBikeController extends Controller
{

    public function index()
    {
        $requestBikes = RequestBike::where('user_id',auth()->user()->id)->orderBy('created_at', 'asc')->get();
        return view('customer.request_bike.index', get_defined_vars());
    }

    public function create()
    {
        $categories = Category::all();
        $bikes = Bike::all();
        return view('customer.request_bike.create', get_defined_vars());
    }
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'qty' => 'required|numeric|min:0',
            'category_id' => 'required',
            'bike_id' => 'required',
        ]);

        // Create a new RequestBike record
        $bike = new RequestBike();
        $bike->user_id = auth()->user()->id;
        $bike->category_id = $request->category_id;
        $bike->bike_id = $request->bike_id;
        $bike->qty = $request->qty;
        $bike->description = $request->description;
        $bike->price = $request->price; // Assume price is coming from the request
        $bike->save();

        // Check if a VehicleFunds record already exists for the same bike_id and category_id
        $fund = VehicleFunds::where('bike_id', $request->bike_id)
            ->where('category_id', $request->category_id)
            ->first();

        if ($fund) {
            // Update the existing record
            $last_total_price = $fund->total_price; // Get the last total price
            $fund->qty += $request->qty; // Add new qty to existing qty
            $fund->total_price = $last_total_price + ($request->qty * $request->price); // Update total price with the new price
            $fund->save();
        } else {
            // Create a new VehicleFunds record
            $fund = new VehicleFunds();
            $fund->user_id = $bike->user_id;
            $fund->category_id = $bike->category_id;
            $fund->bike_id = $bike->bike_id;
            $fund->qty = $bike->qty;
            $fund->total_price = $bike->price * $bike->qty; // Calculate total price
            $fund->save();
        }

        return redirect()->route('customer.request.bike.index')->with('message', 'Data added successfully');
    }

}
