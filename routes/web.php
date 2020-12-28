<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\PlatformsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MsController;
use App\Http\Controllers\Recommend\AssocAlsoRated;
use App\Http\Controllers\SetsController;
use App\Http\Controllers\StatsController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UfavouriteController;
use App\Http\Controllers\UcourseController;
use App\Http\Controllers\UpromotionController;
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



Auth::routes();


// Management System

Route::get('/ms', [MsController::class, 'index'])->name('ms-home')->middleware(IsAdmin::class);
Route::get('/ms/statistics', [StatsController::class, 'index'])->name('ms-stats')->middleware(IsAdmin::class);
Route::get('/ms/settings', [SetsController::class, 'index'])->name('ms-sets')->middleware(IsAdmin::class);
Route::get('/ms/settings/seed', [SetsController::class, 'seed'])->name('ms-sets-seed')->middleware(IsAdmin::class);
Route::get('/ms/settings/seed/confirm', [SetsController::class, 'seedConfirm'])->name('ms-sets-seed-confirm')->middleware(IsAdmin::class);
Route::get('/ms/settings/recommend', [SetsController::class, 'recommend'])->name('ms-sets-recommend')->middleware(IsAdmin::class);
Route::get('/ms/settings/recommend/move', [SetsController::class, 'recommend_action'])->name('ms-sets-recommend-move')->middleware(IsAdmin::class);

Route::get('/ms/courses', [MsController::class, 'indexCourse'])->name('ms-course')->middleware(IsAdmin::class);
Route::get('/ms/platforms', [MsController::class, 'indexPlatform'])->name('ms-platform')->middleware(IsAdmin::class);
Route::get('/ms/categories', [MsController::class, 'indexCategory'])->name('ms-category')->middleware(IsAdmin::class);
Route::get('/ms/promotions', [MsController::class, 'indexPromotion'])->name('ms-promotion')->middleware(IsAdmin::class);
Route::get('/ms/users', [MsController::class, 'indexUser'])->name('ms-user')->middleware(IsAdmin::class);
Route::get('/ms/users/mod', [MsController::class, 'modUser'])->name('ms-user-mod')->middleware(IsAdmin::class);

Route::get('/ms/add', [MsController::class, 'add'])->name('ms-add')->middleware(IsAdmin::class);
Route::get('/ms/edit', [MsController::class, 'edit'])->name('ms-edit')->middleware(IsAdmin::class);
Route::get('/ms/remove', [MsController::class, 'remove'])->name('ms-remove')->middleware(IsAdmin::class);

Route::post('/ms/courses/store', [CoursesController::class, 'store'])->name('courses.store')->middleware(IsAdmin::class);
Route::post('/ms/courses/update', [CoursesController::class, 'update'])->name('courses.update')->middleware(IsAdmin::class);
Route::get('/ms/courses/delete', [CoursesController::class, 'delete'])->name('courses.delete')->middleware(IsAdmin::class);

Route::post('/ms/platforms/store', [PlatformsController::class, 'store'])->name('platforms.store')->middleware(IsAdmin::class);
Route::post('/ms/platforms/update', [PlatformsController::class, 'update'])->name('platforms.update')->middleware(IsAdmin::class);
Route::get('/ms/platforms/delete', [PlatformsController::class, 'delete'])->name('platforms.delete')->middleware(IsAdmin::class);

Route::post('/ms/categories/store', [CategoriesController::class, 'store'])->name('categories.store')->middleware(IsAdmin::class);
Route::post('/ms/categories/update', [CategoriesController::class, 'update'])->name('categories.update')->middleware(IsAdmin::class);
Route::get('/ms/categories/delete', [CategoriesController::class, 'delete'])->name('categories.delete')->middleware(IsAdmin::class);

Route::post('/ms/promotions/store', [PromotionsController::class, 'store'])->name('promotions.store')->middleware(IsAdmin::class);
Route::post('/ms/promotions/update', [PromotionsController::class, 'update'])->name('promotions.update')->middleware(IsAdmin::class);
Route::get('/ms/promotions/delete', [PromotionsController::class, 'delete'])->name('promotions.delete')->middleware(IsAdmin::class);

Route::get('/ms/courses/seed', [MsController::class, 'seed'])->name('courses.seed');
Route::get('/ms/courses/test', [CoursesController::class, 'getRec']);

//user
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/course', [UcourseController::class, 'index']);
Route::get('/search',[UcourseController::class, 'search']);
Route::get('/category/{$id}',[UcourseController::class, 'category'])->middleware('auth');
Route::get('/course/{id}', [UcourseController::class, 'coursedetails'])->name('coursedetails');
Route::get('/favourite', [UfavouriteController::class, 'index'])->middleware('auth');
Route::get('/promotion', [UpromotionController::class, 'index'])->middleware('auth');
Route::get('/course/addtofav/{id}',[UfavouriteController::class, 'addtofav'])->middleware('auth');
Route::get('/favourite/removefav/{id}',[UfavouriteController::class, 'removefav'])->middleware('auth');
Route::post('/createrating',[UCourseController::class, 'createrating'])->name('ratings.create')->middleware('auth');
Route::get('/rating/removerating/{id}',[UCourseController::class, 'removerating'])->middleware('auth');
Route::get('/rating/editrating/{id}',[UCourseController::class, 'editrating'])->middleware('auth');
Route::post('/updaterating',[UCourseController::class, 'updaterating'])->name('ratings.update')->middleware('auth');
Route::get('/userdetails', [UserController::class, 'index'])->name('userdetails')->middleware('auth');