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

Route::get('/job-categories/{slug}', [FrontEndController::class, 'jobsByCategory']);

Route::get('/job-categories', [FrontEndController::class, 'jobsCategories']);

Route::get('/artisans', [FrontEndController::class, 'artisans']);

Route::get('/businesses', [FrontEndController::class, 'businesses']);

Route::get('/blog', [FrontEndController::class, 'blogPosts']);

Route::get('/tutorial-videos', [FrontEndController::class, 'tutorialVideos']);

Route::get('/mini-store', [FrontEndController::class, 'miniStore']);

Auth::routes();
