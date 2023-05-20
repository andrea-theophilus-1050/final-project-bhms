<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\House\HouseController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Tenants\TenantController;
use App\Http\Controllers\Service\ServicesController;
use App\Http\Controllers\Calculation\WaterController;
use App\Http\Controllers\Calculation\ElectricityController;
use App\Http\Controllers\Calculation\CostsIncurredController;
use App\Http\Controllers\Calculation\RoomBillingController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\TenantRole\AuthTenantController;
use App\Http\Controllers\TenantRole\HandleTenantController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ExportPDFController;
use App\Http\Controllers\Mail\SendMailController;
use App\Http\Controllers\Payment\PaymentVNPayController;
use App\Http\Controllers\TenantRole\PaymentVNPayController as TenantPaymentVNPayController;
use App\Http\Controllers\SendSMSController;
use App\Http\Controllers\Room\ReturnRoomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/   

Route::get('/', function () {
    return redirect()->route('login');
});


Route::controller(UserController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'login_action')->name('login.action');
    Route::get('register', 'register')->name('register');
    Route::post('register', 'register_action')->name('register.action');
    Route::get('logout', 'logout')->name('logout');
});

//NOTE: Route forgot password
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('forgot-password', 'index')->middleware('guest')->name('forgot-password');
    Route::post('forgot-password', 'sendResetLinkEmail')->middleware('guest')->name('send-reset-link-email');
    Route::post('reset-password', 'resetPassword')->middleware('guest')->name('password.update');
});

