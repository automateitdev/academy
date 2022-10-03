<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\website\MainController;
use App\Http\Controllers\school\frontend\MenuController;
use App\Http\Controllers\school\master\StartupController;
use App\Http\Controllers\school\master\BasicSetupController;

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
//     return view('frontend');
// });
Route::get('/', [MainController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/person/{person}', [MainController::class, 'getPerson'])->name('person');
Route::get('/teachers', [MainController::class, 'getTeachers'])->name('teachers');

///////dashboard start
//fontend menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::post('/menu/category', [MenuController::class, 'store'])->name('category.store');
Route::post('/menu/subcategory', [MenuController::class, 'substore'])->name('subcategory.store');
Route::get('/getSubCat', [MainController::class, 'getSubCat']);

// startup
Route::get('/MasterSetting/InstituteSetting/startup', [StartupController::class, 'index'])->name('startup.index');
Route::post('/MasterSetting/InstituteSetting/startup/store_cat', [StartupController::class, 'store_cat'])->name('startup.store_cat');
Route::post('/MasterSetting/InstituteSetting/startup/store_subcat', [StartupController::class, 'store_subcat'])->name('startup.store_subcat');
Route::post('/MasterSetting/InstituteSetting/startup/store', [StartupController::class, 'store'])->name('startup.store');
Route::delete('/MasterSetting/InstituteSetting/startup/delete/{id}',[StartupController::class,'destroy'])->name('startup.delete');
Route::get('/getStartupSubCat', [StartupController::class, 'getStartupSubCat']);

//Basic setup
Route::get('/MasterSetting/InstituteSetting/basic', [BasicSetupController::class, 'index'])->name('basic.index');
