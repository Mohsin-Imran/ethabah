<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bike;
use App\Models\Category;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index()
    {
        $bikes = Bike::all();
        return view('admin.bike.index', get_defined_vars());
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.bike.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',

        ]);
        $bike = new Bike;
        $bike->user_id = auth()->id();
        $bike->category_id = $request->category_id;
        $bike->name = $request->name;
        $bike->price = $request->price;
        $bike->description = $request->description;
        $bike->save();
        return redirect()->route('admin.bike.index')->with('message', 'Data added successfully');
    }

    public function view()
    {
        $bikes = Bike::orderBy('created_at', 'asc')->paginate(20);
        return view('admin.bike.view', compact('bikes'));
    }
    public function edit($id)
    {
        $bike = Bike::find($id);
        $categories = Category::all();
        return view('admin.bike.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable',
        ]);

        $bike = Bike::find($id);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($bike->image && file_exists(public_path('bike/' . $bike->image))) {
                unlink(public_path('bike/' . $bike->image));
            }
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('bike'), $imageName);
            $bike->image = $imageName;
        }

        $bike->user_id = auth()->id();
        $bike->category_id = $request->category_id;
        $bike->name = $request->name;
        $bike->price = $request->price;
        $bike->description = $request->description;
        $bike->limit = $request->limit;
        $bike->save();
        return redirect()->route('admin.bike.index')->with('message', 'Data updated successfully');
    }

    public function destroy($id)
    {
        $bike = Bike::find($id);
        $bike->delete();
        return back()->with('message', 'Data Delete SuccessFully');
    }
}
