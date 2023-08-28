<?php

use Illuminate\Support\Facades\Route;
use App\Models\Plan;
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

//Homepage Route
Route::get('/', function () {
    $plans = Plan::all();
    return view('welcome', compact('plans'));
});


Route::post('/contact', [App\Http\Controllers\ContactController::class, 'contactUs'])->name('contact.send');

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

//USER CONTROLLER
Route::get('/all-plans', [App\Http\Controllers\Admin\UserController::class, 'userIndex']);
Route::get('/subscribe/{id}', [App\Http\Controllers\Admin\UserController::class, 'showPlan']);
Route::get('/myplans/{id}', [App\Http\Controllers\Admin\UserController::class, 'myplans']);

//PAYSTACK URL
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);

// ADMIN CONTROLLER
Route::resource('users', App\Http\Controllers\Admin\UserController::class);
Route::resource('plans', App\Http\Controllers\Admin\PlanController::class);
Route::post('/plans/{id}/status', [App\Http\Controllers\Admin\PlanController::class, 'deactivatePlan'])->name('plan.deactivate');
Route::post('/user/{user}/subscribe', [App\Http\Controllers\Admin\UserController::class, 'subscribe'])->name('user.subscribe');
Route::get('/preview/{details}', [App\Http\Controllers\Admin\UserController::class, 'orderPreview'])->name('preview');


