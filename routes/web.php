<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\ClusterController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\MoveOutController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PaymentController;
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
    return view('admin.login');
})->name('login');

Route::get('/application', [LoginController::class, 'application'])->name('application');

// ROUTE FOR ERRORS
Route::get('503', ErrorController::class . '@maintenance')->name('error.maintenance');
Route::get('404', ErrorController::class . '@notFound')->name('error.not-found');


// ROUTE FOR AUTHENTICATION
Route::post('/admin/login', [App\Http\Controllers\Admin\LoginController::class, 'authenticate'])->name('admin.login');


Route::prefix("/admin")->middleware('auth')->group(function () {
    Route::resource('positions', PositionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('clusters', ClusterController::class);
    Route::resource('units', UnitController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('move-outs', MoveOutController::class);
    Route::resource('applications', ApplicationController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('payments', PaymentController::class);



    // API
    Route::post('applications/{application}/move-to-status', [ApplicationController::class, 'moveToStatus'])->name('applications.move-status');
    Route::get('clusters/unit-towers/{cluster}', [ClusterController::class, 'getUnitTowers'])->name('clusters.unit-towers');
});