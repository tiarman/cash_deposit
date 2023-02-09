<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminVoucherController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackgroundImageController;
use App\Http\Controllers\Budget\ComponentBudgetController;
use App\Http\Controllers\Budget\ComponentInstituteBudgetController;
use App\Http\Controllers\Budget\SubComponentInstituteBudgetController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoreModuleController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EAF\RplController;
use App\Http\Controllers\EAF\ShortCourseController;
use App\Http\Controllers\EAF\IdgController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\FiscalBudgetController;
use App\Http\Controllers\FiscalPeriodController;
use App\Http\Controllers\FiscalYearController;
use App\Http\Controllers\Institute\InstituteBuildingController;
use App\Http\Controllers\Institute\InstituteController;
use App\Http\Controllers\Institute\InstituteHeadController;
use App\Http\Controllers\Institute\InstituteTypeController;
use App\Http\Controllers\JobExperiencController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectIdeaController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubAgentController;
use App\Http\Controllers\SubComponentController;
use App\Http\Controllers\SubsidiaryComponentController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\TrainingApprovalController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingMemberController;
use App\Http\Controllers\TrainingTypeController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VoucherTypeController;
use App\Http\Controllers\JobEventController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\IndustryPostController;
use App\Http\Controllers\EmployerController;
use App\Models\BackgroundImage;
use Illuminate\Http\Request;
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


//Route::get('/test', function () {
////  return \App\Models\User::with('permissions', 'roles')->find(auth()->id());
//  ini_set('max_execution_time', 300);
//  \Illuminate\Support\Facades\Mail::to('info@rast.com')->cc('admin@rast.com')->send(new \App\Mail\EligibilityApplicationFormIdgMail(\route('form.pdf', 1)));
//  return view('email.test');
//})->name('test');


//Route::get('send-mail', [ContactController::class, 'sendDemoMail'])->name('sendDemoMail');
//Route::get('sendbasicemail', [MailController::class, 'sendbasicemail'])->name('sendbasicemail');
//Route::get('/jobpost', function (){
//    return view('site.job.jobpostjobpost');
//})->name('jobpost');

Route::get('/jobpost', [SiteController::class, 'jobpost'])->name('jobpost');
Route::get('/graduate-list', [SiteController::class, 'graduateList'])->name('graduate.list');
Route::get('/graduate-info/{id}', [SiteController::class, 'graduateInfo'])->name('graduate.Info');
Route::get('/job_post_details/{id}', [SiteController::class, 'job_post_details'])->name('job_post_details');

Route::get('/training/{trainingId}/file/{id}/delete', [TrainingController::class, 'trainingFileDelete'])->name('training.file.delete');


Route::match(['get', 'post'], '/form', [IdgController::class, 'createForm'])->middleware('auth')->name('form');
Route::get('/form/{id}', [IdgController::class, 'pdf'])->name('form.pdf');
Route::get('/form/{formId}/file/{id}/delete', [IdgController::class, 'formFileDelete'])->name('form.file.delete');
Route::match(['get', 'post'], '/register', [AuthController::class, 'register'])->name('register');

