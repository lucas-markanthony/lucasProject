<?php

use Illuminate\Support\Facades\Route;
use Admin\UserController;
use Student\StudentController;
use Admin\PaymentSchemeController;
use Cashier\PaymentTransactionController;
use Reports\Reports;

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
Route::get('/ajax/grade/{id}',array('as'=>'ajax.grade','uses'=>'HomeController@grade'));
Route::get('/ajax/subject/{id}',array('as'=>'ajax.subject','uses'=>'HomeController@subject'));

// Admin Routes
Route::prefix('admin')->middleware(['auth','auth.isAdmin'])->name('admin.')->group(function(){
    Route::resource('/users', UserController::class);
    Route::resource('/paymentScheme', PaymentSchemeController::class);
    Route::post('/paymentScheme/addNewFee', ['as' => 'paymentScheme.addNewFee', 'uses' => 'Admin\PaymentSchemeController@addNewFee']);

    Route::get('/schoolYear', ['as' => 'schoolYear.index', 'uses' => 'Admin\PaymentSchemeController@schoolyearIndex']);
    Route::post('/schoolYear/addNewSchoolYearConfig', ['as' => 'schoolYear.addNewSchoolYearConfig', 'uses' => 'Admin\PaymentSchemeController@addNewSchoolYearConfig']);
    Route::get('/subjectGroup', ['as' => 'subjectGroup.index', 'uses' => 'Admin\PaymentSchemeController@subjectGroupIndex']);
    Route::post('/subjectGroup/addNewSubjectGroupConfig', ['as' => 'subjectGroup.addNewSubjectGroupConfig', 'uses' => 'Admin\PaymentSchemeController@addNewSubjectGroupConfig']);
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
    
    
    Route::get('/studentRecordIndex', ['as' => 'student.studentRecordIndex', 'uses' => 'Student\StudentController@studentRecordIndex']);
    Route::get('/studentClassRecordIndex', ['as' => 'student.studentClassRecordIndex', 'uses' => 'Student\StudentController@studentClassRecordIndex']);
    Route::post('/searchClass', ['as' => 'student.searchClass', 'uses' => 'Student\StudentController@searchClass']);
    Route::post('/searchStudentRecord', ['as' => 'student.searchStudentRecord', 'uses' => 'Student\StudentController@searchStudentRecord']);
    Route::post('/updateGrades', ['as' => 'student.updateGrades', 'uses' => 'Student\StudentController@updateGrades']);
});

// Cashier Routes
Route::prefix('cashier')->middleware('auth')->name('cashier.')->group(function(){
    Route::resource('/student', PaymentTransactionController::class);

    Route::post('/student/searchRecord', ['as' => 'student.searchRecord', 'uses' => 'Cashier\PaymentTransactionController@searchRecord']);
    Route::post('/student/storePayment', ['as' => 'student.storePayment', 'uses' => 'Cashier\PaymentTransactionController@storePayment']);
});

// Reports Routes 
Route::prefix('report')->middleware('auth')->name('report.')->group(function(){
    Route::get('/enrollment/index', ['as' => 'enrollment.index', 'uses' => 'Reports\Reports@enrollmentRecordsIndex']);
    Route::get('/transaction/index', ['as' => 'transaction.index', 'uses' => 'Reports\Reports@transactionRecordsIndex']);

    Route::post('/enrollment/showSearchEnrollment', ['as' => 'enrollment.showSearchEnrollment', 'uses' => 'Reports\Reports@showSearchEnrollment']);
});