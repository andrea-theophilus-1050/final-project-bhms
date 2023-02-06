<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\House\HouseController;
use App\Http\Controllers\House\Area\AreaController;
use App\Http\Controllers\House\Room\RoomController;

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

    Route::get('chn', function () {
        session(['locale' => 'chn']);
        return back();
    })->name('lang-chinese');

    Route::get('fra', function () {
        session(['locale' => 'fra']);
        return back();
    })->name('lang-french');

    Route::get('vie', function () {
        session(['locale' => 'vie']);
        return back();
    })->name('lang-vietnamese');

    //Route user account
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'login_action'])->name('login.action');
    Route::get('register', [UserController::class, 'register'])->name('register');
    Route::post('register', [UserController::class, 'register_action'])->name('register.action');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/forgot-password', function () {
        return view('user.forgot-password')->with('title', 'Forgot Password');
    });


    //Route auth
    Route::middleware(['auth', 'userRole:landlords'])->group(function () {
        Route::group(['prefix' => 'landlords'], function () {
            Route::middleware('checkProfile')->group(function () {
                Route::get('dashboard', [DashboardController::class, 'index'])->name('home');
                Route::group(['prefix' => 'dashboard'], function () {
                    // Route::get('house', [DashboardController::class, 'houseArea'])->name('house-area');
                    // Route::group(['prefix' => 'house'], function () {
                    //     Route::get('add', [DashboardController::class, 'addHouse'])->name('house.add_new_house');
                    //     Route::post('add-house', [HouseController::class, 'addNewHouseAction'])->name('add-house.action');
                    //     Route::post('update-house', [HouseController::class, 'UpdateHouseAction'])->name('update-house.action');
                    //     Route::post('delete/{id?}', [HouseController::class, 'deleteHouse'])->name('deletehouse.action');

                    // });

                    Route::resource('house', HouseController::class);
                    Route::group(['prefix' => 'house'], function () {
                        Route::get('area/{id}', [AreaController::class, 'index'])->name('area.index');
                        Route::post('area/{id}/add-action', [AreaController::class, 'add_action'])->name('area.add');
                        Route::post('area/{id}/update-action', [AreaController::class, 'update_action'])->name('area.update');
                        Route::post('area/{id}/delete-action', [AreaController::class, 'delete_action'])->name('area.delete');
                        
                        Route::group(['prefix'=>'area'], function(){
                            Route::get('room/{id}', [RoomController::class, 'index'])->name('room.index');
                            Route::post('room/{id}/add-action', [RoomController::class, 'addSingleRoom'])->name('room.add');
                            Route::post('room/{id}/add-multiple-room-action', [RoomController::class, 'addMultipleRooms'])->name('room.add.multiple');
                        });
                    });


                    Route::get('room', [RoomController::class, 'room'])->name('room');
                    Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');
                    Route::group(['prefix' => 'room'], function () {
                        Route::get('add', [DashboardController::class, 'addRoom'])->name('room.add_new_room');
                    });
                });
            });
            Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('profile');
            Route::post('/dashboard/update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
        });
    });
});




// Route::get('/', function () {
//     return redirect()->route('login');
// });
// // Route::group(['prefix' => '{locale}'], function () {
// //     Route::group(['middleware' => 'setLocale'], function () {
// Route::get('/', [UserController::class, 'login']);
// Route::get('login', [UserController::class, 'login'])->name('login');
// Route::post('login', [UserController::class, 'login_action'])->name('login.action');
// Route::get('register', [UserController::class, 'register'])->name('register');
// Route::post('register', [UserController::class, 'register_action'])->name('register.action');
// Route::get('logout', [UserController::class, 'logout'])->name('logout');
// Route::get('/forgot-password', function () {
//     return view('user.forgot-password')->with('title', 'Forgot Password');
// });
// //     });
// // });

// Group Auth Socialite
Route::group(['prefix' => '/auth'], function () {
    // Login with Socialite Google
    Route::get('/google/redirect', [UserController::class, 'googleRedirect'])->name('auth.googleRedirect');
    Route::get('/google/callback', [UserController::class, 'googleCallback'])->name('auth.googleCallback');

    // Login with Socialite Facebook
    Route::get('/facebook/redirect', [UserController::class, 'facebookRedirect'])->name('auth.facebookRedirect');
    Route::get('/facebook/callback', [UserController::class, 'facebookCallback'])->name('auth.facebookCallback');
});

// Group Authenticated
// Landlords role
// Route::middleware(['auth', 'userRole:landlords'])->group(function () {
//     Route::group(['prefix' => '{locale}'], function () {
//         Route::group(['prefix' => 'landlords'], function () {
//             // Route::group(['middleware' => 'setLocale'], function () {
//             Route::middleware('setLocale')->group(function () {
//                 Route::middleware('checkProfile')->group(function () {
//                     Route::get('dashboard', [DashboardController::class, 'index'])->name('home');
//                     Route::group(['prefix' => 'dashboard'], function () {
//                         // Route::get('house', [DashboardController::class, 'houseArea'])->name('house-area');
//                         // Route::group(['prefix' => 'house'], function () {
//                         //     Route::get('add', [DashboardController::class, 'addHouse'])->name('house.add_new_house');
//                         //     Route::post('add-house', [HouseController::class, 'addNewHouseAction'])->name('add-house.action');
//                         //     Route::post('update-house', [HouseController::class, 'UpdateHouseAction'])->name('update-house.action');
//                         //     Route::post('delete/{id?}', [HouseController::class, 'deleteHouse'])->name('deletehouse.action');

//                         // });

//                         Route::resource('house', HouseController::class);


//                         Route::get('room', [DashboardController::class, 'room'])->name('room');
//                         Route::post('change-password', [DashboardController::class, 'changePassword'])->name('change-password');
//                         Route::group(['prefix' => 'room'], function () {
//                             Route::get('add', [DashboardController::class, 'addRoom'])->name('room.add_new_room');
//                         });
//                     });
//                 });
//                 Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('profile');
//                 Route::post('/dashboard/update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
//             });
//         });
//     });
// });



// 404 Error
Route::fallback(function () {
    return view('errors.404')->with('title', '404 Error');
});
