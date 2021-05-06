<?php

use Illuminate\Support\Facades\Route;
use Admin\UserController;
use Student\StudentController;
use Admin\PaymentSchemeController;
use Cashier\PaymentTransactionController;

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

//Route::get('/', function () {
//    return view('/home');
//});
//Auth::routes();

Route::prefix('error')->name('error.')->group(function(){
    Route::get('notfounderror', ['as' => 'notfounderror', 'uses' => 'HomeController@notfounderror']);
    Route::get('servererror', ['as' => 'servererror', 'uses' => 'HomeController@servererror']);
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('/');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/ajax/section/{id}',array('as'=>'ajax.section','uses'=>'HomeController@section'));

// Admin Routes
Route::prefix('admin')->middleware(['auth','auth.isAdmin'])->name('admin.')->group(function(){
    Route::resource('/users', UserController::class);
    Route::resource('/paymentScheme', PaymentSchemeController::class);
    Route::post('/paymentScheme/addNewFee', ['as' => 'paymentScheme.addNewFee', 'uses' => 'Admin\PaymentSchemeController@addNewFee']);
});


// Registrar Routes
Route::prefix('registrar')->middleware('auth')->name('registrar.')->group(function(){
    Route::resource('/student', StudentController::class);
    Route::post('/student/searchRecord', ['as' => 'student.searchRecord', 'uses' => 'Student\StudentController@searchRecord']);
    Route::post('/student/enroll', ['as' => 'student.enroll', 'uses' => 'Student\StudentController@enroll']);
    Route::post('/student/updateStatus', ['as' => 'student.updateStatus', 'uses' => 'Student\StudentController@updateStatus']);
    Route::post('/student/graduate', ['as' => 'student.graduate', 'uses' => 'Student\StudentController@graduate']);

    Route::get('/export/registerForm/{id}', ['as' => 'export.registerForm', 'uses' => 'Student\StudentEnrollmentController@registerForm']);
    Route::get('/export/registerFormExport/{id}', ['as' => 'export.registerFormExport', 'uses' => 'Student\StudentEnrollmentController@registerFormExport']);
});

// Cashier Routes
Route::prefix('cashier')->middleware('auth')->name('cashier.')->group(function(){
    Route::resource('/student', PaymentTransactionController::class);

    Route::post('/student/searchRecord', ['as' => 'student.searchRecord', 'uses' => 'Cashier\PaymentTransactionController@searchRecord']);
    Route::post('/student/storePayment', ['as' => 'student.storePayment', 'uses' => 'Cashier\PaymentTransactionController@storePayment']);
});