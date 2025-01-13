<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignedCompany;
use App\Models\Category;
use App\Models\InvestmentFundCompany;
use App\Models\InvestorFunds;
use App\Models\InvestorRequest;
use App\Models\Payment;
use App\Models\RequestBike;
use App\Models\User;
use Carbon\Carbon;
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

        $companies = RequestBike::select(
            'company_id',
            DB::raw('SUM(total_funds) as total_funds'),
            DB::raw('MIN(id) as id') // Gets the smallest id in each group
        )
            ->with('company') // Ensure 'company' is a valid relationship
            ->where('status', 1)
            ->groupBy('company_id')
            ->get();

        return view('admin.investor_funds.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'company_id' => 'required|array',
            'company_id.*' => 'exists:companies,id',
            'category_id' => 'required|string',
            'name' => 'required|string',
            'profit_percentage' => 'required|string',
            'duration_of_investment' => 'required|string',
        ]);

        $investorFund = new InvestorFunds;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($investorFund->image && file_exists(public_path('investorFund/' . $investorFund->image))) {
                unlink(public_path('investorFund/' . $investorFund->image));
            }
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('investorFund'), $imageName);
            $investorFund->image = $imageName;
        }
        $investorFund->user_id = auth()->user()->id;
        $investorFund->category_id = $request->category_id;
        $investorFund->name = $request->name;
        $investorFund->profit = $request->profit;
        $investorFund->amount = $request->amount;
        $investorFund->profit_percentage = $request->profit_percentage;
        $investorFund->total_funds = $request->input('total_funds');
        $investorFund->month = $request->month;
        $investorFund->custom_months = $request->custom_months;
        // $investorFund->end_of_period = $request->end_of_period;
        $investorFund->start_of_period = $request->start_of_period;
        if ($request->start_of_period) {
            $startOfPeriod = Carbon::parse($request->start_of_period);
            if ($request->profit == 'monthly') {
                $newEndOfPeriod = $startOfPeriod->addMonth();
                $investorFund->end_of_period = $newEndOfPeriod->toDateString();
            }
            elseif ($request->profit == 'quarterly') {
                $newEndOfPeriod = $startOfPeriod->addMonths(3);
                $investorFund->end_of_period = $newEndOfPeriod->toDateString();
            }
            elseif ($request->profit == 'yearly') {
                $newEndOfPeriod = $startOfPeriod->addYear();
                $investorFund->end_of_period = $newEndOfPeriod->toDateString();
            }
            elseif ($request->profit == 'custom' && $request->has('custom_months')) {
                $investorFund->custom_months = $request->custom_months;
                $startOfPeriod = Carbon::parse($request->start_of_period);
                $newEndOfPeriod = $startOfPeriod->addMonths($request->custom_months);
                $investorFund->end_of_period = $newEndOfPeriod->toDateString();
            }
        }
        $investorFund->duration_of_investment = $request->duration_of_investment;
        $investorFund->save();

        $companyIds = $request->company_id;
        $requestIds = explode(',', $request->selected_company_ids);
        foreach ($companyIds as $index => $companyId) {
            $investorFundCompany = new InvestmentFundCompany();
            $investorFundCompany->investor_funds_id = $investorFund->id;
            $investorFundCompany->request_id = $requestIds[$index];
            $investorFundCompany->company_id = $companyId;
            $investorFundCompany->save();
        }

        return redirect()->route('admin.investor.funds.index')->with('message', 'Data added successfully');
    }

    public function view($id)
    {
        // Fetch InvestorFunds with related investmentFundCompanies
        $investorFund = InvestorFunds::with('investmentFundCompanies')->findOrFail($id);
        $investorFund->increment('viewer');
        $amountSum = InvestorRequest::where('investor_funds_id', $id)->sum('amount');
        $investorRequest = InvestorRequest::with(['user', 'investmentFund.companies'])->where('investor_funds_id', $id)->get();
        $userIds = $investorRequest->pluck('user_id');
        $payments = Payment::whereIn('user_id', $userIds)->get()->groupBy('user_id');
        foreach ($investorRequest as $request) {
            $profitPercentage = $request->investmentFund->profit_percentage ?? 0;
            $request->calculatedProfit = ($request->amount * $profitPercentage) / 100;
            $request->profitPercentage = $profitPercentage;
            $userPayments = $payments->get($request->user_id, collect());
            $request->payments = $userPayments;
        }
        return view('admin.investor_funds.view', compact('investorFund', 'payments', 'amountSum', 'investorRequest'));
    }

    public function edit($id)
    {
        $investorFund = InvestorFunds::findOrFail($id);
        $investors = User::where('role', 0)->get();
        $categories = Category::all();
        $companies = RequestBike::select(
            'company_id',
            DB::raw('SUM(total_funds) as total_funds'),
            DB::raw('MIN(id) as id') // Gets the smallest id in each group
        )
            ->with('company') // Ensure 'company' is a valid relationship
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
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($investorFund->image && file_exists(public_path('investorFund/' . $investorFund->image))) {
                unlink(public_path('investorFund/' . $investorFund->image));
            }
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('investorFund'), $imageName);
            $investorFund->image = $imageName;
        }
        $investorFund->user_id = auth()->user()->id;
        $investorFund->category_id = $request->category_id;
        $investorFund->name = $request->name;
        $investorFund->profit = $request->profit;
        $investorFund->amount = $request->amount;
        $investorFund->custom_months = $request->custom_months;
        $investorFund->profit_percentage = $request->profit_percentage;
        $investorFund->total_funds = $request->input('total_funds');
        $investorFund->month = $request->month;
        $investorFund->start_of_period = $request->start_of_period;
        if ($request->start_of_period) {
            $startOfPeriod = Carbon::parse($request->start_of_period);
            if ($request->profit == 'monthly') {
                $newEndOfPeriod = $startOfPeriod->addMonth();
                $investorFund->end_of_period = $newEndOfPeriod->toDateString();
            }
            elseif ($request->profit == 'quarterly') {
                $newEndOfPeriod = $startOfPeriod->addMonths(3);
                $investorFund->end_of_period = $newEndOfPeriod->toDateString();
            }
            elseif ($request->profit == 'yearly') {
                $newEndOfPeriod = $startOfPeriod->addYear();
                $investorFund->end_of_period = $newEndOfPeriod->toDateString();
            }
        }
        $investorFund->duration_of_investment = $request->duration_of_investment;
        $investorFund->save();
        // $investorFund->companies()->sync($request->company_id);

        // Handle saving request_ids (data-ids from the select options)
        $companyIds = $request->company_id; // Array of selected company IDs
        $requestIds = explode(',', $request->selected_company_ids); // Get the data-ids for each selected company

        // Loop through each selected company and update the pivot table
        foreach ($companyIds as $index => $companyId) {
            $investorFundCompany = InvestmentFundCompany::where('investor_funds_id', $investorFund->id)
                ->where('company_id', $companyId)
                ->first();
            if (!$investorFundCompany) {
                $investorFundCompany = new InvestmentFundCompany();
            }

            // Update the relationship and the request_id (data-ids)
            $investorFundCompany->investor_funds_id = $investorFund->id;
            $investorFundCompany->company_id = $companyId;
            $investorFundCompany->request_id = $requestIds[$index]; // Set the corresponding request_id
            $investorFundCompany->save();
        }
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

    public function payment(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'amount' => 'required',
        ]);
        $payment = new Payment();
        $payment->user_id = $request->user_id;
        $payment->investor_funds_id = $request->investor_funds_id;
        $payment->amount = $request->amount;
        $payment->created_by = auth()->user()->id;
        if ($payment->save()) {
            return redirect()->back()->with('message', 'Request added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to save data');
        }
    }

}
