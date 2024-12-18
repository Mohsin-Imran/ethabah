<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',get_defined_vars());
    }



    public function create()
    {
        return view('admin.category.create',get_defined_vars());
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = new Category;
        $category->user_id = auth()->user()->id;
        $category->name = $request->name;
        $category->save();
        // return redirect()->back()->with('message','Data Add Success');
        return redirect()->route('admin.category.index')->with('message', 'Data updated successfully');

    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->user_id = auth()->user()->id;
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category.index')->with('message', 'Data updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back()->with('message', 'Data Delete SuccessFully');
    }
}
