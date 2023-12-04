<?php

use App\Http\Controllers\FrontEndController;
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

Route::get('/', [FrontEndController::class, 'index']);

Route::get('/find-jobs', [FrontEndController::class, 'findJobs']);

Route::get('/businesses', function () {
    return view("businesses");
});

Route::get('/artisans', function () {
    return view("artisans");
});

Auth::routes();