Route::get('/reset-password/{token}', function ($token) {
    return view('user.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


//NOTE: Route verify email
Route::get('email/verify', function () {
    return view('user.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('resent', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//NOTE: Route auth user role landlords
Route::middleware(['auth', 'verified', 'userRole:landlords'])->group(function () {
    Route::group(['prefix' => 'landlords'], function () {
        Route::middleware('checkProfile')->group(function () {
            Route::middleware('checkPriceChangedFirst')->group(function () {

                Route::get('dashboard', [DashboardController::class, 'index'])->name('home');

                Route::group(['prefix' => 'dashboard'], function () {

                    Route::resource('payment', PaymentVNPayController::class);

                    Route::resource('house', HouseController::class);

                    Route::group(['prefix' => 'house'], function () {
                        Route::controller(RoomController::class)->group(function () {
                            Route::get('{id}/list-room/', 'index')->name('room.index');
                            Route::post('room/{id}/add-action', 'addSingleRoom')->name('room.add');
                            Route::post('room/{id}/add-multiple-room-action', 'addMultipleRooms')->name('room.add.multiple');
                            Route::post('room/{id}/update-action', 'update')->name('room.update');
                            Route::post('room/{id}/room-delete', 'delete')->name('room.delete');
                            Route::post('room/delete-multiple', 'deleteMultiple')->name('room.delete.multiple');

                            Route::get('room/{id}/assignTenant', 'assignTenant')->name('room.assign-tenant');
                            Route::post('room/{id}/assignTenant', 'assignTenant_action')->name('room.assign-tenant-action');

                            Route::get('room/{id}/update-services-used/{rental_id}', 'editServicesUsed')->name('room.edit-tenant');
                            Route::post('room/{id}/update-services-used/{rental_id}', 'editServicesUsed_action')->name('room.update-tenant-action');

                            Route::post('room/assignMembers', 'assignMembers')->name('assign-members');

                            Route::get('export-rooms/{houseID}', [RoomController::class, 'exportRooms'])->name('export-rooms');

                            Route::post('room/search/{id}', [RoomController::class, 'search'])->name('room.search');
                        });
                    });

                    // Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');

                    Route::resource('tenant', TenantController::class);
                    Route::post('tenant/search', [TenantController::class, 'search'])->name('tenant.search');
                    Route::get('/export-tenant', [TenantController::class, 'exportTenant'])->name('export-tenant');
                    Route::get('send-account-info/{id}', [TenantController::class, 'sendAccountInfo'])->name('notify.account-info.email');
                    Route::get('send-account-info-sms/{id}', [TenantController::class, 'sendAccountInfo_SMS'])->name('notify.account-info.sms');


                    Route::controller(ElectricityController::class)->group(function () {
                        Route::get('electricity-bill/{date}/{house}', 'electricity_bill')->name('electricity-bill');
                        Route::post('electricity-filter', 'electricity_filter')->name('electricity-filter');
                        Route::post('electricity-insert', 'electricity_insert')->name('electricity.insert');

                        Route::get('export-electricity/{date}', [ElectricityController::class, 'exportElectricity'])->name('export-electricity');
                    });

                    Route::controller(WaterController::class)->group(function () {
                        Route::get('water-bill/{date}/{house}', 'water_bill')->name('water-bill');
                        Route::post('water-filter', 'water_filter')->name('water-filter');
                        Route::post('water-insert', 'water_insert')->name('water.insert');

                        Route::get('export-water/{date}', [WaterController::class, 'exportWater'])->name('export-water');
                    });

                    Route::controller(CostsIncurredController::class)->group(function () {
                        Route::post('costs-incurred-filter', 'filter')->name('costs-incurred.filter');
                        Route::get('costs-incurred', 'costs_incurred')->name('costs-incurred');
                        Route::get('costs-incurred/add', 'add_costs_incurred')->name('costs-incurred.add');
                        Route::post('costs-incurred-action', 'costs_incurred_action')->name('add.costs-incurred.action');
                        Route::get('update-costs-incurred/{id}', 'update_costs_incurred')->name('costs-incurred.update');
                        Route::post('update-costs-incurred-action/{id}', 'update_costs_incurred_action')->name('update.costs-incurred.action');
                        Route::post('costs-incurred-delete/{id}', 'cost_incurred_delete')->name('cost_incurred.delete');
                    });

                    Route::controller(RoomBillingController::class)->group(function () {
                        Route::get('room-billing/{month}/{house}', 'room_billing')->name('room-billing');
                        Route::post('calculate-room-billing', 'calculateRoomBilling')->name('calculate.room-billing');
                        Route::post('update-status-bill/{id}', 'updateStatusBill')->name('update-status-bill');

                        Route::get('/export-bill/{month}', 'exportBillExcel')->name('export-bill');

                        Route::get('test', 'test')->name('test');
                    });

                    Route::controller(ReturnRoomController::class)->group(function () {
                        Route::post('room/return', 'returnRoom')->name('room.return');
                        Route::post('confirm-return-room', 'confirmReturnRoom')->name('confirm-return-room');
                        Route::post('cancel-return-room', 'cancelReturnRoom')->name('room.cancelReturn');

                        // Route::get('handle-returned-room/{roomID}/{tenantID}/{rentalID}', 'handleReturnedRoom')->name('handle-returned-room');
                        // Route::post('service-insert', 'serviceInsert')->name('return.service-bill.insert');
                    });

                    Route::get('export-bill-pdf/{month}/{house}', [ExportPDFController::class, 'exportPDF'])->name('export-pdf');
                    Route::post('send-mail-bill/{month}/{house}', [SendMailController::class, 'sendMailBill'])->name('mail.send-bill');
                    Route::post('sendSMS/{month}/{house}', [SendSMSController::class, 'sendSMS'])->name('sms.send-bill');

                    Route::get('feedback', [DashboardController::class, 'feedback'])->name('feedback');
                    Route::post('solve-feedback', [DashboardController::class, 'solveFeedback'])->name('feedback.solve');
                    Route::post('delete-feedback/{id}', [DashboardController::class, 'deleteFeedback'])->name('landlords.feedback.delete');
                });
            });
            Route::resource('services', ServicesController::class);
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/dashboard/profile', 'profile')->name('profile');
            Route::post('/dashboard/update-profile', 'updateProfile')->name('update-profile');

            Route::get('clear-notification', 'clearNotification')->name('clear-notification');
            Route::get('handle-notify/{id}', 'handleNotify')->name('handle-notify');
        });
    });
});




// NOTE: Route auth user role tenants
Route::get('tenant/login', [AuthTenantController::class, 'login'])->name('tenant.login');
Route::post('tenant/login', [AuthTenantController::class, 'login_action'])->name('tenant.login.action');
Route::get('tenant/forgot-password', [AuthTenantController::class, 'forgotPassword'])->name('tenant.forgot-password');
Route::post('tenant/forgot-password', [AuthTenantController::class, 'forgotPasswordAction'])->name('tenant.forgotPassword.action');


Route::middleware(['auth:tenants'])->group(function () {
    Route::group(['prefix' => 'tenants'], function () {

        Route::controller(AuthTenantController::class)->group(function () {
            Route::get('profile', 'profile')->name('role.tenants.profile');
            Route::post('update-profile', 'updateProfile')->name('role.tenants.profile.action');
            Route::get('logout', 'logout')->name('role.tenants.logout');
        });

        Route::controller(HandleTenantController::class)->group(function () {
            Route::get('index', 'index')->name('role.tenants.index');
            Route::get('feedback', 'feedback')->name('role.tenants.feedback');
            Route::post('send-feedback', 'sendFeedback')->name('role.tenants.send.feedback');
            Route::post('update-feedback/{id}', 'updateFeedback')->name('role.tenants.update.feedback');
            Route::post('delete-feedback/{id}', 'deleteFeedback')->name('role.tenants.delete.feedback');

            Route::get('payment-status', 'paymentStatus')->name('role.tenants.payment-status');
            Route::post('update-bill-status', 'updateBillStatus')->name('payment.update-bill-status');

            Route::get('clear-notification', 'clearNotification')->name('role.tenants.clear-notification');
        });

        Route::controller(TenantPaymentVNPayController::class)->group(function () {
            Route::post('create-payment', 'createPayment')->name('payment-vnpay');
        });
    });
});


// Group Auth Socialite
Route::group(['prefix' => '/auth'], function () {

    Route::controller(UserController::class)->group(function () {
        // Login with Socialite Google
        Route::get('/google/redirect', 'googleRedirect')->name('auth.googleRedirect');
        Route::get('/google/callback', 'googleCallback')->name('auth.googleCallback');
    });
});


// 404 Error
Route::fallback(function () {
    abort(404);
});
