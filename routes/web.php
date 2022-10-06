<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\website\MainController;
use App\Http\Controllers\school\frontend\MenuController;
use App\Http\Controllers\school\master\StartupController;
use App\Http\Controllers\school\master\BasicSetupController;
use App\Http\Controllers\school\master\ClassSetupController;
use App\Http\Controllers\school\frontend\SliderController;
use App\Http\Controllers\school\frontend\SpeechController;
use App\Http\Controllers\school\frontend\AboutController;

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

Route::get('/glance', [MainController::class, 'getGlance'])->name('glance');
Route::get('/person/{person}', [MainController::class, 'getPerson'])->name('person');
Route::get('/teachers', [MainController::class, 'getTeachers'])->name('teachers');
Route::get('/teachers/{department}', [MainController::class, 'getTeachers'])->name('teachers');
Route::get('/departments', [MainController::class, 'getDepartments'])->name('departments');
Route::get('/department/{name}', [MainController::class, 'getEachDepartment'])->name('department');


Route::get('/getSubCat', [MainController::class, 'getSubCat']);
Route::get('/{id}', [MainController::class, 'allAbout']);

///////dashboard start
//fontend menu
Route::get('/WebsiteManagement/menu', [MenuController::class, 'index'])->name('menu');
Route::post('/WebsiteManagement/menu/category', [MenuController::class, 'store'])->name('category.store');
Route::post('/WebsiteManagement/menu/subcategory', [MenuController::class, 'substore'])->name('subcategory.store');


// startup
Route::get('/MasterSetting/InstituteSetting/startup', [StartupController::class, 'index'])->name('startup.index');
Route::post('/MasterSetting/InstituteSetting/startup/store_cat', [StartupController::class, 'store_cat'])->name('startup.store_cat');
Route::post('/MasterSetting/InstituteSetting/startup/store_subcat', [StartupController::class, 'store_subcat'])->name('startup.store_subcat');
Route::post('/MasterSetting/InstituteSetting/startup/store', [StartupController::class, 'store'])->name('startup.store');
Route::delete('/MasterSetting/InstituteSetting/startup/delete/{id}',[StartupController::class,'destroy'])->name('startup.delete');
Route::get('/getStartupSubCat', [StartupController::class, 'getStartupSubCat']);

//Basic setup
Route::get('/MasterSetting/InstituteSetting/basic', [BasicSetupController::class, 'index'])->name('basic.index');
Route::post('/MasterSetting/InstituteSetting/basic/store', [BasicSetupController::class, 'store'])->name('basic.store');
Route::get('/MasterSetting/InstituteSetting/basic/edit/{id}', [BasicSetupController::class, 'edit'])->name('basic.edit');
Route::post('/MasterSetting/InstituteSetting/basic/update/{id}', [BasicSetupController::class, 'update'])->name('basic.update');

// calss setup
Route::get('/MasterSetting/InstituteSetting/class_setup', [ClassSetupController::class, 'index'])->name('class.index');
Route::post('/MasterSetting/InstituteSetting/class_setup/section_store', [ClassSetupController::class, 'section_store'])->name('class.section_store');
Route::post('/MasterSetting/InstituteSetting/class_setup/group_store', [ClassSetupController::class, 'group_store'])->name('class.group_store');

// slidercontroller
Route::get('/WebsiteManagement/slider', [SliderController::class, 'index'])->name('slider.index');
Route::post('/WebsiteManagement/slider/store', [SliderController::class, 'store'])->name('slider.store');
Route::post('/WebsiteManagement/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
Route::post('/WebsiteManagement/slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
Route::post('/WebsiteManagement/slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider.delete');

//speechController
Route::get('/WebsiteManagement/speech', [SpeechController::class, 'index'])->name('speech.index');
Route::post('/WebsiteManagement/speech/store', [SpeechController::class, 'store'])->name('speech.store');
Route::get('/WebsiteManagement/speech/edit/{id}', [SpeechController::class, 'edit'])->name('speech.edit');
Route::post('/WebsiteManagement/speech/update/{id}', [SpeechController::class, 'update'])->name('speech.update');

//about controller

Route::get('/WebsiteManagement/about', [AboutController::class, 'index'])->name('about.index');
Route::post('/WebsiteManagement/about/store', [AboutController::class, 'store'])->name('about.store');