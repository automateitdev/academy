<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\website\MainController;
use App\Http\Controllers\website\NoticeViewController;

use App\Http\Controllers\dashboard\frontend\MenuController;
use App\Http\Controllers\dashboard\master\StartupController;
use App\Http\Controllers\dashboard\master\BasicSetupController;
use App\Http\Controllers\dashboard\master\ClassSetupController;
use App\Http\Controllers\dashboard\frontend\SliderController;
use App\Http\Controllers\dashboard\frontend\SpeechController;
use App\Http\Controllers\dashboard\frontend\AboutController;
use App\Http\Controllers\dashboard\stdManagement\RegistrationController;
use App\Http\Controllers\dashboard\fee_management\FeeStartupController;
use App\Http\Controllers\dashboard\fee_management\FeeMapingController;
use App\Http\Controllers\dashboard\frontend\AdministrationController;
use App\Http\Controllers\dashboard\frontend\GalleryController;
use App\Http\Controllers\dashboard\fee_management\AmountController;
use App\Http\Controllers\dashboard\fee_management\DateSetupController;
use App\Http\Controllers\dashboard\fee_management\WaiverController;
use App\Http\Controllers\dashboard\fee_management\FeeCollectionController;
use App\Http\Controllers\dashboard\frontend\NoticeController;
use App\Http\Controllers\dashboard\master\SignatureController;

use App\Http\Controllers\student\StudentAuthController;
use App\Http\Controllers\student\CopyController;
use App\Http\Controllers\dashboard\home\DashboardController;

//exam management
use App\Http\Controllers\dashboard\examManagement\ExamStartupController;
use App\Http\Controllers\dashboard\certificate\ExamCardController;

//admin
use App\Http\Controllers\admin\InstituteController;
use App\Http\Controllers\admin\BankInfoController;
use App\Http\Controllers\admin\RoleAssignController;
use App\Http\Controllers\admin\DomainAssignController;
use App\Http\Controllers\dashboard\examManagement\MarkConfigController;
use App\Http\Controllers\dashboard\examManagement\MarkInputController;
use App\Http\Controllers\dashboard\examManagement\MarkSheetController;
use App\Http\Controllers\dashboard\examManagement\MarkUpdateController;
use App\Http\Controllers\dashboard\examManagement\PositionController;
use App\Http\Controllers\dashboard\examManagement\TabulationController;
use App\Http\Controllers\dashboard\fee_management\HeadWiseReportController;
use App\Http\Controllers\dashboard\fee_management\RemoveController;
use App\Http\Controllers\dashboard\fee_management\OpsController;
use App\Http\Controllers\dashboard\frontend\AboutInstituteController;
use App\Http\Controllers\dashboard\master\SubjectController;
use App\Http\Controllers\dashboard\stdManagement\PromotionController;
use App\Http\Controllers\student\GeneralController;

Route::get('/', [MainController::class, 'index'])->name('landingpage');

Auth::routes();

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/login', [AuthController::class, 'index'])->name('loginFail');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



// Website View start
Route::get('/glance', [MainController::class, 'getGlance'])->name('glance');
Route::get('/person/{person}', [MainController::class, 'getPerson'])->name('person');
Route::get('/teachers', [MainController::class, 'getTeachers'])->name('teachers');
Route::get('/teachers/{department}', [MainController::class, 'getTeachers'])->name('teachers');
Route::get('/departments', [MainController::class, 'getDepartments'])->name('departments');
Route::get('/department/{name}', [MainController::class, 'getEachDepartment'])->name('department');
Route::get('/sobornojointy', [MainController::class, 'corner'])->name('corner');

//menu
Route::get('/getSubCat', [MainController::class, 'getSubCat']);
Route::get('/about/{subcat_link}/{id}', [MainController::class, 'allAbout']);
Route::get('/administration/{subcat_link}/{id}', [MainController::class, 'administration']);

