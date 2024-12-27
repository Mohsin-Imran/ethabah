<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvestorRequest;
use App\Models\ProjectUpdate;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProjectUpdateDocument extends Controller
{

    public function index()
    {
        try {
            $projectDocuments = ProjectUpdate::where('user_id', auth()->user()->id)->get();
            return response()->json([
                'success' => true,
                'message' => 'projectDocuments retrieved successfully.',
                'data' => $projectDocuments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching categories.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'document' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5048',
                'project_id' => 'required',
                'update_name' => 'required',
            ]);

            $project = new ProjectUpdate();
            if ($request->hasFile('document') && $request->file('document')->isValid()) {
                $documentName = time() . '_' . $request->file('document')->getClientOriginalName();
                $filePath = $request->file('document')->move(public_path('document'), $documentName);
                $project->document = $documentName;
            }
            $project->user_id = auth()->user()->id;
            $project->company_id = auth()->user()->company_id;
            $project->update_name = $validatedData['update_name'];
            $project->project_id = $validatedData['project_id'];
            $project->save();
            return response()->json([
                'message' => 'Project created successfully.',
                'project' => $project,
            ], 201);

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

    public function getInvestorDoc()
    {
        try {
            // Fetching data with necessary relationships
            $data = InvestorRequest::with('investmentFund.investmentFundCompanies.company')
                ->get()
                ->flatMap(function ($investorRequest) {
                    return $investorRequest->investmentFund
                        ->investmentFundCompanies
                        ->pluck('company.id');
                })
                ->toArray(); // Flatten and convert to array

            $projectDocuments = ProjectUpdate::whereIn('company_id', $data)->get();

            return response()->json([
                'success' => true,
                'message' => 'All Investor Requests retrieved successfully.',
                'data' => $projectDocuments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching Investor Requests.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
