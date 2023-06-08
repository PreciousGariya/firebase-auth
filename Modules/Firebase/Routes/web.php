<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Firebase\Http\Controllers\FirebaseLaravelAuthController;

Route::prefix('firebase')->group(function () {
    /*
    |--------------------------------------------------------------------------
     Start Frontend firebase Auth Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/', function () {
        return view('firebase::auth.login');
    });

    Route::get('register', function () {
        return view('firebase::auth.register');
    });

    // route with middleware ['firebase.auth']

    Route::get('/users/profile', function () {
        return Auth::guard('firebase')->user();
    })->name('users')->middleware('firebase.auth');
    // firebase.auth middleware is responsible for validating the incomming token from request

    // Route::post('/verify/register', [FirebaseAuthController::class, 'verifyRegister'])->name('register.verify');
    // Route::post('/verify/login', [FirebaseAuthController::class, 'verifyLogin'])->name('login.verify');
    // Route::post('/verify/logout', [FirebaseAuthController::class, 'logout'])->name('logout.verify');


    /*
    |--------------------------------------------------------------------------
     End Frontend firebase Auth Routes
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
     Start Backend Laravel-firebase Auth Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('laravel-auth')->group(function () {

        Route::get('/', [FirebaseLaravelAuthController::class, 'index']);
        Route::get('/register', [FirebaseLaravelAuthController::class, 'create']);
        Route::get('/reset/password', [FirebaseLaravelAuthController::class, 'resetPass'])->name('laravel.auth.reset.page');

        Route::post('/auth/register', [FirebaseLaravelAuthController::class, 'register'])->name('laravel.auth.register.strore');
        Route::post('/auth/login', [FirebaseLaravelAuthController::class, 'login'])->name('laravel.auth.login.store');
        Route::post('/reset/password', [FirebaseLaravelAuthController::class, 'reset'])->name('laravel.auth.reset.password');

        Route::post('/auth/logout', [FirebaseLaravelAuthController::class, 'logout'])->name('laravel.auth.logout');

    });

    /*
    |--------------------------------------------------------------------------
     End Backend Laravel-firebase Auth Routes
    |--------------------------------------------------------------------------
    */
    // Dashboard
    Route::get('/dashboard', function () {
        return view('firebase::index');
    })->name('firebase.dashboard');
});
