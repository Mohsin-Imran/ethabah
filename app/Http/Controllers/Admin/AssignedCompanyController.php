<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignedCompany;
use App\Models\Category;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class AssignedCompanyController extends Controller
{
    public function index()
    {
        $assignedCompanies = AssignedCompany::with('company')->get();
        return view('admin.assigned_Company.index', get_defined_vars());
    }

    public function create()
    {
        $categories = Category::all();
        $companies = Company::all();
        return view('admin.assigned_Company.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|array',
            'category_id' => 'required|exists:categories,id',
        ]);

        foreach ($request->company_id as $company_id) {
            $assignedCompany = new AssignedCompany;
            $assignedCompany->user_id = auth()->user()->id;
            $assignedCompany->company_id = $company_id;
            $assignedCompany->category_id = $request->category_id;
            $assignedCompany->save();
        }
        return redirect()->route('admin.assigned.company.index')->with('message', 'Data updated successfully');
    }

    public function edit($id)
    {
        $assignedCompany = AssignedCompany::find($id);
        $categories = Category::all();
        $companies = Company::all();
        return view('admin.assigned_Company.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company_id' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $assignedCompany = AssignedCompany::find($id);
        $assignedCompany->user_id = auth()->user()->id;
        $assignedCompany->company_id = $request->company_id;
        $assignedCompany->category_id = $request->category_id;
        $assignedCompany->save();
        return redirect()->route('admin.assigned.company.index')->with('message', 'Data updated successfully');
    }

    public function destroy($id)
    {
        $assignedCompany = AssignedCompany::find($id);
        $assignedCompany->delete();
        return back()->with('message', 'Data Delete SuccessFully');
    }
}
