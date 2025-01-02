<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('admin.companies.index', get_defined_vars());
    }

    public function view($id)
    {
        $company = Company::find($id);
        return view('admin.companies.view', data: get_defined_vars());
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3',
        ]);
        $company = Company::findOrFail($id);
        $company->status = $request->status;
        $company->save();

        $relatedUsers = User::where('company_id', $company->id)->get();
        foreach ($relatedUsers as $user) {
            $user->status = $request->status;
            $user->save();
        }

        return redirect()->back()->with('message', 'Status updated successfully.');
    }
}
