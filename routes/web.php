<?php

use App\Http\Controllers\MsController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Management System

Route::get('/ms', [MsController::class, 'index'])->name('ms-home');
Route::get('/ms/statistics', function() { return view('ms.pages.stat'); })->name('ms-stats');
Route::get('/ms/settings', function() { return view('ms.pages.setting'); })->name('ms-sets');

Route::get('/ms/courses', function() { return view('ms.pages.course'); })->name('ms-course');
Route::get('/ms/platforms', function() { return view('ms.pages.platform'); })->name('ms-platform');
Route::get('/ms/promos', function() { return view('ms.pages.promo'); })->name('ms-promo');
Route::get('/ms/users', function() { return view('ms.pages.user'); })->name('ms-user');

Route::get('/ms/add', [MsController::class, 'add'])->name('ms-add');