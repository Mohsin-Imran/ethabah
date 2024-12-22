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
                'user_id' => 'required',
                'time_of_investment' => 'required',
                'investment_fund' => 'required|string',
                'end_of_period' => 'required',
                'start_of_period' => 'required',
            ]);

            $investment = new InvestorRequest();
            $investment->user_id = auth()->user()->id;
            $investment->amount = $validatedData['amount'];
            $investment->end_of_period = $validatedData['end_of_period'];
            $investment->time_of_investment = $validatedData['time_of_investment'];
            $investment->investment_fund = $validatedData['investment_fund'];
            $investment->start_of_period = $validatedData['start_of_period'];
            $investment->save();
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
}
