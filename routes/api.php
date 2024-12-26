<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\InvestorFundsController;
use App\Http\Controllers\Api\InvestorRequestController;
use App\Http\Controllers\Api\ProjectUpdateDocument;
use App\Http\Controllers\Api\RequestController;
use App\Models\InvestorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);

Route::post('/company/store', [ApiController::class, 'store']);
Route::get('/get/categories', [CategoryController::class, 'index']);

// Routes requiring authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/request/store', [RequestController::class, 'store']);
    Route::get('/request/get', [RequestController::class, 'index']);
    Route::get('/request/status/count', [RequestController::class, 'dataCount']);
    Route::post('/investor/request/store', [InvestorRequestController::class, 'store']);
    Route::post('/project/update/docu', [ProjectUpdateDocument::class, 'store']);
    Route::get('/project/investor/docu/get', [ProjectUpdateDocument::class, 'getInvestorDoc']);
    Route::get('/project/update/docu/get', [ProjectUpdateDocument::class, 'index']);
    Route::get('/investment/funds/get', [InvestorFundsController::class, 'index']);
    Route::get('/investment/funds/name/get', [InvestorFundsController::class, 'investmentFundsNames']);
    Route::get('/investor/request/data/get', [InvestorRequestController::class, 'getInvestorData']);
});

// Fallback route
Route::fallback(function () {
    return response()->json(['error' => 'Route not found'], 404);
});
