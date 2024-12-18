<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignedCompany;
use App\Models\Category;
use App\Models\InvestorFunds;
use App\Models\User;
use Illuminate\Http\Request;

class InvestorFundsController extends Controller
{
    public function index()
    {
        $investorFunds = InvestorFunds::all();
        return view('admin.investor_funds.index', get_defined_vars());
    }

    public function create()
    {
        $investors = User::where('role', 0)->get();
        $assignedCompanies = AssignedCompany::with('company')->get();
        $categories = Category::all();
        return view('admin.investor_funds.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'company_id' => 'required|string',
            'category_id' => 'required|string',
            'profit_percentage' => 'required|string',
            'duration_of_investment' => 'required|string',

        ]);
        $investorFund = new InvestorFunds;
        $investorFund->created_id = auth()->user()->id;
        $investorFund->user_id = $request->user_id;
        $investorFund->category_id = $request->category_id;
        $investorFund->company_id = $request->company_id;
        $investorFund->profit_percentage = $request->profit_percentage;
        $investorFund->duration_of_investment = $request->duration_of_investment;
        $investorFund->message = $request->message;
        $investorFund->save();
        return redirect()->route('admin.investor.funds.index')->with('message', 'Data added successfully');
    }

    public function view($id)
    {
        $investorFund = InvestorFunds::find($id);
        return view('admin.investor_funds.view', compact('investorFund'));
    }
    public function edit($id)
    {
        $investorFund = InvestorFunds::findOrFail($id); // Ensures the record exists
        $investors = User::where('role', 0)->get();
        $categories = Category::all();
        $companies = AssignedCompany::with('company')
            ->where('category_id', $investorFund->category_id)
            ->get();
        return view('admin.investor_funds.edit', compact('investorFund', 'investors', 'categories', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'required|exists:companies,id',
            'profit_percentage' => 'required|numeric',
            'duration_of_investment' => 'required|numeric',
        ]);

        $investorFund = InvestorFunds::findOrFail($id); // Ensure record exists
        $investorFund->created_id = auth()->user()->id;
        $investorFund->user_id = $request->user_id;
        $investorFund->category_id = $request->category_id;
        $investorFund->company_id = $request->company_id;
        $investorFund->profit_percentage = $request->profit_percentage;
        $investorFund->duration_of_investment = $request->duration_of_investment;
        $investorFund->message = $request->message;
        $investorFund->save();

        return redirect()->route('admin.investor.funds.index')->with('message', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $investorFund = InvestorFunds::find($id);
        $investorFund->delete();
        return back()->with('message', 'Data Delete SuccessFully');
    }
    public function getCompaniesByCategory(Request $request)
    {
        $companies = AssignedCompany::with('company')
            ->where('category_id', $request->category_id)
            ->get();

        return response()->json($companies);
    }

}
