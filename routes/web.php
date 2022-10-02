<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\website\MainController;
use App\Http\Controllers\school\frontend\MenuController;

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
