<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\TwofactorController;
use App\Http\Controllers\ETranzactController;
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

Route::get('/account/email/verify/{token}', [OnboardingController::class, 'verifyWithLink']);

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

    Route::get('/company-registration', [BusinessController::class, 'companyRegistration'])->name("business.companyRegistration")->middleware(["profileupdated"]);

    Route::group([
        'middleware' => ['profileupdated', 'companyreg'],
    ], function ($router) {
        Route::get('/company-renewals', [BusinessController::class, 'companyRenewals'])->name("business.companyRenewals");

        Route::get('/company-renewals/preview/{reference}', [BusinessController::class, 'companyRenewalPreview'])->name("business.companyRenewalPreview");

        Route::post('/initiateCompanyRenewal', [BusinessController::class, 'initiateCompanyRenewal'])->name("business.initiateCompanyRenewal");

        Route::get('/power-of-attorney', [BusinessController::class, 'powerOfAttorney'])->name("business.powerOfAttorney");

        Route::get('/power-of-attorney/preview/{reference}', [BusinessController::class, 'powerOfAttorneyPreview'])->name("business.powerOfAttorneyPreview");

        Route::post('/initiatePOAApplication', [BusinessController::class, 'initiatePOAApplication'])->name("business.initiatePOAApplication");

        Route::get('/award-letters', [BusinessController::class, 'awardLetters'])->name("business.awardLetters");

        Route::get('/award-letters/preview/{reference}', [BusinessController::class, 'awardLettersPreview'])->name("business.awardLettersPreview");

        Route::post('/initiateAwardLetterRequest', [BusinessController::class, 'initiateAwardLetterRequest'])->name("business.initiateAwardLetterRequest");

        Route::get('/processing-fees', [BusinessController::class, 'processingFees'])->name("business.processingFees");

        Route::get('/processing-fees/preview/{reference}', [BusinessController::class, 'processingFeesPreview'])->name("business.processingFeesPreview");

        Route::post('/initiatePRFRemittance', [BusinessController::class, 'initiatePRFRemittance'])->name("business.initiatePRFRemittance");

        Route::post('/processPayment', [BusinessController::class, 'processPayment'])->name("business.processPayment");

        Route::post('/purchaseRegForm', [BusinessController::class, 'purchaseRegForm'])->name("business.purchaseRegForm");

        Route::post('/submitApplication', [BusinessController::class, 'submitApplication'])->name("business.submitApplication");
    });
});

Route::group([
    'prefix'     => 'admin',
    'middleware' => ['webauthenticated', 'g2fa'],

], function ($router) {

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/view-profile', [AdminController::class, 'viewProfile'])->name("admin.viewProfile");

    Route::get('/change-password', [AdminController::class, 'changePassword'])->name("admin.changePassword");

    Route::post('/update-profile', [AdminController::class, 'updateProfile'])->name("admin.updateProfile");

    Route::post('/update-password', [AdminController::class, 'updatePassword'])->name("admin.updatePassword");

    Route::get('/security', [AdminController::class, 'security'])->name("admin.security");

    Route::post('/select2FA', [AdminController::class, 'select2FA'])->name("admin.select2FA");

    Route::post('/enableGA', [AdminController::class, 'enableGA'])->name("admin.enableGA");

    Route::get('company-registrations', [AdminController::class, 'companyRegistrations'])->name('admin.companyRegistrations');

    Route::get('/company-renewals', [AdminController::class, 'companyRenewals'])->name("admin.companyRenewals");

    Route::get('/award-letters', [AdminController::class, 'awardLetters'])->name("admin.awardLetters");

    Route::get('/processing-fees', [AdminController::class, 'processingFees'])->name("admin.processingFees");

    Route::get('/power-of-attorney', [AdminController::class, 'powerOfAttorney'])->name("admin.powerOfAttorney");

    Route::get('/payment-items', [AdminController::class, 'paymentItems'])->name("admin.paymentItems");

    Route::post('/updatePaymentItem', [AdminController::class, 'updatePaymentItem'])->name("admin.updatePaymentItem");

    Route::get('/user-roles', [AdminController::class, 'userRoles'])->name("admin.userRoles");

    Route::post('/storeUserRole', [AdminController::class, 'storeUserRole'])->name("admin.storeUserRole");

    Route::post('/updateUserRole', [AdminController::class, 'updateUserRole'])->name("admin.updateUserRole");

    Route::get('/roles/permissions/{id}', [AdminController::class, 'managePermissions'])->name("admin.managePermissions");

    Route::get('/user-management', [AdminController::class, 'userManagement'])->name("admin.userManagement");

    Route::post('/store-user', [AdminController::class, 'storeUser'])->name('admin.storeUser');

    Route::post('/update-user', [AdminController::class, 'updateUser'])->name('admin.updateUser');

    Route::get('/suspend-user/{id}', [AdminController::class, 'suspendUser'])->name('admin.suspendUser');

    Route::get('/activate-user/{id}', [AdminController::class, 'activateUser'])->name('admin.activateUser');

    Route::get('/platform-features', [AdminController::class, 'platformFeatures'])->name("admin.platformFeatures");

    Route::get('/grant-feature-permission/{role}/{feature}', [AdminController::class, 'grantFeaturePermission'])->name('admin.grantFeaturePermission');

    Route::get('/revoke-feature-permission/{role}/{feature}', [AdminController::class, 'revokeFeaturePermission'])->name('admin.revokeFeaturePermission');

    Route::get('/grant-create-permission/{role}/{feature}', [AdminController::class, 'grantCreatePermission'])->name('admin.grantCreatePermission');

    Route::get('/revoke-create-permission/{role}/{feature}', [AdminController::class, 'revokeCreatePermission'])->name('admin.revokeCreatePermission');

    Route::get('/grant-edit-permission/{role}/{feature}', [AdminController::class, 'grantEditPermission'])->name('admin.grantEditPermission');

    Route::get('/revoke-edit-permission/{role}/{feature}', [AdminController::class, 'revokeEditPermission'])->name('admin.revokeEditPermission');

    Route::get('/grant-delete-permission/{role}/{feature}', [AdminController::class, 'grantDeletePermission'])->name('admin.grantDeletePermission');

    Route::get('/revoke-delete-permission/{role}/{feature}', [AdminController::class, 'revokeDeletePermission'])->name('admin.revokeDeletePermission');
});

Route::get('/etranzact/renewal/callback', [ETranzactController::class, 'handleRenewalCallback'])->name("etranzact.renewal.callBack");
Route::get('/etranzact/poa/callback', [ETranzactController::class, 'handlePOACallback'])->name("etranzact.poa.callBack");
Route::get('/etranzact/award/callback', [ETranzactController::class, 'handleAwardCallback'])->name("etranzact.award.callBack");
Route::get('/etranzact/prf/callback', [ETranzactController::class, 'handlePRFCallback'])->name("etranzact.prf.callBack");
Route::get('/etranzact/regform/callback', [ETranzactController::class, 'handleRegFormCallback'])->name("etranzact.regform.callBack");
Route::get('/etranzact/regfee/callback', [ETranzactController::class, 'handleRegFeeCallback'])->name("etranzact.regfee.callBack");
