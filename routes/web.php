<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrolmentController;
use App\Http\Controllers\QualificationController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/enrolment', [App\Http\Controllers\EnrolmentController::class, 'index'])->name('enrolment');


//Admin

// Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
Route::group(['prefix' => 'subject', 'as' => 'subject.','middleware' => ['auth','isAdmin']],function(){
    Route::get('/', [SubjectController::class, 'index'])->name('index');
    Route::post('/store', [SubjectController::class, 'store'])->name('store');
    Route::post('/destroy/{subject}', [SubjectController::class, 'destroy'])->name('destroy');
    Route::post('/update/{subject}', [SubjectController::class, 'update'])->name('update');
});

//Route::get('/', [EnrolmentController::class, 'create'])->name('create');
//Route::post('/store', [EnrolmentController::class, 'store'])->name('store');

Route::group(['prefix' => 'enrolment', 'as' => 'enrolment.'], function () {
    Route::get('/', [EnrolmentController::class, 'create'])->name('create');
    Route::post('/store', [EnrolmentController::class, 'store'])->name('store');
    Route::post('/addMuet', [EnrolmentController::class, 'addMuet'])->name('addMuet');
    Route::post('/update/{enrolment}', [EnrolmentController::class, 'update'])->name('update');
    Route::post('/destroy/{enrolment}', [EnrolmentController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'qualification', 'as' => 'qualification.'], function () {
    Route::get('/', [QualificationController::class, 'operation'])->name('operation');
});