<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvestorFunds;

class InvestorFundsController extends Controller
{
    public function index()
    {
        try {
            $investmentFunds = InvestorFunds::with('investmentFundCompanies')->get();
            return response()->json([
                'success' => true,
                'message' => 'Investment Funds retrieved successfully.',
                'data' => $investmentFunds,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching investment funds.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function investmentFundsNames()
    {
        try {
            $investmentFunds = InvestorFunds::select('name','id')->get();
            return response()->json([
                'success' => true,
                'message' => 'Investment Funds Names retrieved successfully.',
                'data' => $investmentFunds,
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
