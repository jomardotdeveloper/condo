<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\ClusterController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\DebitController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ElectricController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EntryController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\MoveOutController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\ParkingController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RenovationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\SupplierItemController;
use App\Http\Controllers\Admin\TableViewController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\WaterController;
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
    // return view('welcome');
    return view('admin.login');
})->name('login');

Route::get('/application', [LoginController::class, 'application'])->name('application');

// ROUTE FOR ERRORS
Route::get('503', ErrorController::class . '@maintenance')->name('error.maintenance');
Route::get('404', ErrorController::class . '@notFound')->name('error.not-found');
Route::get('403', ErrorController::class . '@forbidden')->name('error.forbidden');

// ROUTE FOR AUTHENTICATION
Route::post('/admin/login', [App\Http\Controllers\Admin\LoginController::class, 'authenticate'])->name('admin.login');
Route::post('/admin/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');
Route::resource('applications', ApplicationController::class);

Route::prefix("/admin")->middleware('auth')->group(function () {
    Route::resource('positions', PositionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('clusters', ClusterController::class);
    Route::resource('units', UnitController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('move-outs', MoveOutController::class);
    Route::resource('renovations', RenovationController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('guests', GuestController::class);
    Route::resource('deliveries', DeliveryController::class);
    Route::resource('tablets', TableViewController::class);
    Route::resource('dealers', DealerController::class);
    Route::resource('parkings', ParkingController::class);

    Route::resource('announcements', AnnouncementController::class);

    Route::resource('invoices', InvoiceController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('banks', BankController::class);
    Route::resource('accounts', AccountController::class);
    Route::resource('settings', SettingController::class);

    Route::resource('entries', EntryController::class);
    Route::resource('waters', WaterController::class);
    Route::resource('electrics', ElectricController::class);
    Route::resource('debits', DebitController::class);
    Route::resource('subscriptions', SubscriptionController::class);

    Route::resource('owners', OwnerController::class);
    Route::resource('tenants', TenantController::class);

    Route::resource('vendors', VendorController::class);
    Route::resource('supplier-items', SupplierItemController::class);

    Route::resource('leave-types', LeaveTypeController::class);
    Route::resource('leaves', LeaveController::class);
    Route::get('/leaves/{leaf}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::get('/leaves/{leaf}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');

    Route::get('/attendances', [App\Http\Controllers\Admin\AttendanceController::class, 'attendance'])->name('attendances.index');
    Route::get('/attendances/time-in', [App\Http\Controllers\Admin\AttendanceController::class, 'timeIn'])->name('attendances.time-in');
    Route::get('/attendances/time-out', [App\Http\Controllers\Admin\AttendanceController::class, 'timeOut'])->name('attendances.time-out');

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'profile'])->name('admin.profile');
    Route::post('/change-personal-info', [App\Http\Controllers\Admin\ProfileController::class, 'changePersonalInformation'])->name('admin.profile.change-personal-info');
    Route::post('/change-password', [App\Http\Controllers\Admin\ProfileController::class, 'changePassword'])->name('admin.profile.change-password');
    // API
    Route::post('dealers/store-user', [DealerController::class, 'storeUser'])->name('dealers.store-user');
    Route::post('move-outs/store-invoice', [MoveOutController::class, 'storeInvoice'])->name('move-outs.store-invoice');
    Route::post('move-outs/store-payment', [MoveOutController::class, 'storePayment'])->name('move-outs.store-payment');
    Route::post('applications/store-invoice', [ApplicationController::class, 'storeInvoice'])->name('applications.store-invoice');
    Route::post('applications/store-payment', [ApplicationController::class, 'storePayment'])->name('applications.store-payment');
    Route::post('applications/store-user', [ApplicationController::class, 'storeUser'])->name('applications.store-user');
    Route::post('applications/store-attachment', [ApplicationController::class, 'storeAttachment'])->name('applications.store-attachment');
    Route::post('move-outs/store-attachment', [MoveOutController::class, 'storeAttachment'])->name('move-outs.store-attachment');
    Route::post('applications/{application}/move-to-status', [ApplicationController::class, 'moveToStatus'])->name('applications.move-status');
    Route::get('applications/{application_id}/{field}/signature', [ApplicationController::class, 'signApplication'])->name('applications.signature');
    Route::get('move-outs/{move_out_id}/{field}/signature', [MoveOutController::class, 'signApplication'])->name('move-outs.signature');
    Route::get('clusters/unit-towers/{cluster}', [ClusterController::class, 'getUnitTowers'])->name('clusters.unit-towers');
});