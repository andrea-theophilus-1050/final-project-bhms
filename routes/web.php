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
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::middleware('setLocale')->group(function () {
    //Set locale means set language
    Route::get('en', function () {
        session(['locale' => 'en']);
        return back();
    })->name('lang-english');

    Route::get('vie', function () {
        session(['locale' => 'vie']);
        return back();
    })->name('lang-vietnamese');

    // //Route user account
    // Route::get('/', function () {
    //     if (Auth::check())
    //         return redirect()->route('home');
    //     else
    //         return redirect()->route('login');
    // });
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'login_action'])->name('login.action');
    Route::get('register', [UserController::class, 'register'])->name('register');
    Route::post('register', [UserController::class, 'register_action'])->name('register.action');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    //NOTE: Route forgot password
    Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->middleware('guest')->name('forgot-password');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest')->name('send-reset-link-email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('user.reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');

    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->middleware('guest')->name('password.update');

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
                Route::get('dashboard', [DashboardController::class, 'index'])->name('home');
                Route::group(['prefix' => 'dashboard'], function () {

                    Route::resource('house', HouseController::class);

                    Route::group(['prefix' => 'house'], function () {
                        Route::get('{id}/list-room/', [RoomController::class, 'index'])->name('room.index');
                        Route::post('room/{id}/add-action', [RoomController::class, 'addSingleRoom'])->name('room.add');
                        Route::post('room/{id}/add-multiple-room-action', [RoomController::class, 'addMultipleRooms'])->name('room.add.multiple');
                        Route::post('room/{id}/update-action', [RoomController::class, 'update'])->name('room.update');
                        Route::post('room/{id}/room-delete', [RoomController::class, 'delete'])->name('room.delete');

                        Route::get('room/{id}/assignTenant', [RoomController::class, 'assignTenant'])->name('room.assign-tenant');
                        Route::post('room/{id}/assignTenant', [RoomController::class, 'assignTenant_action'])->name('room.assign-tenant-action');

                        Route::post('room/assignMembers', [RoomController::class, 'assignMembers'])->name('assign-members');
                    });

                    // Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');

                    Route::resource('tenant', TenantController::class);

                    Route::resource('services', ServicesController::class);

                    Route::get('electricity-bill/{date}', [ElectricityController::class, 'electricity_bill'])->name('electricity-bill');
                    Route::post('electricity-filter', [ElectricityController::class, 'electricity_filter'])->name('electricity-filter');
                    Route::post('electricity-insert', [ElectricityController::class, 'electricity_insert'])->name('electricity.insert');

                    Route::get('water-bill/{date}', [WaterController::class, 'water_bill'])->name('water-bill');
                    Route::post('water-insert', [WaterController::class, 'water_insert'])->name('water.insert');
                    // Route::post('water-filter', [WaterController::class, 'water_filter'])->name('water-filter');

                    Route::get('costs-incurred', [CostsIncurredController::class, 'costs_incurred'])->name('costs-incurred');
                    Route::get('costs-incurred/add', [CostsIncurredController::class, 'add_costs_incurred'])->name('costs-incurred.add');
                    Route::post('costs-incurred-action', [CostsIncurredController::class, 'costs_incurred_action'])->name('add.costs-incurred.action');
                    Route::post('costs-incurred-delete/{id}', [CostsIncurredController::class, 'cost_incurred_delete'])->name('cost_incurred.delete');


                    Route::get('room-billing', [RoomBillingController::class, 'room_billing'])->name('room-billing');
                    Route::get('test', [RoomBillingController::class, 'test'])->name('test');

                    Route::get('feedback', [DashboardController::class, 'feedback'])->name('feedback');

                    // NOTE: Export testing, not done 
                    Route::get('/export-users', [UserController::class, 'exportUsers'])->name('export-users');
                    Route::get('/export-tenant', [TenantController::class, 'exportTenant'])->name('export-tenant');
                });
            });
            Route::get('/dashboard/profile', [UserController::class, 'profile'])->name('profile');
            Route::post('/dashboard/update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
        });
    });
});

// Group Auth Socialite
Route::group(['prefix' => '/auth'], function () {
    // Login with Socialite Google
    Route::get('/google/redirect', [UserController::class, 'googleRedirect'])->name('auth.googleRedirect');
    Route::get('/google/callback', [UserController::class, 'googleCallback'])->name('auth.googleCallback');

    // Login with Socialite Facebook
    Route::get('/facebook/redirect', [UserController::class, 'facebookRedirect'])->name('auth.facebookRedirect');
    Route::get('/facebook/callback', [UserController::class, 'facebookCallback'])->name('auth.facebookCallback');
});


// 404 Error
Route::fallback(function () {
    abort(404);
});
