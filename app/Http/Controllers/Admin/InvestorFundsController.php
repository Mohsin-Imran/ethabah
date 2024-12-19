<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignedCompany;
use App\Models\Category;
use App\Models\Company;
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
        $companies = Company::all();
        return view('admin.investor_funds.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|array',
            'company_id.*' => 'exists:companies,id',
            'category_id' => 'required|string',
            'name' => 'required|string',
            'profit' => 'required|string',
            'amount' => 'required|string',
            'profit_percentage' => 'required|string',
            'duration_of_investment' => 'required|string',
        ]);

        $investorFund = new InvestorFunds;
        $investorFund->user_id = auth()->user()->id;
        $investorFund->category_id = $request->category_id;
        $investorFund->name = $request->name;
        $investorFund->profit = $request->profit;
        $investorFund->amount = $request->amount;
        $investorFund->profit_percentage = $request->profit_percentage;
        $investorFund->duration_of_investment = $request->duration_of_investment;
        $investorFund->save();

        $investorFund->companies()->attach($request->company_id);

        return redirect()->route('admin.investor.funds.index')->with('message', 'Data added successfully');
    }

    public function view($id)
    {
        $investorFund = InvestorFunds::with('companies')->findOrFail($id);
        return view('admin.investor_funds.view', compact('investorFund'));
    }
    public function edit($id)
    {
        $investorFund = InvestorFunds::findOrFail($id); // Ensures the record exists
        $investors = User::where('role', 0)->get();
        $categories = Category::all();
        $companies = Company::all();
        return view('admin.investor_funds.edit', compact('investorFund', 'investors', 'categories', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company_id' => 'required|array',
            'company_id.*' => 'exists:companies,id',
            'category_id' => 'required|string',
            'name' => 'required|string',
            'profit' => 'required|string',
            'amount' => 'required|string',
            'profit_percentage' => 'required|string',
            'duration_of_investment' => 'required|string',
        ]);

        $investorFund = InvestorFunds::findOrFail($id);
        $investorFund->category_id = $request->category_id;
        $investorFund->name = $request->name;
        $investorFund->profit = $request->profit;
        $investorFund->amount = $request->amount;
        $investorFund->profit_percentage = $request->profit_percentage;
        $investorFund->duration_of_investment = $request->duration_of_investment;
        $investorFund->save();
        $investorFund->companies()->sync($request->company_id);
        return redirect()->route('admin.investor.funds.index')->with('message', 'Data updated successfully');
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