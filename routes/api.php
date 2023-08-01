<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/get-all-images', [App\Http\Controllers\ApiController::class, 'getAllImages']);
Route::post('/before-install', [App\Http\Controllers\ApiController::class, 'beforeInstall']);
Route::post('/get-feedback-response', [App\Http\Controllers\ApiController::class, 'getFeedbackResponse']);
Route::post('/save-bulk-feedbacks', [App\Http\Controllers\ApiController::class, 'saveBulkFeedbacks']);
Route::get('/get-sliders', [App\Http\Controllers\ApiController::class, 'getAllSliders'])->name('getAllSliders');
Route::get('/get-categories', [App\Http\Controllers\ApiController::class, 'getAllCategories'])->name('getAllCategories');
Route::get('/get-all-products', [App\Http\Controllers\ApiController::class, 'getAllProducts'])->name('getAllProducts');
Route::get('/get-products/{id}', [App\Http\Controllers\ApiController::class, 'getProducts'])->name('getProducts');
Route::get('/get-product/{id}', [App\Http\Controllers\ApiController::class, 'getProduct'])->name('getProduct');
Route::get('/get-subcategories/{id}', [App\Http\Controllers\ApiController::class, 'getAllSubCategories'])->name('getAllSubCategories');
Route::post('/add-feedbacks', [App\Http\Controllers\ApiController::class, 'addFeedbacks']);
Route::post('/add-device', [App\Http\Controllers\ApiController::class, 'addDevice']);
Route::post('/update-device-data', [App\Http\Controllers\ApiController::class, 'updateDeviceData']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
