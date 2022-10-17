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
use App\Http\Controllers\school\stdManagement\RegistrationController;
use App\Http\Controllers\school\fee_management\FeeStartupController;
use App\Http\Controllers\school\fee_management\FeeMapingController;
use App\Http\Controllers\school\frontend\AdministrationController;
use App\Http\Controllers\school\frontend\GalleryController;

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
Route::get('/', [MainController::class, 'index'])->name('landingpage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/glance', [MainController::class, 'getGlance'])->name('glance');
Route::get('/person/{person}', [MainController::class, 'getPerson'])->name('person');
Route::get('/teachers', [MainController::class, 'getTeachers'])->name('teachers');
Route::get('/teachers/{department}', [MainController::class, 'getTeachers'])->name('teachers');
Route::get('/departments', [MainController::class, 'getDepartments'])->name('departments');
Route::get('/department/{name}', [MainController::class, 'getEachDepartment'])->name('department');


Route::get('/getSubCat', [MainController::class, 'getSubCat']);
Route::get('/about/{subcat_link}/{id}', [MainController::class, 'allAbout']);
Route::get('/administration/{subcat_link}/{id}', [MainController::class, 'administration']);

///////dashboard start

//////////////////////////Website Managemenet Start /////////////////////////
//menu
Route::get('/WebsiteManagement/menu', [MenuController::class, 'index'])->name('menu');
Route::post('/WebsiteManagement/menu/category', [MenuController::class, 'store'])->name('category.store');
Route::post('/WebsiteManagement/menu/subcategory', [MenuController::class, 'substore'])->name('subcategory.store');
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
Route::get('/WebsiteManagement/about/edit/{id}', [AboutController::class, 'edit'])->name('about.edit');
Route::post('/WebsiteManagement/about/update/{id}', [AboutController::class, 'update'])->name('about.update');
Route::post('/WebsiteManagement/about/delete/{id}', [AboutController::class, 'destroy'])->name('about.delete');

//administration
Route::get('/WebsiteManagement/administration', [AdministrationController::class, 'index'])->name('admns.index');
Route::get('/WebsiteManagement/administration/create', [AdministrationController::class, 'create'])->name('admns.create');
Route::post('/WebsiteManagement/administration/store', [AdministrationController::class, 'store'])->name('admns.store');
Route::get('/WebsiteManagement/administration/edit/{id}', [AdministrationController::class, 'edit'])->name('admns.edit');
Route::post('/WebsiteManagement/administration/update/{id}', [AdministrationController::class, 'update'])->name('admns.update');
Route::delete('/WebsiteManagement/administration/delete/{id}', [AdministrationController::class, 'destroy'])->name('admns.delete');

//gallery
Route::get('/WebsiteManagement/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::post('/WebsiteManagement/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
Route::delete('/WebsiteManagement/gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');



// ////////////////////////Website Management end /////////////////////////////

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



//student management
Route::get('/StudentManagement/enrollment/auto_id', [RegistrationController::class, 'index'])->name('enrollment.auto.index');
Route::post('/StudentManagement/enrollment/auto_id/store', [RegistrationController::class, 'store'])->name('enrollment.auto.store');
Route::get('/StudentManagement/enrollment/excel', [RegistrationController::class, 'excel_index'])->name('enrollment.excel.index');
Route::post('/StudentManagement/enrollment/excel/store', [RegistrationController::class, 'excel_store'])->name('enrollment.excel.store');

// Fees Management

Route::get('/FeesManagement/startup/index', [FeeStartupController::class, 'index'])->name('fee.startup.index');
Route::post('/FeesManagement/startup/head/store', [FeeStartupController::class, 'headstore'])->name('fee.startup.headstore');
Route::delete('/FeesManagement/startup/head/{id}',[FeeStartupController::class,'destroy'])->name('fee.startup.headstore.delete');

Route::post('/FeesManagement/startup/subhead/store', [FeeStartupController::class, 'subheadstore'])->name('fee.startup.subheadstore');
Route::delete('/FeesManagement/startup/subhead/{id}',[FeeStartupController::class,'subhead_destroy'])->name('fee.startup.subheadstore.delete');

Route::post('/FeesManagement/startup/waiver/store', [FeeStartupController::class, 'waiverstore'])->name('fee.startup.waiverstore');
Route::delete('/FeesManagement/startup/waiver/{id}',[FeeStartupController::class,'waiver_destroy'])->name('fee.startup.waiverstore.delete');

Route::post('/FeesManagement/startup/fund/store', [FeeStartupController::class, 'fundstore'])->name('fee.startup.fundstore');
Route::delete('/FeesManagement/startup/fund/{id}',[FeeStartupController::class,'fund_destroy'])->name('fee.startup.fundstore.delete');

Route::get('/getAccountCategory', [FeeStartupController::class, 'getAccountCategory']);
Route::post('/FeesManagement/startup/ledger/store', [FeeStartupController::class, 'ledgerstore'])->name('fee.startup.ledgerstore');
Route::delete('/FeesManagement/startup/ledger/{id}',[FeeStartupController::class,'ledger_destroy'])->name('fee.startup.ledger.delete');

//fee maping
Route::get('/FeesManagement/mapping/index', [FeeMapingController::class, 'index'])->name('fee.maping.index');
Route::post('/FeesManagement/mapping/store', [FeeMapingController::class, 'store'])->name('fee.maping.store');
Route::post('/FeesManagement/mapping/fine/store', [FeeMapingController::class, 'fine_store'])->name('fine.maping.store');

Route::delete('/FeesManagement/mapping/fee/{id}',[FeeMapingController::class,'destroy'])->name('fee.maping.delete');
Route::delete('/FeesManagement/mapping/fine/{id}',[FeeMapingController::class,'fine_destroy'])->name('fine.maping.delete');

