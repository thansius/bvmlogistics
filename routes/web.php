<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PhilProvinceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('auth/custom_login');
// });

Route::get('admin', function () {
    return view('admin_template');
});

Route::get("data", [PhilProvinceController::class, "index"]);
Route::get('myform',array('as'=>'myform','uses'=>'PhilProvinceController@myform'));
// Route::get('myform/ajax/{id}',array('as'=>'myform.ajax','uses'=>'PhilProvinceController@myformAjax'));
Route::get('myform/ajax/{id}', [App\Http\Controllers\PhilProvinceController::class, 'myformAjax']);
Route::get('trackmodal/ajax/{id}', [App\Http\Controllers\PackageController::class, 'getPackageProgress']);
Route::get('getBarangays/ajax/{id}', [App\Http\Controllers\PhilProvinceController::class, 'getBarangays']);

// Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
Route::resource('employees', EmployeeController::class);
Route::resource('customers', CustomerController::class);
Route::get('/packages/inwarehouse', 'App\Http\Controllers\PackageController@getInWH');
Route::get('/packages/intransit', 'App\Http\Controllers\PackageController@getInTransit');
Route::get('/packages/delivered', 'App\Http\Controllers\PackageController@getDelivered');
Route::post('save-customer', 'App\Http\Controllers\CustomerController@storeViaPackage');
Route::post('getOne', 'App\Http\Controllers\PackageController@getPackage');
Route::post('save-update', 'App\Http\Controllers\PackageController@updatePackageStatus');
Route::post('update-carrier', 'App\Http\Controllers\PackageController@updateCarrier');
Route::post('save-profile', 'App\Http\Controllers\EmployeeController@updateProfile');
Route::post('save-password', 'App\Http\Controllers\EmployeeController@updatePassword');
Route::post('reset-password', 'App\Http\Controllers\EmployeeController@resetPassword');
Route::post('reactivate-employee', 'App\Http\Controllers\EmployeeController@reactivate');

Route::resource('packages', PackageController::class);

// Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dashboard', [App\Http\Controllers\CustomAuthController::class, 'dashboard']);
Route::get('/login', [App\Http\Controllers\CustomAuthController::class, 'index'])->name('login');
Route::get('/logout', function() {return view('landing');});
Route::get('users/profile', function() {return view('users/profile');})->name('user.profile');
Route::get('/', function() {return view('landing');});
Route::get('/about', function() {return view('about');});
Route::get('/contact', function() {return view('contact');});
Route::get('/service', function() {return view('service');});
Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
