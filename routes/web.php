<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerVerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Customer verifications to check all details post registratiion
Route::get('customers/verifications/queue', [CustomerVerificationController::class, 'queue'])->name('customerVerifications.queue');
Route::get('customers/verified/queue', [CustomerVerificationController::class, 'getVerifiedCustomerQueue'])->name('customerVerified.queue');
Route::get('customers/{customer_id}/verify', [CustomerVerificationController::class, 'showVerificationDetails'])->name('customers.verification_details');
Route::post('customers/{customer_id}/verify', [CustomerVerificationController::class, 'verify'])->name('customers.verify');
