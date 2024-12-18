<?php

use App\Http\Controllers\Admin\AssignedCompanyController;
use App\Http\Controllers\Admin\BikeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvestorController;
use App\Http\Controllers\Admin\InvestorFundsController;
use App\Http\Controllers\Admin\RequestBikeController as AdminRequestBikeController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\VehicleFundsController;
use App\Http\Controllers\Company\DashboardController as CompanyDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer\BikeController as CustomerBikeController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\RequestBikeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::any('logout', [HomeController::class, 'logout'])->name('logout');
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::controller(CategoryController::class)->prefix('category/')->name('category.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::controller(BikeController::class)->prefix('bike/')->name('bike.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('view', 'view')->name('view');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::controller(AdminRequestBikeController::class)->prefix('request/')->name('request.bike.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
        Route::get('view/{id}', 'view')->name('view');
        Route::get('accept/{id}', 'acceptRequest')->name('acceptRequest');
        Route::get('decline/{id}', 'declineRequest')->name('declineRequest');
    });

    Route::controller(VehicleFundsController::class)->prefix('fund/bike/')->name('fund.bike.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::controller(CompanyController::class)->prefix('company/')->name('company.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('view/{id}', 'view')->name('view');
        Route::post('status/{id}', 'updateStatus')->name('status');
    });

    Route::controller(InvestorFundsController::class)->prefix('investor/funds')->name('investor.funds.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('view/{id}', 'view')->name('view');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
        Route::get('getCompaniesByCategory',  'getCompaniesByCategory')->name('getCompaniesByCategory');
    });


    Route::controller(AssignedCompanyController::class)->prefix('assigned/company')->name('assigned.company.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('view/{id}', 'view')->name('view');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });
    Route::controller(InvestorController::class)->prefix('investor/')->name('investor.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('view/{id}', 'view')->name('view');
        Route::post('status/{id}', 'updateStatus')->name('status');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::controller(StatisticController::class)->prefix('statistic/')->name('statistic.')->group(function () {
        Route::get('index', 'index')->name('index');
    });
});



Route::middleware(['auth', 'company'])->prefix('company')->name('company.')->group(function () {
    Route::get('dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');
});
