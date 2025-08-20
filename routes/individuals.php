<?php

use App\Http\Controllers\Individual\IHomeController;
use App\Http\Controllers\TaxPayerController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'taxpayer',
    'middleware' => ['emailverified', 'webauthenticated', 'g2fa'],

], function ($router) {

    Route::post('/update-password', [TaxPayerController::class, 'updatePassword'])->name("taxpayer.updatePassword");

    Route::post('/select2FA', [TaxPayerController::class, 'select2FA'])->name("taxpayer.select2FA");

    Route::post('/enableGA', [TaxPayerController::class, 'enableGA'])->name("taxpayer.enableGA");

    Route::post('/requestConsultant', [TaxPayerController::class, 'requestConsultant'])->name("taxpayer.requestConsultant");

    Route::get('/cancel-consultant/{id}', [TaxPayerController::class, 'cancelConsultant'])->name("taxpayer.cancelConsultant");

    Route::group([
        'prefix' => 'i',
    ], function ($router) {

        Route::get('/dashboard', [IHomeController::class, 'dashboard'])->name("individual.dashboard");

        Route::get('/view-profile', [IHomeController::class, 'viewProfile'])->name("individual.viewProfile");

        Route::post('/update-profile', [IHomeController::class, 'updateProfile'])->name("individual.updateProfile");

        Route::post('/upload-photo', [IHomeController::class, 'uploadPhoto'])->name("individual.uploadPhoto");

        Route::get('/security', [IHomeController::class, 'security'])->name("individual.security");

        Route::get('/tax-stations', [IHomeController::class, 'taxStations'])->name("individual.taxStations");

        Route::get('/tax-consultants', [IHomeController::class, 'taxConsultants'])->name("individual.taxConsultants");

        Route::get('/generate-bill', [IHomeController::class, 'generateBill'])->name("individual.generateBill");

        Route::post('/initiateBillPayment', [IHomeController::class, 'initiateBillPayment'])->name("individual.initiateBillPayment");

        Route::get('/bill/payment-preview/{reference}', [IHomeController::class, 'paymentPreview'])->name("individual.paymentPreview");

        Route::get('/bill/payment-details/{reference}', [IHomeController::class, 'paymentDetails'])->name("individual.paymentDetails");

        Route::post('/bill/processPayment', [IHomeController::class, 'processBillPayment'])->name("individual.processBillPayment");

        Route::get('/bill-payments', [IHomeController::class, 'billPayments'])->name("individual.billPayments");

        Route::post('/addSpouse', [IHomeController::class, 'addSpouse'])->name("individual.addSpouse");

        Route::post('/addChild', [IHomeController::class, 'addChild'])->name("individual.addChild");

        Route::get('/filed-returns', [IHomeController::class, 'filedReturns'])->name("individual.filedReturns");

        Route::get('/return-details/{reference}', [IHomeController::class, 'returnDetails'])->name("individual.returnDetails");

        Route::get('/file-returns', [IHomeController::class, 'fileReturns'])->name("individual.fileReturns");

        Route::post('/initiateReturnsFiling', [IHomeController::class, 'initiateReturnsFiling'])->name("individual.initiateReturnsFiling");

        Route::get('/previous-filed-returns/{reference}', [IHomeController::class, 'previousReturns'])->name("individual.previousReturns");

        Route::post('/uploadPreviousReturns', [IHomeController::class, 'uploadPreviousReturns'])->name("individual.uploadPreviousReturns");

        Route::post('/submitReturnApplication', [IHomeController::class, 'submitReturnApplication'])->name("individual.submitReturnApplication");

        Route::get('/returns/preview-filing/{reference}', [IHomeController::class, 'previewApplication'])->name("individual.previewApplication");

        Route::get('/employer-filed-returns', [IHomeController::class, 'employerFiledReturns'])->name("individual.empFiledReturns");

        Route::get('/assessments', [IHomeController::class, 'assessments'])->name("individual.assessments");

    });
});
