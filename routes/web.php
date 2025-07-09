<?php

use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/verify-email', [App\Http\Controllers\OnboardingController::class, 'verifyEmail'])->name("verifyEmail");

Route::get('/send-verification-mail', [App\Http\Controllers\OnboardingController::class, 'sendVerificationMail'])->name("sendVerificationMail");

Route::group([
    'prefix'     => 'portal',
    'middleware' => ['emailverified', 'webauthenticated', 'g2fa'],

], function ($router) {
    Route::get('dashboard', [BusinessController::class, 'dashboard'])->name('business.dashboard');
});
