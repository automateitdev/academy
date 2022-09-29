<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('frontend');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//fontend menu
Route::get('/menu', [App\Http\Controllers\school\frontend\MenuController::class, 'index'])->name('menu');
Route::post('/menu/category', [App\Http\Controllers\school\frontend\MenuController::class, 'store'])->name('category.store');
Route::post('/menu/subcategory', [App\Http\Controllers\school\frontend\MenuController::class, 'substore'])->name('subcategory.store');


