<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvestorRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InvestorRequestController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'amount' => 'required|numeric',
                'time_of_investment' => 'required',
                'end_of_period' => 'required',
                'investor_funds_id' => 'required',
                'start_of_period' => 'required',
            ]);

            // Create a new InvestorRequest
            $investment = new InvestorRequest();
            $investment->user_id = auth()->user()->id;
            $investment->investor_funds_id = $validatedData['investor_funds_id'];
            $investment->amount = $validatedData['amount'];
            $investment->end_of_period = $validatedData['end_of_period'];
            $investment->time_of_investment = $validatedData['time_of_investment'];
            $investment->start_of_period = $validatedData['start_of_period'];
            $investment->save();

            // $investmentFundCompany = InvestmentFundCompany::find($validatedData['investor_funds_id']);

            // if ($investmentFundCompany) {
            //     $investmentFundCompany->investor_id = $validatedData['investor_funds_id'];
            //     $investmentFundCompany->update();
            // }

            return response()->json([
                'message' => 'Investment created successfully.', 'investment' => $investment], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getInvestorData()
    {
        try {
            // Fetching data with necessary relationships
            $data = InvestorRequest::with('investmentFund.investmentFundCompanies.company')
                ->where('user_id',auth()->user()->id)
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'All Investor Requests retrieved successfully.',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching Investor Requests.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function investorDashboard()
    {
        try {
            $investmentFunds = InvestorRequest::where('user_id', auth()->user()->id)
                ->with('investmentFund') 
                ->get();
            $allInvestmentFunds = $investmentFunds->pluck('investmentFund')->flatten();
            $investorpendingStatus = $allInvestmentFunds->where('status', '!=', 1)->count();  
            $investorapprovedStatus = $allInvestmentFunds->where('status', 1)->count(); 
            $investorAmount = InvestorRequest::where('user_id', auth()->user()->id)->sum('amount');
        
            return response()->json([
                'success' => true,
                'message' => 'Investor Dashboard Data.',
                'investorapprovedStatus' => $investorapprovedStatus,
                'investorpendingStatus' => $investorpendingStatus,
                'investorAmount' => $investorAmount,  
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching investment funds names.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}