<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\TwofactorController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ETranzactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\ReceiptController;
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
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/tenders', function () {
    return view('tenders');
});

Route::get('/awards', function () {
    return view('awards');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/press', function () {
    return view('press');
});

Route::get('/resources', function () {
    return view('resources');
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

    Route::post('/purchaseRegForm', [BusinessController::class, 'purchaseRegForm'])->name("business.purchaseRegForm");

    Route::get('/account-revalidation', [BusinessController::class, 'accountRevalidation'])->name("business.accountRevalidation");

    Route::get('/preview-application/{id}', [BusinessController::class, 'previewApplication'])->name("business.previewApplication");

    Route::get('/resume-application/{id}', [BusinessController::class, 'resumeApplication'])->name("business.resumeApplication");

    Route::post('/submitApplication', [BusinessController::class, 'submitApplication'])->name("business.submitApplication");

    Route::post('/finalizeApplication', [BusinessController::class, 'finalizeApplication'])->name("business.finalizeApplication");

    Route::post('/processPayment', [BusinessController::class, 'processPayment'])->name("business.processPayment");

    Route::get('/executed-projects/{id}', [BusinessController::class, 'pastProjects'])->name("business.pastProjects");

    Route::post('/addProject', [BusinessController::class, 'addProject'])->name("business.addProject");

    Route::get('/remove-project/{id}', [BusinessController::class, 'removeProject'])->name("business.removeProject");

    Route::get('/company-documents/{id}', [BusinessController::class, 'companyDocuments'])->name("business.companyDocuments");

    Route::post('/uploadDocument', [BusinessController::class, 'uploadDocument'])->name("business.uploadDocument");

    Route::get('/remove-document/{id}', [BusinessController::class, 'removeDocument'])->name("business.removeDocument");

    Route::group([
        'middleware' => ['profileupdated', 'companyreg'],
    ], function ($router) {
        Route::get('/company-renewals', [BusinessController::class, 'companyRenewals'])->name("business.companyRenewals");

        Route::get('/company-renewals/preview/{reference}', [BusinessController::class, 'companyRenewalPreview'])->name("business.companyRenewalPreview");

        Route::post('/initiateCompanyRenewal', [BusinessController::class, 'initiateCompanyRenewal'])->name("business.initiateCompanyRenewal");

        Route::get('/company-renewals/details/{reference}', [BusinessController::class, 'companyRenewalDetails'])->name("business.companyRenewalDetails");

        Route::get('/company-renewals/update/{reference}', [BusinessController::class, 'editRenewalApplication'])->name("business.editRenewalApplication");

        Route::post('/updateRenewalApplication', [BusinessController::class, 'updateRenewalApplication'])->name("business.updateRenewalApplication");

        Route::get('/power-of-attorney', [BusinessController::class, 'powerOfAttorney'])->name("business.powerOfAttorney");

        Route::get('/power-of-attorney/preview/{reference}', [BusinessController::class, 'powerOfAttorneyPreview'])->name("business.powerOfAttorneyPreview");

        Route::post('/initiatePOAApplication', [BusinessController::class, 'initiatePOAApplication'])->name("business.initiatePOAApplication");

        Route::get('/power-of-attorney/details/{reference}', [BusinessController::class, 'powerOfAttorneyDetails'])->name("business.powerOfAttorneyDetails");

        Route::get('/power-of-attorney/update/{reference}', [BusinessController::class, 'editPoaApplication'])->name("business.editPoaApplication");

        Route::post('/updatePoaApplication', [BusinessController::class, 'updatePoaApplication'])->name("business.updatePoaApplication");

        Route::get('/award-letters', [BusinessController::class, 'awardLetters'])->name("business.awardLetters");

        Route::get('/award-letters/preview/{reference}', [BusinessController::class, 'awardLettersPreview'])->name("business.awardLettersPreview");

        Route::post('/initiateAwardLetterRequest', [BusinessController::class, 'initiateAwardLetterRequest'])->name("business.initiateAwardLetterRequest");

        Route::get('/award-letters/details/{reference}', [BusinessController::class, 'awardLettersDetails'])->name("business.awardLettersDetails");

        Route::get('/award-letters/update/{reference}', [BusinessController::class, 'editAwardApplication'])->name("business.editAwardApplication");

        Route::post('/updateAwardApplication', [BusinessController::class, 'updateAwardApplication'])->name("business.updateAwardApplication");

        Route::get('/processing-fees', [BusinessController::class, 'processingFees'])->name("business.processingFees");

        Route::get('/processing-fees/preview/{reference}', [BusinessController::class, 'processingFeesPreview'])->name("business.processingFeesPreview");

        Route::post('/initiatePRFRemittance', [BusinessController::class, 'initiatePRFRemittance'])->name("business.initiatePRFRemittance");

        Route::get('/processing-fees/details/{reference}', [BusinessController::class, 'processingFeesDetails'])->name("business.processingFeesDetails");

        Route::get('/processing-fees/update/{reference}', [BusinessController::class, 'editPRFApplication'])->name("business.editPRFApplication");

        Route::post('/updatePRFApplication', [BusinessController::class, 'updatePRFApplication'])->name("business.updatePRFApplication");

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

    Route::get('company-registration/details/{id}', [AdminController::class, 'companyRegDetails'])->name('admin.companyRegDetails');

    Route::get('approve-registration/{id}', [AdminController::class, 'approveCompanyReg'])->name('admin.approveCompanyReg');

    Route::post('reject-registration', [AdminController::class, 'rejectCompanyReg'])->name('admin.rejectCompanyReg');

    Route::get('/company-renewals', [AdminController::class, 'companyRenewals'])->name("admin.companyRenewals");

    Route::get('/company-renewals/details/{reference}', [AdminController::class, 'companyRenewalDetails'])->name("admin.companyRenewalDetails");

    Route::get('approve-renewal/{id}', [AdminController::class, 'approveCompanyRenewal'])->name('admin.approveCompanyRenewal');

    Route::post('reject-renewal', [AdminController::class, 'rejectCompanyRenewal'])->name('admin.rejectCompanyRenewal');

    Route::get('/award-letters', [AdminController::class, 'awardLetters'])->name("admin.awardLetters");

    Route::get('/award-letters/details/{reference}', [AdminController::class, 'awardLettersDetails'])->name("admin.awardLettersDetails");

    Route::get('approve-award-application/{id}', [AdminController::class, 'approveAwardApplication'])->name('admin.approveAwardApplication');

    Route::post('rejectAwardApplication', [AdminController::class, 'rejectAwardApplication'])->name('admin.rejectAwardApplication');

    Route::get('/processing-fees', [AdminController::class, 'processingFees'])->name("admin.processingFees");

    Route::get('/processing-fees/details/{reference}', [AdminController::class, 'processingFeesDetails'])->name("admin.processingFeesDetails");

    Route::get('approve-prf-application/{id}', [AdminController::class, 'approvePrfApplication'])->name('admin.approvePrfApplication');

    Route::post('rejectPrfApplication', [AdminController::class, 'rejectPrfApplication'])->name('admin.rejectPrfApplication');

    Route::get('/power-of-attorney', [AdminController::class, 'powerOfAttorney'])->name("admin.powerOfAttorney");

    Route::get('/power-of-attorney/details/{reference}', [AdminController::class, 'powerOfAttorneyDetails'])->name("admin.powerOfAttorneyDetails");

    Route::get('approve-poa-application/{id}', [AdminController::class, 'approvePoaApplication'])->name('admin.approvePoaApplication');

    Route::post('rejectPoaApplication', [AdminController::class, 'rejectPoaApplication'])->name('admin.rejectPoaApplication');

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

    Route::get('/business-categories', [AdminController::class, 'businessCategories'])->name('admin.businessCategories');

    Route::get('/document-management', [AdminController::class, 'documentManagement'])->name('admin.documentManagement');

    Route::post('/storeBusinessCategory', [AdminController::class, 'storeBusinessCategory'])->name('admin.storeBusinessCategory');

    Route::post('/updateBusinessCategory', [AdminController::class, 'updateBusinessCategory'])->name('admin.updateBusinessCategory');

    Route::get('/deactivateCategory/{id}', [AdminController::class, 'deactivateCategory'])->name('admin.deactivateCategory');

    Route::get('/activateCategory/{id}', [AdminController::class, 'activateCategory'])->name('admin.activateCategory');

    Route::post('/storeUpDoc', [AdminController::class, 'storeUpDoc'])->name('admin.storeUpDoc');

    Route::post('/updateUpDoc', [AdminController::class, 'updateUpDoc'])->name('admin.updateUpDoc');

    Route::get('/activateDocument/{id}', [AdminController::class, 'activateDocument'])->name('admin.activateDocument');

    Route::get('/deactivateDocument/{id}', [AdminController::class, 'deactivateDocument'])->name('admin.deactivateDocument');
});

Route::group([
    'prefix' => 'receipts',
], function ($router) {
    Route::get('/company-renewals/{reference}', [ReceiptController::class, 'companyRenewalReceipt'])->name("receipt.companyRenewal");

    Route::get('/power-of-attorney/{reference}', [ReceiptController::class, 'powerOfAttorneyReceipt'])->name("receipt.powerOfAttorney");

    Route::get('/award-letters/{reference}', [ReceiptController::class, 'awardLettersReceipt'])->name("receipt.awardLetters");

    Route::get('/processing-fees/{reference}', [ReceiptController::class, 'processingFeesReceipt'])->name("receipt.processingFees");
});

Route::get('/etranzact/renewal/callback', [ETranzactController::class, 'handleRenewalCallback'])->name("etranzact.renewal.callBack");
Route::get('/etranzact/poa/callback', [ETranzactController::class, 'handlePOACallback'])->name("etranzact.poa.callBack");
Route::get('/etranzact/award/callback', [ETranzactController::class, 'handleAwardCallback'])->name("etranzact.award.callBack");
Route::get('/etranzact/prf/callback', [ETranzactController::class, 'handlePRFCallback'])->name("etranzact.prf.callBack");
Route::get('/etranzact/regform/callback', [ETranzactController::class, 'handleRegFormCallback'])->name("etranzact.regform.callBack");
Route::get('/etranzact/regfee/callback', [ETranzactController::class, 'handleRegFeeCallback'])->name("etranzact.regfee.callBack");