Route::match(['get', 'post'], '/institute', [AuthController::class, 'instituteCreateWithUser'])->name('institute.registration');
Route::match(['get', 'post'], '/bteb', [AuthController::class, 'bteb'])->name('bteb.registration');
Route::match(['get', 'post'], '/isc', [AuthController::class, 'isc'])->name('isc.registration');
Route::match(['get', 'post'], '/association', [AuthController::class, 'association'])->name('association.registration');
Route::match(['get', 'post'], '/industry', [AuthController::class, 'industry'])->name('industry.registration');
Route::match(['get', 'post'], '/dgnm', [AuthController::class, 'dgnm'])->name('dgnm.registration');
Route::match(['get', 'post'], '/training', [AuthController::class, 'training'])->name('training.registration');
Route::match(['get', 'post'], '/trainee', [AuthController::class, 'trainee'])->name('trainee.registration');
Route::match(['get', 'post'], '/teacher', [AuthController::class, 'teacher'])->name('teacher.registration');
Route::match(['get', 'post'], '/bmet', [AuthController::class, 'bmet'])->name('bmet.registration');
Route::match(['get', 'post'], '/pmu', [AuthController::class, 'pmu'])->name('pmu.registration');
Route::match(['get', 'post'], '/bteb', [AuthController::class, 'bteb'])->name('bteb.registration');
Route::match(['get', 'post'], '/moi', [AuthController::class, 'moi'])->name('moi.registration');
Route::match(['get', 'post'], '/evaluator', [AuthController::class, 'evalutor'])->name('evalutor.registration');
Route::match(['get', 'post'], '/mentor', [AuthController::class, 'mentor'])->name('mentor.registration');
Route::match(['get', 'post'], '/dte', [AuthController::class, 'dte'])->name('dte.registration');
Route::match(['get', 'post'], '/tmed', [AuthController::class, 'tmed'])->name('tmed.registration');
Route::match(['get', 'post'], '/nsda', [AuthController::class, 'nsda'])->name('nsda.registration');
Route::match(['get', 'post'], '/dgnm', [AuthController::class, 'dgnm'])->name('dgnm.registration');
Route::match(['get', 'post'], '/isc', [AuthController::class, 'isc'])->name('isc.registration');
Route::match(['get'], '/event/{id}/participant-form', [AuthController::class, 'event_participant'])->name('eventParticipant.registration');
// Route::match(['get'], '/contact', [AuthController::class, 'contact'])->name('contact');
Route::match(['get','post'], '/ims-contact', function(){
  return view('site.ims_contact');
})->name('contact');


Route::get('/glass', function () {
  return view('site.registration.arif_glassmorPhism');
})->name('registration.arif_glassmorPhism');


//Frontend Dependency selector
Route::get('api/fetch-users', [ApiController::class, 'users']);
Route::get('api/fetch-districts/{id}', [ApiController::class, 'districts']);
Route::get('api/fetch-upazilas/{id}', [ApiController::class, 'upazilas']);
Route::get('api/fetch-institutes/{id}', [ApiController::class, 'institutes']);
Route::get('api/component-budget/{id}', [ApiController::class, 'getComponentBudget']);
Route::get('api/component-institute-budget/{year_id}/{institute_id}', [ApiController::class, 'getComponentBudgetFromYearAndInstitute']);
Route::get('api/sub-component/{component_id}', [ApiController::class, 'getSubComponent']);


Route::get('/', [SiteController::class, 'home'])->name('home');


Route::get('/linkpage', function () {
  return view('site.linkpage');
})->name('linkpage');

Route::get('/demo', function () {
  return view('site.demo');
})->name('demo');

//Route::get('/job-fair-list', function () {
//  return view('site.job.jobFairList');
//})->name('jobfair.list');
Route::get('/job-fair-list', [SiteController::class, 'indexJobEvent'])->name('jobfair.list');
// event join
Route::post('/job-fair-list',[SiteController::class,'jobEventApply'])->name('ajax.jobfair.apply');

Route::get('/job-fair-details/{id}',[SiteController::class,'JobEvent'])->name('jobfair.details');

Route::get('/job-list/{id}',[SiteController::class,'industryPost'])->name('jobs');
Route::get('/post-details/{id}', function () {
  return redirect('/register');
})->name('post.details');

Route::get('/job-application', function () {
  return view('site.job.jobApplicationForm');
})->name('job.application');

Route::get('/job-seeker-registration', function () {
  return view('site.job.seekerRegistration');
})->name('job.seeker.registration');


Route::get('/job-employee-registration', function () {
  return view('site.job.employeeRegistration');
})->name('job.employee.registration');

Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');


