<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Auth;

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

//Admin
Route::prefix('subject')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/', [SubjectController::class, 'index'])->name('index');
    Route::post('/store', [SubjectController::class, 'store'])->name('store');
    Route::post('/destroy/{subject}', [SubjectController::class, 'destroy'])->name('destroy');
    Route::post('/update/{subject}', [SubjectController::class, 'update'])->name('update');
});




Route::group(['prefix' => 'subject', 'as' => 'subject.'], function () {
    Route::get('/', [SubjectController::class, 'index'])->name('index');
    Route::post('/store', [SubjectController::class, 'store'])->name('store');
    Route::post('/destroy/{subject}', [SubjectController::class, 'destroy'])->name('destroy');
    Route::post('/update/{subject}', [SubjectController::class, 'update'])->name('update');
});
