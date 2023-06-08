<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseAuthController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

Route::get('/register', [FirebaseAuthController::class, 'registerpage']);
Route::get('/login', [FirebaseAuthController::class, 'loginpage']);


Route::post('/auth/register', [FirebaseAuthController::class, 'register'])->name('register.strore');
Route::post('/auth/login', [FirebaseAuthController::class, 'login'])->name('login.store');



// front end

Route::post('/verify/register', [FirebaseAuthController::class, 'verifyRegister'])->name('register.verify');
Route::post('/verify/login', [FirebaseAuthController::class, 'verifyLogin'])->name('login.verify');
Route::post('/verify/logout', [FirebaseAuthController::class, 'logout'])->name('logout.verify');


Route::get('/', function () {
    return view('welcome');
})->name('homepage');


Route::get('/users', function () {
    return User::get();
})->name('users')->middleware('firebase.auth');

Route::get('/users/profile', function () {
    return Auth::guard('firebase')->user();
})->name('users')->middleware('firebase.auth');



Route::get('front/login', function () {
    return view('frontend.login');
});

Route::get('front/register', function () {
    return view('frontend.register');
});