Route::get('/reset-password/{token}', function ($token) {
  $data['images'] = BackgroundImage::where('status', BackgroundImage::$statusArray[0])->get();
  $data['token'] = $token;
  return view('admin.auth.reset-password', $data);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password/store/{token}', [AuthController::class, 'resetPassword'])
  ->middleware(['guest:' . config('fortify.guard')])
  ->name('password.reset.store');

//Route::get('/email/verify', function () {
//  $data['images'] = BackgroundImage::where('status', BackgroundImage::$statusArray[0])->get();
//  return view('admin.auth.verify-email', $data);
//})->middleware('auth')->name('verification.notice');
Route::get('/forgot-password', function () {
  $data['images'] = BackgroundImage::where('status', BackgroundImage::$statusArray[0])->get();
  return view('admin.auth.forget-password', $data);
})->middleware('guest')->name('password.request');

//Route::post('/email/verification-notification', function (Request $request) {
//  $request->user()->sendEmailVerificationNotification();
//  \Illuminate\Support\Facades\Session::put('email', $request->user()->email);
//  return redirect()->back();
//})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::post('/post/apply', [SiteController::class, 'postApply'])->name('ajax.post.apply');
Route::get('/admin/logout', [AdminController::class, 'logout'])->middleware('auth')->name('admin.logout');
Route::prefix('/admin')->name('admin.')->middleware(['auth'])->group(function () {
  Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
  Route::get('/profile', [AdminController::class, 'profile'])->name('profile.show');
  Route::post('/profile/update', [AdminController::class, 'profileUpdate'])->name('profile.update');
  Route::post('/password/update', [AdminController::class, 'passwordUpdate'])->name('password.update');
  Route::match(['get', 'post'], '/institute-profile', [AdminController::class, 'instituteProfile'])->name('instituteProfile');

  Route::prefix('ajax')->name('ajax.')->group(function () {
//    Route::match(['get', 'post'], '/post/apply', [SiteController::class, 'postApply'])->name('post.apply');
    Route::get('/institute/from/type-and-division', [SearchController::class, 'searchInstituteFromTypeAndDivision'])->name('institute.from.type.and.division');
    Route::get('/user/from/institute', [SearchController::class, 'searchUserFromInstitute'])->name('user.from.institute');
    Route::prefix('search')->name('search.')->group(function () {
      Route::get('/participate/type', [SearchController::class, 'searchParticipateType'])->name('participate.type');
      Route::get('/building/name', [SearchController::class, 'searchBuildingName'])->name('building.name');
      Route::get('/block/name', [SearchController::class, 'searchBlockName'])->name('block.name');
      Route::get('/floor/name', [SearchController::class, 'searchFloorName'])->name('floor.name');
      Route::get('/room/name', [SearchController::class, 'searchRoomName'])->name('room.name');
      Route::get('/room/no', [SearchController::class, 'searchRoomNo'])->name('room.no');
      Route::get('/item/name', [SearchController::class, 'searchItemName'])->name('item.name');
      Route::get('/idea/student/name', [SearchController::class, 'searchUserName'])->name('idea.student.name');
    });
//    Route::get('/get-student-prefix', [ProjectIdeaController::class, 'ajaxprojectIdeaStudent'])->name('get.student.prefix');
    Route::post('/make/{id}/-as-read', [NotificationController::class, 'ajaxUpdateAsRead'])->name('make.modal.as.read');
    Route::post('/permission-by-role', [PermissionController::class, 'getPermissionByRole'])->middleware('role_or_permission:Super Admin|Manage Permission')->name('get.permission.by.role');
    Route::post('/update/user/status', [UserController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Super Admin|Manage User|Manage Institute User')->name('update.user.status');
    Route::post('/update/subagent/status', [SubAgentController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Super Admin|Manage Sub Agent')->name('update.subagent.status');
    Route::post('/update/backgrouond/status', [BackgroundImageController::class, 'ajaxUpdateStatus'])->name('update.backgroundImage.status');

  });

  // Event Module
  Route::prefix('/event')->name('event.')->group(function () {
    Route::get('/create', function () {
      return view('admin.event.create');
    })->name('create');
    Route::get('/list', function () {
      return view('admin.event.list');
    })->name('list');
    Route::get('/report', function () {
      return view('admin.event.report');
    })->name('report');
  });

#Division
  Route::prefix('division')->name('division.')->group(function () {
    Route::get('/create', [DivisionController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Division')->name('create');
    Route::post('/store', [DivisionController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Division|Manage Division')->name('store');
    Route::get('/manage/{id}', [DivisionController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Division')->name('manage');
    Route::get('/{id}/view', [DivisionController::class, 'view'])->middleware('role_or_permission:Super Admin|View Division')->name('view');
    Route::delete('/destroy', [DivisionController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Division')->name('destroy');
    Route::get('/list', [DivisionController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Division')->name('list');
  });




#Sub Agent
    Route::prefix('subagent')->name('subagent.')->group(function () {
        Route::get('/create', [SubAgentController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Sub Agent')->name('create');
        Route::post('/store', [SubAgentController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Sub Agent')->name('store');
        Route::get('/manage/{id}', [SubAgentController::class, 'manage'])->middleware('role_or_permission:Super Admin|Create Sub Agent')->name('manage');
        Route::get('/{id}/view', [SubAgentController::class, 'view'])->middleware('role_or_permission:Super Admin|Create Sub Agent')->name('view');
        Route::delete('/destroy', [SubAgentController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Create Sub Agent')->name('destroy');
        Route::get('/list', [SubAgentController::class, 'index'])->middleware('role_or_permission:Super Admin|Create Sub Agent')->name('list');
    });







# Budget
  Route::prefix('budget')->name('budget.')->group(function () {
    #ComponentBudget
    Route::prefix('component')->name('component.')->group(function () {
      Route::get('/create', [ComponentBudgetController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Component Budget')->name('create');
      Route::post('/store', [ComponentBudgetController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Component Budget|Manage Component Budget')->name('store');
      Route::get('/manage/{id}', [ComponentBudgetController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Component Budget')->name('manage');
      Route::get('/{id}/view', [ComponentBudgetController::class, 'view'])->middleware('role_or_permission:Super Admin|View Component Budget')->name('view');
      Route::delete('/destroy', [ComponentBudgetController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Component Budget')->name('destroy');
      Route::get('/list', [ComponentBudgetController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Component Budget')->name('list');
    });
    #ComponentInstituteBudget
    Route::prefix('component-institute')->name('component.institute.')->group(function () {
      Route::get('/create', [ComponentInstituteBudgetController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Component Institute Budget')->name('create');
      Route::post('/store', [ComponentInstituteBudgetController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Component Institute Budget|Manage Component Institute Budget')->name('store');
      Route::get('/manage/{id}', [ComponentInstituteBudgetController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Component Institute Budget')->name('manage');
      Route::get('/{id}/view', [ComponentInstituteBudgetController::class, 'view'])->middleware('role_or_permission:Super Admin|View Component Institute Budget')->name('view');
      Route::delete('/destroy', [ComponentInstituteBudgetController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Component Institute Budget')->name('destroy');
      Route::get('/list', [ComponentInstituteBudgetController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Component Institute Budget')->name('list');
    });
    #subComponentInstitute
    Route::prefix('sub-component-institute')->name('sub.component.institute.')->group(function () {
      Route::get('/create', [SubComponentInstituteBudgetController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Sub Component Institute Budget')->name('create');
      Route::post('/store', [SubComponentInstituteBudgetController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Sub Component Institute Budget|Manage Sub Component Institute Budget')->name('store');
      Route::get('/manage/{id}', [SubComponentInstituteBudgetController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Sub Component Institute Budget')->name('manage');
      Route::get('/{id}/view', [SubComponentInstituteBudgetController::class, 'view'])->middleware('role_or_permission:Super Admin|View Sub Component Institute Budget')->name('view');
      Route::delete('/destroy', [SubComponentInstituteBudgetController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Sub Component Institute Budget')->name('destroy');
      Route::get('/list', [SubComponentInstituteBudgetController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Sub Component Institute Budget')->name('list');
    });
  });

  #Institute
  Route::prefix('institute')->name('institute.')->group(function () {
    Route::get('/create', [InstituteController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Institute')->name('create');
    Route::post('/store', [InstituteController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Institute|Manage Institute')->name('store');
    Route::get('/manage/{id}', [InstituteController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Institute')->name('manage');
    Route::get('/{id}/view', [InstituteController::class, 'view'])->middleware('role_or_permission:Super Admin|View Institute')->name('view');
    Route::delete('/destroy', [InstituteController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Institute')->name('destroy');
    Route::get('/list', [InstituteController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Institute')->name('list');

    Route::prefix('building')->name('building.')->group(function () {
      Route::get('/create', [InstituteBuildingController::class, 'create'])->middleware('role_or_permission:Institute Head|Create Inventory Fixed Asset')->name('create');
      Route::post('/store', [InstituteBuildingController::class, 'store'])->middleware('role_or_permission:Institute Head|Create Inventory Fixed Asset')->name('store');
      Route::get('/manage/{id}', [InstituteBuildingController::class, 'manage'])->middleware('role_or_permission:Institute Head|Manage Inventory Fixed Asset')->name('manage');
      Route::delete('/destroy', [InstituteBuildingController::class, 'destroy'])->middleware('role_or_permission:Institute Head|Delete Inventory Fixed Asset')->name('destroy');
      Route::get('/list', [InstituteBuildingController::class, 'index'])->middleware('role_or_permission:Institute Head|List of Inventory Fixed Asset')->name('list');
      Route::post('/import', [InstituteBuildingController::class, 'import'])->middleware('role_or_permission:Institute Head|Create Inventory Fixed Asset|Manage Inventory Fixed Asset|List of Inventory Fixed Asset')->name('import');

      Route::get('/{id}/item/list', [InstituteBuildingController::class, 'indexOfItem'])->name('item.list');
      Route::match(['get', 'post'], '/item/{id}/manage', [InstituteBuildingController::class, 'itemManage'])->name('item.manage');
      Route::delete('/item/delete', [InstituteBuildingController::class, 'itemDestroy'])->name('item.Destroy');
    });
  });





#Job Event
  Route::prefix('event')->name('event.')->group(function () {
    Route::prefix('/stall')->name('stall.')->group(function () {
      Route::get('/create', function () { return view('admin.event.stall.create'); })->name('create');
      Route::get('/list', function () { return view('admin.event.stall.list'); })->name('list');
    });
    Route::prefix('/industry')->name('industry.')->group(function () {
      Route::get('/create', function () { return view('admin.event.job.create'); })->name('create');
      // Route::get('/list', function () { return view('admin.event.job.industry'); })->name('list');
      // Route::get('/list', [IndustryPostController::class,'fairAttendedIndustriesList'] )->name('list');
    });
  });


#District
  Route::prefix('district')->name('district.')->group(function () {
    Route::get('/create', [DistrictController::class, 'create'])->middleware('role_or_permission:Super Admin|Sub Agent|Create District')->name('create');
    Route::post('/store', [DistrictController::class, 'store'])->middleware('role_or_permission:Super Admin|Sub Agent|Create District|Manage District')->name('store');
    Route::get('/manage/{id}', [DistrictController::class, 'manage'])->middleware('role_or_permission:Super Admin|Sub Agent|Manage District')->name('manage');
    Route::get('/{id}/view', [DistrictController::class, 'view'])->middleware('role_or_permission:Super Admin|Sub Agent|View District')->name('view');
    Route::delete('/destroy', [DistrictController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Sub Agent|Delete District')->name('destroy');
    Route::get('/list', [DistrictController::class, 'index'])->middleware('role_or_permission:Super Admin|Sub Agent|List Of District')->name('list');
  });


#Division
  Route::prefix('upazila')->name('upazila.')->group(function () {
    Route::get('/create', [UpazilaController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Upazila')->name('create');
    Route::post('/store', [UpazilaController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Upazila|Manage Upazila')->name('store');
    Route::get('/manage/{id}', [UpazilaController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Upazila')->name('manage');
    Route::get('/{id}/view', [UpazilaController::class, 'view'])->middleware('role_or_permission:Super Admin|View Upazila')->name('view');
    Route::delete('/destroy', [UpazilaController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Upazila')->name('destroy');
    Route::get('/list', [UpazilaController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Upazila')->name('list');
  });


#Users
  Route::prefix('user')->name('user.')->group(function () {
    Route::get('/create', [UserController::class, 'create'])->middleware('role_or_permission:Super Admin|Agent|Create User')->name('create');
    Route::post('/store', [UserController::class, 'store'])->middleware('role_or_permission:Super Admin|Agent|Create User|Manage User')->name('store');
    Route::get('/manage/{id}', [UserController::class, 'manage'])->middleware('role_or_permission:Super Admin|Agent|Manage User')->name('manage');
    Route::get('/{id}/view', [UserController::class, 'view'])->middleware('role_or_permission:Super Admin|Agent|View User')->name('view');
    Route::delete('/destroy', [UserController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Agent|Delete User')->name('destroy');
    Route::get('/list', [UserController::class, 'index'])->middleware('role_or_permission:Super Admin|Agent|List Of User')->name('list');

  });



  #Roles
  Route::prefix('role')->name('role.')->group(function () {
    Route::get('/create', [RoleController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Role')->name('create');
    Route::post('/store', [RoleController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Role|Manage Role')->name('store');
    Route::get('/manage/{id}', [RoleController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Role')->name('manage');
    Route::get('/{id}/view', [RoleController::class, 'view'])->middleware('role_or_permission:Super Admin|View Role')->name('view');
    Route::delete('/destroy', [RoleController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Role')->name('destroy');
    Route::get('/list', [RoleController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Role')->name('list');
  });

  #Permission
  Route::match(['get', 'post'], '/permission/manage', [PermissionController::class, 'managePermission'])->middleware('role_or_permission:Super Admin|Manage Permission')->name('permission.manage');

//  Route::get('trainee/certificate/create', [CertificateController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Certificate')->name('trainee.certificate.create');

  #Voucher Type
  Route::prefix('voucher-type')->name('voucher.type.')->group(function () {
    Route::get('/create', [VoucherTypeController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Voucher Type')->name('create');
    Route::post('/store', [VoucherTypeController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Voucher Type|Manage Voucher Type')->name('store');
    Route::get('/manage/{id}', [VoucherTypeController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Voucher Type')->name('manage');
    Route::get('/{id}/view', [VoucherTypeController::class, 'view'])->middleware('role_or_permission:Super Admin|View Voucher Type')->name('view');
    Route::delete('/destroy', [VoucherTypeController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Voucher Type')->name('destroy');
    Route::get('/list', [VoucherTypeController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Voucher Type')->name('list');
  });

  #Voucher
  Route::prefix('voucher')->name('voucher.')->group(function () {
    Route::match(['get', 'post'], '/create', [VoucherController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Voucher')->name('create');
    Route::post('/store', [VoucherController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Voucher|Manage Voucher')->name('store');
    Route::match(['get', 'post'], '/manage/{id}', [VoucherController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Voucher')->name('manage');
    Route::get('/{id}/view', [VoucherController::class, 'view'])->middleware('role_or_permission:Super Admin|View Voucher')->name('view');
    Route::delete('/destroy', [VoucherController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Voucher')->name('destroy');
    Route::get('/list', [VoucherController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Voucher')->name('list');
  });

  Route::prefix('all-voucher')->name('all.voucher.')->group(function () {
    Route::get('/list', [AdminVoucherController::class, 'index'])->middleware('role_or_permission:Super Admin')->name('list');
    Route::get('/{id}/view', [AdminVoucherController::class, 'view'])->middleware('role_or_permission:Super Admin')->name('view');
  });



  #Background Image
  Route::match(['get', 'post'], '/background-image', [BackgroundImageController::class, 'createOrIndex'])->name('backgroundImage');
  Route::delete('/background-image/destroy', [BackgroundImageController::class, 'destroy'])->name('backgroundImage.destroy');

  #Job Event
  Route::prefix('job')->name('job.')->group(function () {
    Route::prefix('/application')->name('application')->group(function () {
      Route::get('/list', function () {
        return view('admin.Job.application.list');
      })->name('list');
    });
  });



  Route::prefix('organizer')->name('organizer.')->group(function () {
    Route::prefix('/guest')->name('guest.')->group(function () {
      Route::get('/list', function () {
        return view('admin.organizer.guest');
      })->name('list');

    });
  });
});


Route::get('/institute-trainings', [SiteController::class, 'indexTrainingList'])->name('institute.trainings');
Route::get('/institute-wise-trainings/{id}', [SiteController::class, 'instituteTrainingList'])->name('institute.wise.trainings');

Route::prefix('/institute-trainings')->name('institute.trainings.')->group(function () {
  Route::get('/{training_id}/details', [SiteController::class, 'trainingDetails'])->name('details');
  Route::get('/{training_id}/register/store', [SiteController::class, 'storeTrainingMember'])->middleware('auth')->name('store');
  Route::get('/enroll/training/list', [SiteController::class, 'enrollTrainingList'])->name('enrollTrainingList');
  Route::get('/enroll/training/cancel/{training_memebere_id}', [SiteController::class, 'cancelTrainingRequest'])->name('cancel.training');
});
Route::get('/institute/training-list', [SiteController::class, 'indexTrainingList'])->name('ajax.institute.training-list');



// event balde
Route::get('/event', function () {
  return view('site.event.event');
})->name('event');
// event balde
Route::get('/event/gallery', function () {
  return view('site.event.gallery');
})->name('event.gallery');

// Event Participant List
Route::get('/admin/event-participant/list', function () {
  return view('admin.eventParticipant.list');
})->name('event.participant.list');

//Contacts
Route::get('/admin/contacts/list', function () {
  return view('admin.contacts.list');
})->name('contacts.list');

// Procurement Management Module
Route::prefix('/procurement')->name('porcurement.')->group(function(){
  // APP - Total Procurement Plan
  Route::prefix('/app')->name('app.')->group(function(){
    Route::get('/form',function(){
      return view('admin.procurement.app.form');
    })->name('form');
    Route::get('/goods',function(){
      return view('admin.procurement.app.goods_report');
    })->name('goods.report');
    Route::get('/works',function(){
      return view('admin.procurement.app.works_report');
    })->name('works.report');
    Route::get('/services',function(){
      return view('admin.procurement.app.services_report');
    })->name('services.report');
  });
  // TPP - Total Procurement Plan
  Route::prefix('/tpp')->name('tpp.')->group(function(){
    Route::get('/form',function(){
      return view('admin.procurement.tpp.form');
    })->name('form');
    Route::get('/goods',function(){
      return view('admin.procurement.tpp.goods_report');
    })->name('goods.report');
    Route::get('/works',function(){
      return view('admin.procurement.tpp.works_report');
    })->name('works.report');
    Route::get('/services',function(){
      return view('admin.procurement.tpp.services_report');
    })->name('services.report');
  });
});
