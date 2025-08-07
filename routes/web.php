<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ETranzactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Individual\IHomeController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TaxPayerController;
use App\Http\Controllers\TwofactorController;
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

Route::get('certificate/{bsppcno}', [CertificateController::class, 'downloadCertificate'])->name("download.certificate");

Route::get('renewal/{reference}', [CertificateController::class, 'downloadRenewalCert'])->name("download.downloadRenewalCert");

Route::group([
    'prefix'     => 'taxpayer',
    'middleware' => ['emailverified', 'webauthenticated', 'g2fa'],

], function ($router) {

    Route::post('/update-password', [TaxPayerController::class, 'updatePassword'])->name("taxpayer.updatePassword");

    Route::post('/select2FA', [TaxPayerController::class, 'select2FA'])->name("taxpayer.select2FA");

    Route::post('/enableGA', [TaxPayerController::class, 'enableGA'])->name("taxpayer.enableGA");

    Route::get('/tax-stations', [TaxPayerController::class, 'taxStations'])->name("taxpayer.taxStations");

    Route::get('/tax-consultants', [TaxPayerController::class, 'taxConsultants'])->name("taxpayer.taxConsultants");

    Route::group([
        'prefix' => 'individual',
    ], function ($router) {

        Route::get('/dashboard', [IHomeController::class, 'dashboard'])->name("individual.dashboard");

        Route::get('/view-profile', [IHomeController::class, 'viewProfile'])->name("individual.viewProfile");

        Route::post('/update-profile', [IHomeController::class, 'updateProfile'])->name("individual.updateProfile");

        Route::post('/upload-photo', [IHomeController::class, 'uploadPhoto'])->name("individual.uploadPhoto");

        Route::get('/change-password', [TaxPayerController::class, 'changePassword'])->name("individual.changePassword");

        Route::get('/security', [IHomeController::class, 'security'])->name("individual.security");

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

    Route::get('/area-tax-offices', [AdminController::class, 'areaTaxOffices'])->name('admin.areaTaxOffices');

    Route::post('/storeTaxOffice', [AdminController::class, 'storeTaxOffice'])->name('admin.storeTaxOffice');

    Route::post('/updateTaxOffice', [AdminController::class, 'updateTaxOffice'])->name('admin.updateTaxOffice');

    Route::get('/mdas', [AdminController::class, 'manageMDAs'])->name('admin.manageMDAs');

    Route::post('/storeMDA', [AdminController::class, 'storeMDA'])->name('admin.storeMDA');

    Route::post('/updateMDA', [AdminController::class, 'updateMDA'])->name('admin.updateMDA');

    Route::get('/revenue-items', [AdminController::class, 'revenueItems'])->name("admin.revenueItems");

    Route::post('/storeRevenueItem', [AdminController::class, 'storeRevenueItem'])->name("admin.storeRevenueItem");

    Route::post('/updateRevenueItem', [AdminController::class, 'updateRevenueItem'])->name("admin.updateRevenueItem");

    Route::get('/tax-consultants', [AdminController::class, 'taxConsultants'])->name("admin.taxConsultants");

    Route::post('/storeConsultant', [AdminController::class, 'storeConsultant'])->name("admin.storeConsultant");

    Route::post('/updateConsultant', [AdminController::class, 'updateConsultant'])->name("admin.updateConsultant");

    Route::get('/collection-agents', [AdminController::class, 'collectionAgents'])->name("admin.collectionAgents");

    Route::post('/storeCollectionAgent', [AdminController::class, 'storeCollectionAgent'])->name("admin.storeCollectionAgent");

    Route::post('/updateCollectionAgent', [AdminController::class, 'updateCollectionAgent'])->name("admin.updateCollectionAgent");

    Route::post('/assignTerminal', [AdminController::class, 'assignTerminal'])->name("admin.assignTerminal");

    Route::get('/releaseTerminal/{id}', [AdminController::class, 'releaseTerminal'])->name("admin.releaseTerminal");

    Route::get('/pos-terminals', [AdminController::class, 'posTerminals'])->name("admin.posTerminals");

    Route::post('/storePosTerminal', [AdminController::class, 'storePosTerminal'])->name("admin.storePosTerminal");

    Route::post('/updatePosTerminal', [AdminController::class, 'updatePosTerminal'])->name("admin.updatePosTerminal");

    Route::get('/tax-payers', [AdminController::class, 'taxPayers'])->name("admin.taxPayers");

    Route::get('/taxpayer/details/{id}', [AdminController::class, 'taxPayerDetails'])->name("admin.taxPayerDetails");

    Route::get('/suspend-taxpayer/{id}', [AdminController::class, 'suspendTaxPayer'])->name("admin.suspendTaxPayer");

    Route::get('/activate-taxpayer/{id}', [AdminController::class, 'activateTaxPayer'])->name("admin.activateTaxPayer");

});

Route::group([
    'prefix' => 'receipts',
], function ($router) {
    Route::get('/company-renewals/{reference}', [ReceiptController::class, 'companyRenewalReceipt'])->name("receipt.companyRenewal");

    Route::get('/power-of-attorney/{reference}', [ReceiptController::class, 'powerOfAttorneyReceipt'])->name("receipt.powerOfAttorney");

    Route::get('/award-letters/{reference}', [ReceiptController::class, 'awardLettersReceipt'])->name("receipt.awardLetters");

    Route::get('/processing-fees/{reference}', [ReceiptController::class, 'processingFeesReceipt'])->name("receipt.processingFees");
});

Route::get('/ajax/tax-stations/{lga}', [App\Http\Controllers\AjaxController::class, 'getLevels'])->name('ajax.getLevels');

Route::get('/etranzact/renewal/callback', [ETranzactController::class, 'handleRenewalCallback'])->name("etranzact.renewal.callBack");
Route::get('/etranzact/poa/callback', [ETranzactController::class, 'handlePOACallback'])->name("etranzact.poa.callBack");
Route::get('/etranzact/award/callback', [ETranzactController::class, 'handleAwardCallback'])->name("etranzact.award.callBack");
Route::get('/etranzact/prf/callback', [ETranzactController::class, 'handlePRFCallback'])->name("etranzact.prf.callBack");
Route::get('/etranzact/regform/callback', [ETranzactController::class, 'handleRegFormCallback'])->name("etranzact.regform.callBack");
Route::get('/etranzact/regfee/callback', [ETranzactController::class, 'handleRegFeeCallback'])->name("etranzact.regfee.callBack");
