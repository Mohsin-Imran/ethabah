<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RequestBike;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RequestController extends Controller
{

    public function index()
    {
        $requestData = RequestBike::with('user')->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($requestData->isEmpty()) {
            return response()->json([
                'error' => 'No request bikes found for the authenticated user.',
                'status' => false,
            ], 404);
        }
        return response()->json([
            'data' => $requestData,
            'status' => true,
        ], 200);
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'purpose_of_funding' => 'required|string|max:255',
                'total_funds' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'request_document' => 'required',
            ]);

            $requestData = new RequestBike;
            if ($request->hasFile('request_document') && $request->file('request_document')->isValid()) {
                $imageName = time() . '.' . $request->file('request_document')->getClientOriginalExtension();
                $request->file('request_document')->move(public_path('request_document'), $imageName);
                $requestData->request_document = $imageName;
            } else {
                return response()->json([
                    'message' => 'Image file is required or invalid.',
                ], 400);
            }
            $requestData->user_id = auth()->user()->id;
            $requestData->name = $validatedData['name'];
            $requestData->category = $validatedData['category'];
            $requestData->purpose_of_funding = $validatedData['purpose_of_funding'];
            $requestData->total_funds = $validatedData['total_funds'];
            $requestData->description = $validatedData['description'];
            $requestData->save();
            return response()->json([
                'message' => 'Request Bike data saved successfully.',
                'data' => $requestData,
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

    public function dataCount()
    {
        $id = auth()->user()->id;

        $requestApproved = RequestBike::where('user_id', $id)
            ->where('status', 1)
            ->count();

        $requestPending = RequestBike::where('user_id', $id)
            ->where('status', 0)
            ->count();

        $requestFundsSum = RequestBike::where('user_id', $id)
            ->sum('total_funds');

        return response()->json([
            'approved_requests' => $requestApproved,
            'pending_requests' => $requestPending,
            'requests_with_funds' => $requestFundsSum,
            'status' => true,
        ], 200);
    }
}