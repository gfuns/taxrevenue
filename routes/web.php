<?php

use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\TwofactorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OnboardingController;
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

Route::get('/authy', [HomeController::class, 'authy'])->name('authy');

Route::post('/verify-email', [OnboardingController::class, 'verifyEmail'])->name("verifyEmail");

Route::get('/send-verification-mail', [OnboardingController::class, 'sendVerificationMail'])->name("sendVerificationMail");

Route::post('/initiate-password-reset', [OnboardingController::class, 'initiatePasswordReset'])->name("initiatePasswordReset");

Route::get('/password-reset-confirmation', [OnboardingController::class, 'pwdResetConfirmation'])->name("pwdResetConfirmation");

Route::post('/password-reset-verification', [OnboardingController::class, 'passwordResetVerification'])->name("passwordResetVerification");

Route::get('/new-password', [OnboardingController::class, 'newPassword'])->name("newPassword");

Route::post('/create-new-password', [OnboardingController::class, 'createNewPassword'])->name("createNewPassword");

Route::post('/login/validate2fa', [TwofactorController::class, 'validate2fa'])->name('login.validate2fa');

Route::post('/login/2fa', [TwofactorController::class, 'verify2FA'])->name('login.2fa');

Route::group([
    'prefix'     => 'portal',
    'middleware' => ['emailverified', 'webauthenticated', 'g2fa'],

], function ($router) {
    Route::get('dashboard', [BusinessController::class, 'dashboard'])->name('business.dashboard');

    Route::get('/view-profile', [BusinessController::class, 'viewProfile'])->name("business.viewProfile");

    Route::get('/change-password', [BusinessController::class, 'changePassword'])->name("business.changePassword");

    Route::post('/update-profile', [BusinessController::class, 'updateProfile'])->name("business.updateProfile");

    Route::post('/update-password', [BusinessController::class, 'updatePassword'])->name("business.updatePassword");

    Route::get('/security', [BusinessController::class, 'security'])->name("business.security");

    Route::post('/select2FA', [BusinessController::class, 'select2FA'])->name("business.select2FA");

    Route::post('/enableGA', [BusinessController::class, 'enableGA'])->name("business.enableGA");
});
