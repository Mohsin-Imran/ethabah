<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvestorFunds;
use App\Models\InvestorRequest;
use App\Models\ProjectUpdate;

class InvestorFundsController extends Controller
{
    public function index()
    {
        try {
            $investmentFunds = InvestorFunds::with('investmentFundCompanies.companies')->get();
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
            $investmentFunds = InvestorFunds::select('name', 'id')->get();
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

    public function investorFundAndDocuments()
    {
        try {
            $investmentFunds = InvestorRequest::where('user_id',auth()->user()->id)->with('investmentFund.investmentFundCompanies.company:id,name')->get();
            $projects = [];
            foreach ($investmentFunds as $investmentFund) {
                foreach ($investmentFund->investmentFund->investmentFundCompanies as $company) {
                    $project = ProjectUpdate::where('company_id', $company->company->id)->first();

                    if ($project && !in_array($project->id, array_column($projects, 'id'))) {
                        $projects[] = $project;
                    }
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Investment Funds and associated projects retrieved successfully.',
                'data' => $investmentFunds,
                'projects' => $projects,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching investment funds.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}