//notice
Route::get('/all/notice', [NoticeViewController::class, 'index'])->name('web.notice');
Route::get('/all/notice/view/{id}', [NoticeViewController::class, 'show'])->name('web.notice.view');
Route::get('/all/notice/download/{id}', [NoticeViewController::class, 'download'])->name('web.notice.download');
//about institute


// Website View end

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    ///////dashboard start
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    //////////////////// Admin Part Start/////////////////////////////////////////

    Route::get('/institute', [InstituteController::class, 'index'])->name('institute.view');
    Route::post('/institute/store', [InstituteController::class, 'store'])->name('institute.store');

    //bank
    Route::get('/bank-info', [BankInfoController::class, 'index'])->name('bankinfo.view');
    Route::post('/bank-info/store', [BankInfoController::class, 'store'])->name('bankinfo.store');

    //role assign
    Route::get('/role-assign', [RoleAssignController::class, 'index'])->name('role.view');
    Route::post('/role-assign/store', [RoleAssignController::class, 'store'])->name('role.store');

    //domain assign
    Route::get('/domain-assign', [DomainAssignController::class, 'index'])->name('domain.view');
    Route::post('/domain-assign/store', [DomainAssignController::class, 'store'])->name('domain.store');





    //////////////////// Admin Part End/////////////////////////////////////////




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
    //notice
    Route::get('/WebsiteManagement/notice', [NoticeController::class, 'index'])->name('notice.index');
    Route::post('/WebsiteManagement/notice/store', [NoticeController::class, 'store'])->name('notice.store');
    Route::delete('/WebsiteManagement/notice/{id}', [NoticeController::class, 'destroy'])->name('notice.delete');
    //about institute
    Route::get('/WebsiteManagement/about_institute', [AboutInstituteController::class, 'index'])->name('aboutinstitute.index');
    Route::post('/WebsiteManagement/about_institute/store', [AboutInstituteController::class, 'store'])->name('aboutinstitute.store');
    Route::get('/WebsiteManagement/about_institute/edit/{id}', [AboutInstituteController::class, 'edit'])->name('aboutinstitute.edit');
    Route::post('/WebsiteManagement/about_institute/update/{id}', [AboutInstituteController::class, 'update'])->name('aboutinstitute.update');

    // ////////////////////////Website Management end /////////////////////////////

    // master setting start
    // startup
    Route::get('/MasterSetting/InstituteSetting/startup', [StartupController::class, 'index'])->name('startup.index');
    Route::post('/MasterSetting/InstituteSetting/startup/store_cat', [StartupController::class, 'store_cat'])->name('startup.store_cat');
    Route::post('/MasterSetting/InstituteSetting/startup/store_subcat', [StartupController::class, 'store_subcat'])->name('startup.store_subcat');
    Route::post('/MasterSetting/InstituteSetting/startup/store', [StartupController::class, 'store'])->name('startup.store');
    Route::delete('/MasterSetting/InstituteSetting/startup/delete/{id}', [StartupController::class, 'destroy'])->name('startup.delete');
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
    Route::delete('/MasterSetting/InstituteSetting/class_setup/group/delete/{id}', [ClassSetupController::class, 'group_destroy'])->name('class.group_destroy');
    Route::get('/getgroupfromgroupassign', [ClassSetupController::class, 'getgroupfromgroupassign']);

    //signature
    Route::get('/MasterSetting/Signature', [SignatureController::class, 'index'])->name('signature.index');
    Route::post('/MasterSetting/Signature/store', [SignatureController::class, 'store'])->name('signature.store');
    Route::delete('/MasterSetting/Signature/delete/{id}', [SignatureController::class, 'destroy'])->name('signature.delete');

    //Subject config
    Route::get('/MasterSetting/Subject_config', [SubjectController::class, 'index'])->name('subject.index');
    Route::post('/MasterSetting/Subjectadd', [SubjectController::class, 'subjectadd'])->name('subjectadd');
    Route::post('/MasterSetting/Subject_config/post', [SubjectController::class, 'store'])->name('subjectadd.store');

    Route::get('/MasterSetting/4th_Subject_config', [SubjectController::class, 'fourthsubject'])->name('fourthsubject.index');
    Route::get('/MasterSetting/4th_Subject_config/query', [SubjectController::class, 'search'])->name('fourthsubject.search');
    Route::get('/MasterSetting/4th_Subject_config/single_subject/{student_id}', [SubjectController::class, 'singleedit'])->name('fourthsubject.single.edit');
    Route::post('/MasterSetting/4th_Subject_config/update', [SubjectController::class, 'foursubjectupdate'])->name('foursubjectupdate');
    Route::get('/MasterSetting/4th_Subject_config/multiple_subject/{id}', [SubjectController::class, ' multipleedit'])->name('fourthsubject.multiple.edit');

    Route::get('/MasterSetting/Subject_config/show', [SubjectController::class, 'show'])->name('subject.show');
    Route::get('/MasterSetting/Subject_config/show/query', [SubjectController::class, 'show_query'])->name('subject.show_query');
    Route::get('/MasterSetting/4th_Subject_config/view/{student_id}', [SubjectController::class, 'subjectdetials'])->name('allsubject.view');



    //master setting end

    ///////////////////////Student Management Start ///////////////

    //enrollment
    Route::get('/StudentManagement/enrollment/auto_id', [RegistrationController::class, 'index'])->name('enrollment.auto.index');
    Route::post('/StudentManagement/enrollment/auto_id/store', [RegistrationController::class, 'store'])->name('enrollment.auto.store');
    Route::get('/StudentManagement/enrollment/excel', [RegistrationController::class, 'excel_index'])->name('enrollment.excel.index');
    Route::post('/StudentManagement/enrollment/excel/store', [RegistrationController::class, 'excel_store'])->name('enrollment.excel.store');
    Route::get('/download/excel', [RegistrationController::class, 'download'])->name('excel.download');
    Route::get('/getgroupforenrollement', [RegistrationController::class, 'getgroupforenrollement']);

    //promotion
    Route::get('/StudentManagement/promotion/with_merit', [PromotionController::class, 'with_merit_index'])->name('with_merit.index');

    Route::get('/StudentManagement/promotion/without_merit', [PromotionController::class, 'without_merit_index'])->name('without_merit.index');
    Route::get('/StudentManagement/promotion/without_merit_query', [PromotionController::class, 'without_merit_search'])->name('without_merit.search');
    Route::post('/StudentManagement/promotion/without_merit/post', [PromotionController::class, 'without_merit_post'])->name('without_merit.post');

    Route::get('/StudentManagement/promotion/pushback', [PromotionController::class, 'pushback_index'])->name('pushback.index');

    //////////////////////Student Management End //////////////

    ///////////////////// Fees Management Start ///////////

    Route::get('/FeesManagement/startup/index', [FeeStartupController::class, 'index'])->name('fee.startup.index');
    Route::post('/FeesManagement/startup/head/store', [FeeStartupController::class, 'headstore'])->name('fee.startup.headstore');
    Route::delete('/FeesManagement/startup/head/{id}', [FeeStartupController::class, 'destroy'])->name('fee.startup.headstore.delete');

    Route::post('/FeesManagement/startup/subhead/store', [FeeStartupController::class, 'subheadstore'])->name('fee.startup.subheadstore');
    Route::delete('/FeesManagement/startup/subhead/{id}', [FeeStartupController::class, 'subhead_destroy'])->name('fee.startup.subheadstore.delete');

    Route::post('/FeesManagement/startup/waiver/store', [FeeStartupController::class, 'waiverstore'])->name('fee.startup.waiverstore');
    Route::delete('/FeesManagement/startup/waiver/{id}', [FeeStartupController::class, 'waiver_destroy'])->name('fee.startup.waiverstore.delete');

    Route::post('/FeesManagement/startup/fund/store', [FeeStartupController::class, 'fundstore'])->name('fee.startup.fundstore');
    Route::delete('/FeesManagement/startup/fund/{id}', [FeeStartupController::class, 'fund_destroy'])->name('fee.startup.fundstore.delete');

    Route::get('/getAccountCategory', [FeeStartupController::class, 'getAccountCategory']);
    Route::post('/FeesManagement/startup/ledger/store', [FeeStartupController::class, 'ledgerstore'])->name('fee.startup.ledgerstore');
    Route::delete('/FeesManagement/startup/ledger/{id}', [FeeStartupController::class, 'ledger_destroy'])->name('fee.startup.ledger.delete');

    //fee maping
    Route::get('/FeesManagement/mapping/index', [FeeMapingController::class, 'index'])->name('fee.maping.index');
    Route::post('/FeesManagement/mapping/store', [FeeMapingController::class, 'store'])->name('fee.maping.store');
    Route::post('/FeesManagement/mapping/fine/store', [FeeMapingController::class, 'fine_store'])->name('fine.maping.store');
    Route::delete('/FeesManagement/mapping/fee/{id}', [FeeMapingController::class, 'destroy'])->name('fee.maping.delete');
    Route::delete('/FeesManagement/mapping/fine/{id}', [FeeMapingController::class, 'fine_destroy'])->name('fine.maping.delete');

    //fee amount
    Route::get('/FeesManagement/amount/index', [AmountController::class, 'index'])->name('amount.index');
    Route::post('/FeesManagement/amount/feeamount/store', [AmountController::class, 'store'])->name('fee.amount.store');
    Route::get('/FeesManagement/amount/feeamount/edit/{id}', [AmountController::class, 'edit'])->name('fee.amount.edit');
    Route::post('/FeesManagement/amount/feeamount/update', [AmountController::class, 'update'])->name('fee.amount.update');
    Route::delete('/FeesManagement/amount/feeamount/{id}', [AmountController::class, 'destroy'])->name('fee.amount.delete');
    Route::post('/FeesManagement/amount/fineamount/store', [AmountController::class, 'fineStore'])->name('fine.amount.store');

    Route::delete('/FeesManagement/amount/fineamount/delete/{id}', [AmountController::class, 'absentdestroy'])->name('fine.amount.delete');

    Route::get('/getFeeheadToFund', [AmountController::class, 'getFeeheadToFund']);
    Route::get('/getGroupForAmount', [AmountController::class, 'getGroupForAmount']);


    //date config
    Route::get('/FeesManagement/datesetup/index', [DateSetupController::class, 'index'])->name('date.index');
    Route::post('/FeesManagement/datesetup/store', [DateSetupController::class, 'store'])->name('date.store');
    Route::get('/getFeesubheadfromFeehead', [DateSetupController::class, 'getFeesubheadfromFeehead']);

    //waiver config
    Route::get('/FeesManagement/waiver/index', [WaiverController::class, 'index'])->name('waiver.index');
    Route::get('/FeesManagement/waiver/index/query', [WaiverController::class, 'search'])->name('waiver.search');
    Route::get('/getSectionForWaiver', [WaiverController::class, 'getSectionForWaiver']);
    Route::get('/FeesManagement/waiver/edit/{id}', [WaiverController::class, 'edit'])->name('waiver.edit');
    Route::post('/FeesManagement/waiver/store/{id}', [WaiverController::class, 'store'])->name('waiver.store');
    Route::get('/getfeeheadForWaiver', [WaiverController::class, 'getfeeheadForWaiver']);
    // feehead remove
    Route::get('/FeesManagement/feehead_remove', [RemoveController::class, 'feeheadindex'])->name('fee.remove.index');
    Route::get('/FeesManagement/feehead_remove/query', [RemoveController::class, 'feeheadsearch'])->name('feeheadsearch');
    Route::get('/FeesManagement/feehead_remove/details/{id}', [RemoveController::class, 'feeheadremove'])->name('feeheadremove');
    Route::post('/FeesManagement/feehead_remove/store', [RemoveController::class, 'feeheadstore'])->name('feeheadremove.store');
    // sub head remove
    Route::get('/FeesManagement/feesubhead_remove', [RemoveController::class, 'feesubheadindex'])->name('feesub.remove.index');
    Route::get('/FeesManagement/feesubhead_remove/query', [RemoveController::class, 'feesubheadsearch'])->name('feesubheadsearch');
    Route::get('/FeesManagement/feesubhead_remove/details/{id}', [RemoveController::class, 'feesubheadremove'])->name('feesubheadremove');
    Route::post('/FeesManagement/feesubhead_remove/store', [RemoveController::class, 'feesubheadstore'])->name('feesubheadremove.store');
    Route::get('/getsubheadforremove', [RemoveController::class, 'getsubheadforremove']);
    //fee head reassign
    Route::get('/FeesManagement/feehead_assign/details/{id}', [RemoveController::class, 'feeheadassign'])->name('feeheadassign');
    Route::post('/FeesManagement/feehead_assign/store', [RemoveController::class, 'feeheadassignstore'])->name('feeheadassignstore.store');
    //fee sub head reassign
    Route::get('/FeesManagement/feesubhead_assign/details/{id}', [RemoveController::class, 'feesubheadassign'])->name('feesubheadassign');
    Route::post('/FeesManagement/feesubhead_assign/store', [RemoveController::class, 'feesubheadassignstore'])->name('feesubheadassignstore.store');

    //Fee Collection Controller
    Route::get('/FeesManagement/feecollection/quickcollection/index', [FeeCollectionController::class, 'index'])->name('feecollection.index');
    Route::get('/FeesManagement/feecollection/quickcollection/query', [FeeCollectionController::class, 'quicksearch'])->name('quicksearch');
    Route::get('/FeesManagement/feecollection/view/{id}', [FeeCollectionController::class, 'show'])->name('feecollection.view');
    Route::post('/FeesManagement/feecollection/quickcollection/process', [FeeCollectionController::class, 'quickprocess'])->name('quickcollection.process');
    Route::get('/getStudentdata', [FeeCollectionController::class, 'getStudentdata']);
    //report
    Route::get('/FeesManagement/report/ops-collection', [OpsController::class, 'index'])->name('ops.index');
    Route::post('/FeesManagement/report/ops-collection/query', [OpsController::class, 'search'])->name('ops.search');
    Route::get('/FeesManagement/report/ops-collection/{invoice}', [OpsController::class, 'show'])->name('ops.show');

    Route::get('/FeesManagement/report/head-wise-collection', [HeadWiseReportController::class, 'index'])->name('hwrc.index');
    Route::get('/FeesManagement/report/head-wise-collection/query', [HeadWiseReportController::class, 'search'])->name('hwrc.search');

    ////////////////////// Fees Management End ////////////


    /////////////////////// Exam Management Start//////////////////
    Route::get('/exam-management/exam-startup', [ExamStartupController::class, 'index'])->name('examstartup');
    Route::post('/exam-management/exam-startup/store', [ExamStartupController::class, 'store'])->name('examstartup.store');
    Route::post('/exam-management/exam-code/store', [ExamStartupController::class, 'examcode_store'])->name('examcode.store');
    Route::post('/exam-management/exam-code/update', [ExamStartupController::class, 'examcode_update'])->name('examcode.update');
    Route::post('/exam-management/exam-grade/store', [ExamStartupController::class, 'examgrade_store'])->name('examgrade.store');
    Route::post('/exam-management/exam-grade/update', [ExamStartupController::class, 'examgrade_update'])->name('examgrade.update');
    //mark config
    Route::get('/exam-management/Mark_config', [MarkConfigController::class, 'index'])->name('markconfig');
    Route::get('/exam-management/Mark_config/query', [MarkConfigController::class, 'search'])->name('markconfig.search');
    Route::post('/exam-management/Mark_config/store', [MarkConfigController::class, 'store'])->name('markconfig.store');
    Route::post('/exam-management/Mark_config/update', [MarkConfigController::class, 'update'])->name('markconfig.update');
    //mark input
    Route::post('/exam-management/Mark_input/store', [MarkInputController::class, 'store'])->name('markinput.store');

    Route::get('/exam-management/Mark_input', [MarkInputController::class, 'index'])->name('markinput');
    Route::get('/exam-management/Mark_input/query', [MarkInputController::class, 'search'])->name('markinput.search');
    Route::get('/getexamfromexamcreate', [MarkInputController::class, 'getexamfromexamcreate']);
    Route::get('/getsubjectinfo', [MarkInputController::class, 'getsubjectinfo']);
    Route::get('/getgroupforexaminput', [MarkInputController::class, 'getgroupforexaminput']);
    //mark update
    Route::get('/exam-management/Mark_update', [MarkUpdateController::class, 'index'])->name('markupdate');
    Route::get('/exam-management/Mark_update/query', [MarkUpdateController::class, 'search'])->name('markupdate.search');
    Route::post('/exam-management/Mark_input/update', [MarkUpdateController::class, 'store'])->name('markupdate.update');
    //report
    //tabulation sheet
    Route::get('/exam-management/Tabulation_sheet', [TabulationController::class, 'index'])->name('tabulation');
    Route::get('/Tabulation_sheet_generate', [TabulationController::class, 'processResult'])->name('tabulation.process');
    //mark sheet
    Route::get('/exam-management/Mark_sheet', [MarkSheetController::class, 'index'])->name('marksheet');
    Route::get('/marksheet_query', [MarkSheetController::class, 'marksQuery'])->name('marksheet.query');
    Route::get('/marksheet_sheet_generate', [MarkSheetController::class, 'processmarksheet'])->name('marksheet.process');
    //marit position
    Route::get('/exam-management/result_process/merit_position', [PositionController::class, 'index'])->name('merit_position.index');


    /////////////////////// Exam Management End//////////////////

    /////////////////////// Layout & Certificate Start/////////////////
    Route::get('/layout&certificate/exam-essential', [ExamCardController::class, 'index'])->name('exam.card.index');
    Route::get('/getStudentForAdmitCard', [ExamCardController::class, 'getStudentForAdmitCard']);
    Route::get('/layout&certificate/exam-essential/admitprint', [ExamCardController::class, 'admitprint'])->name('admitprint');

    // Route::get('/getAdmitInfo', [ExamCardController::class, 'getAdmitInfo']);
    Route::get('/admitprint', [ExamCardController::class, 'admitprint']);
    /////////////////////// Layout & Certificate End//////////////////

    /////////////////////// Dashboard End//////////////////

});

// ///////////////////// Student Portal Start////////////////////////////
Route::get('/Student_Portal', [StudentAuthController::class, 'index'])->name('student.auth.index');

Route::post('/Student_Portal/payment', [StudentAuthController::class, 'authentication'])->name('student.auth.submit');
Route::post('/makepayment', [StudentAuthController::class, 'makepayment'])->name('makepayment');
Route::get('/confirmation', [StudentAuthController::class, 'confirmation'])->name('confirmation');
Route::get('/getDataForPaymentReport', [GeneralController::class, 'getReportData']);

    

    // Route::get('/Student_Portal', [CopyController::class, 'index'])->name('student.auth.index');

    // Route::post('/Student_Portal/payment', [CopyController::class, 'authentication'])->name('student.auth.submit');
    // Route::post('/makepayment', [CopyController::class, 'makepayment'])->name('makepayment');
    // Route::get('/confirmation',[CopyController::class, 'confirmation'])->name('confirmation');

    // ///////////////////// Student Portal End////////////////////////////