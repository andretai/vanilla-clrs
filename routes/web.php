<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MsController;
use App\Http\Middleware\IsAdmin;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Management System

Route::get('/ms', [MsController::class, 'index'])->name('ms-home')->middleware(IsAdmin::class);
Route::get('/ms/statistics', function() { return view('ms.pages.stat'); })->name('ms-stats')->middleware(IsAdmin::class);
Route::get('/ms/settings', function() { return view('ms.pages.setting'); })->name('ms-sets')->middleware(IsAdmin::class);

Route::get('/ms/courses', [MsController::class, 'indexCourse'])->name('ms-course')->middleware(IsAdmin::class);
Route::get('/ms/platforms', function() { return view('ms.pages.platform'); })->name('ms-platform')->middleware(IsAdmin::class);
Route::get('/ms/promos', function() { return view('ms.pages.promo'); })->name('ms-promo')->middleware(IsAdmin::class);
Route::get('/ms/users', function() { return view('ms.pages.user'); })->name('ms-user')->middleware(IsAdmin::class);

Route::get('/ms/add', [MsController::class, 'add'])->name('ms-add')->middleware(IsAdmin::class);
Route::get('/ms/edit', [MsController::class, 'edit'])->name('ms-edit')->middleware(IsAdmin::class);
Route::get('/ms/remove', [MsController::class, 'remove'])->name('ms-remove')->middleware(IsAdmin::class);

Route::post('/ms/courses/store', [CoursesController::class, 'store'])->name('courses.store')->middleware(IsAdmin::class);
Route::post('/ms/courses/update', [CoursesController::class, 'update'])->name('courses.update')->middleware(IsAdmin::class);
Route::get('/ms/courses/delete', [CoursesController::class, 'delete'])->name('courses.delete')->middleware(IsAdmin::class);

Route::get('/ms/courses/seed', [MsController::class, 'seed'])->name('courses.seed');