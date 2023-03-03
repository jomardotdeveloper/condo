<?php

use App\Http\Controllers\Admin\ClusterController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\UnitController;
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
    return view('layouts.admin.master');
});


Route::prefix("/admin")->group(function () {
    Route::resource('positions', PositionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('clusters', ClusterController::class);
    Route::resource('units', UnitController::class);
    
    // API
    Route::get('clusters/unit-towers/{cluster}', [ClusterController::class, 'getUnitTowers'])->name('clusters.unit-towers');
});