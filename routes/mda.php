<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MDAController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'mda/admin',
    'middleware' => ['webauthenticated', 'g2fa'],

], function ($router) {
    Route::get('dashboard', [MDAController::class, 'dashboard'])->name('mda.dashboard');

    Route::get('/view-profile', [MDAController::class, 'viewProfile'])->name("mda.viewProfile");

    Route::get('/revenue-items', [MDAController::class, 'revenueItems'])->name("mda.revenueItems");

    Route::get('/security', [MDAController::class, 'security'])->name("mda.security");

    Route::get('/payment-history', [MDAController::class, 'paymentHistory'])->name("mda.paymentHistory");

    Route::get('/payment-details/{reference}', [MDAController::class, 'paymentDetails'])->name("mda.paymentDetails");

    Route::get('/generate-bill', [MDAController::class, 'generateBill'])->name("mda.generateBill");

    Route::post('/initiateBillGeneration', [MDAController::class, 'initiateBillGeneration'])->name("mda.initiateBillGeneration");

    Route::post('/validateBtin', [MDAController::class, 'validateBtin'])->name("mda.validateBtin");

    Route::get('/bill-preview/{reference}', [MDAController::class, 'billPreview'])->name("mda.billPreview");

    Route::get('/download-advise/{reference}', [MDAController::class, 'downloadPayAdvise'])->name("mda.downloadPayAdvise");

    Route::get('/administrative-reports', [AdminController::class, 'administrativeReports'])->name("mda.reports");

});
