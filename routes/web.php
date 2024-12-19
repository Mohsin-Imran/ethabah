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
use App\Http\Controllers\Company\CompanyController as CompanyCompanyController;
use App\Http\Controllers\Customer\RequestBikeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use ZipArchive;
use Illuminate\Http\Request;
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

Route::get('register/company', [CompanyCompanyController::class, 'index'])->name('company.register');
Route::post('register/company', [CompanyCompanyController::class, 'register'])->name('company.register');


Route::post('/download-zip', function (Request $request) {
    $zip = new ZipArchive();
    $zipFileName = 'files.zip';
    $zipFilePath = storage_path('app/public/' . $zipFileName);

    if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
        // Loop through the file URLs sent by the frontend
        foreach ($request->input('files') as $fileUrl) {
            // Extract the file path from the asset URL
            $filePath = public_path(str_replace(asset(''), '', $fileUrl));

            if (file_exists($filePath)) {
                // Add the file to the zip archive
                $zip->addFile($filePath, basename($filePath));
            }
        }
        $zip->close();

        // Return the ZIP file as a response
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    } else {
        return response()->json(['error' => 'Unable to create zip file'], 500);
    }
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

    // Route::controller(CompanyCompanyController::class)->group(function () {
    //     Route::post('register', 'register')->name('register');
    // });
});