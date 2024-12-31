<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignedCompany;
use App\Models\Category;
use App\Models\InvestorFunds;
use App\Models\InvestorRequest;
use App\Models\RequestBike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestorFundsController extends Controller
{
    public function index()
    {
        $investorCounts = InvestorRequest::select('investor_funds_id', DB::raw('COUNT(*) as count'))
            ->groupBy('investor_funds_id')
            ->pluck('count', 'investor_funds_id');
        $investorFunds = InvestorFunds::withCount(['investmentFundCompanies as investmentFundCount'])->get();

        // Attach investor counts to each fund
        foreach ($investorFunds as $fund) {
            $fund->investorCounts = $investorCounts[$fund->id] ?? 0; // Default to 0 if no investors
        }

        return view('admin.investor_funds.index', compact('investorFunds'));
    }

    public function create()
    {
        $investors = User::where('role', 0)->get();
        $assignedCompanies = AssignedCompany::with('company')->get();
        $categories = Category::all();

        $companies = RequestBike::select('company_id', DB::raw('SUM(total_funds) as total_funds'))
            ->with('company')
            ->where('status', 1)
            ->groupBy('company_id')
            ->get();
        return view('admin.investor_funds.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|array',
            'company_id.*' => 'exists:companies,id',
            'category_id' => 'required|string',
            'name' => 'required|string',
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
        $investorFund->total_funds = $request->input('total_funds');
        $investorFund->month = $request->month;
        $investorFund->end_of_period = $request->end_of_period;
        $investorFund->start_of_period = $request->start_of_period;
        $investorFund->duration_of_investment = $request->duration_of_investment;
        $investorFund->save();

        $investorFund->companies()->attach($request->company_id);

        return redirect()->route('admin.investor.funds.index')->with('message', 'Data added successfully');
    }

    public function view($id)
    {
        $investorFund = InvestorFunds::with('investmentFundCompanies')->findOrFail($id);
        $amountSum = InvestorRequest::where('investor_funds_id', $id)->sum('amount');
        $investorRequest = InvestorRequest::with(['user', 'investmentFund.companies'])->where('investor_funds_id', $id)->get();
        foreach ($investorRequest as $request) {
            $profitPercentage = $request->investmentFund->profit_percentage ?? 0;
            $request->calculatedProfit = ($request->amount * $profitPercentage) / 100;
            $request->profitPercentage = $profitPercentage;
        }
        return view('admin.investor_funds.view', compact('investorFund', 'amountSum', 'investorRequest'));
    }

    public function edit($id)
    {
        $investorFund = InvestorFunds::findOrFail($id);
        $investors = User::where('role', 0)->get();
        $categories = Category::all();
        $companies = RequestBike::select('company_id', DB::raw('SUM(total_funds) as total_funds'))
            ->with('company') // Ensure the company relationship is eager-loaded
            ->where('status', 1)
            ->groupBy('company_id')
            ->get();
        return view('admin.investor_funds.edit', compact('investorFund', 'investors', 'categories', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company_id' => 'required|array',
            'company_id.*' => 'exists:companies,id',
            'category_id' => 'required|string',
            'name' => 'required|string',
            'profit_percentage' => 'required|string',
            'duration_of_investment' => 'required|string',
        ]);

        $investorFund = InvestorFunds::findOrFail($id);
        $investorFund->user_id = auth()->user()->id;
        $investorFund->category_id = $request->category_id;
        $investorFund->name = $request->name;
        $investorFund->profit = $request->profit;
        $investorFund->amount = $request->amount;
        $investorFund->profit_percentage = $request->profit_percentage;
        $investorFund->total_funds = $request->input('total_funds');
        $investorFund->month = $request->month;
        $investorFund->end_of_period = $request->end_of_period;
        $investorFund->start_of_period = $request->start_of_period;
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

    public function updateStatus(Request $request, $id)
    {
        $investorFund = InvestorFunds::findOrFail($id);
        $investorFund->status = $request->status;
        $investorFund->save();
        return redirect()->back()->with('message', 'Status updated successfully.');
    }

}
