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


Route::get('/test', function () {
//  return \App\Models\User::with('permissions', 'roles')->find(auth()->id());
  ini_set('max_execution_time', 300);
  \Illuminate\Support\Facades\Mail::to('info@rast.com')->cc('admin@rast.com')->send(new \App\Mail\EligibilityApplicationFormIdgMail(\route('form.pdf', 1)));
  return view('email.test');
})->name('test');


Route::get('send-mail', [ContactController::class, 'sendDemoMail'])->name('sendDemoMail');
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

Route::get('/email/verify', function () {
  $data['images'] = BackgroundImage::where('status', BackgroundImage::$statusArray[0])->get();
  return view('admin.auth.verify-email', $data);
})->middleware('auth')->name('verification.notice');
Route::get('/forgot-password', function () {
  $data['images'] = BackgroundImage::where('status', BackgroundImage::$statusArray[0])->get();
  return view('admin.auth.forget-password', $data);
})->middleware('guest')->name('password.request');

Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();
  \Illuminate\Support\Facades\Session::put('email', $request->user()->email);
  return redirect()->back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::post('/post/apply', [SiteController::class, 'postApply'])->name('ajax.post.apply');
Route::get('/admin/logout', [AdminController::class, 'logout'])->middleware('auth')->name('admin.logout');
Route::prefix('/admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
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
    Route::get('/get-item-prefix', [InstituteBuildingController::class, 'ajaxGetItemPrefix'])->name('get.item.prefix');
//    Route::get('/get-student-prefix', [ProjectIdeaController::class, 'ajaxprojectIdeaStudent'])->name('get.student.prefix');
    Route::post('/make/{id}/-as-read', [NotificationController::class, 'ajaxUpdateAsRead'])->name('make.modal.as.read');
    Route::post('/permission-by-role', [PermissionController::class, 'getPermissionByRole'])->middleware('role_or_permission:Super Admin|Manage Permission')->name('get.permission.by.role');
    Route::post('/update/user/status', [UserController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Super Admin|Manage User|Manage Institute User')->name('update.user.status');
    Route::post('/update/institute/status', [InstituteController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Super Admin|Manage Institute')->name('update.institute.status');
    Route::post('/update/fiscal-year/status', [FiscalYearController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Super Admin|Manage Fiscal Year')->name('update.fiscal.year.status');
    Route::post('/update/registration/status', [InstituteHeadController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Super Admin|Manage Institute User')->name('update.registration.status');
    Route::get('/user/details', [InstituteHeadController::class, 'ajaxUserDetails'])->middleware('role_or_permission:Super Admin|Create Institute User')->name('user.details');
    Route::get('/training/member/create', [TrainingMemberController::class, 'ajaxUserChange'])->middleware('role_or_permission:Super Admin|Manage Institute')->name('training.member.create');
    Route::get('/institute/create', [InstituteController::class, 'ajaxUsersChange'])->middleware('role_or_permission:Super Admin|Manage Institute')->name('institute.create');
    Route::post('/update/training/status', [TrainingApprovalController::class, 'ajaxUpdateStatus'])->name('update.training.status');
    Route::post('/update/projectIdea/hod_approval', [ProjectIdeaController::class, 'hod_approval'])->name('update.projectIdea.hod_approval');
    Route::post('/update/projectIdea/vp_approval', [ProjectIdeaController::class, 'vp_approval'])->name('update.projectIdea.vp_approval');
    Route::post('/update/projectIdea/p_approval', [ProjectIdeaController::class, 'p_approval'])->name('update.projectIdea.p_approval');
    Route::post('/update/projectIdea/pmu_approval', [ProjectIdeaController::class, 'pmu_approval'])->name('update.projectIdea.pmu_approval');
    Route::post('/update/projectIdea/status', [ProjectIdeaController::class, 'ajaxUpdateStatus'])->name('update.projectIdea.status');
    Route::post('/update/projectIdea/foreword', [ProjectIdeaController::class, 'ajaxUpdateForeword'])->name('update.projectIdea.foreword');
    Route::post('/update/coremodule/status', [CoreModuleController::class, 'ajaxUpdateStatus'])->name('update.coremodule.status');
    Route::post('/update/backgrouond/status', [BackgroundImageController::class, 'ajaxUpdateStatus'])->name('update.backgroundImage.status');
    Route::post('/update/technology/status', [TechnologyController::class, 'ajaxUpdateStatus'])->name('update.technology.status');
    Route::post('/update/shift/status', [ShiftController::class, 'ajaxUpdateStatus'])->name('update.shift.status');
    Route::post('/update/semester/status', [SemesterController::class, 'ajaxUpdateStatus'])->name('update.semester.status');
    Route::post('/update/job/event/status', [JobEventController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Institute Head|Manage Job Event User')->name('update.event.job.status');
    Route::post('/update/job/event/post/status', [JobEventController::class, 'ajaxPostUpdateStatus'])->middleware('role_or_permission:Institute Head|Manage Job Event User')->name('update.event.job.post.status');
    Route::post('/update/job/post/status', [IndustryPostController::class, 'ajaxUpdateStatus'])->middleware('role_or_permission:Industry|Institute Head|Manage Industry|Manage Industry')->name('update.job.post.status');
    Route::post('/update/job/applicant/status', [EmployerController::class, 'ajaxUpdatejobApplicantStatus'])->middleware('role_or_permission:Industry|Manage Industry|Manage Industry')->name('update.job.applicant.status');
    Route::post('/update/send-mail/status', [EmployerController::class, 'ajaxSendMail'])->middleware('role_or_permission:Industry|Manage Industry|Manage Industry')->name('send-mail');

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

#Component
  Route::prefix('component')->name('component.')->group(function () {
    Route::get('/create', [ComponentController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Component')->name('create');
    Route::post('/store', [ComponentController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Component|Manage Component')->name('store');
    Route::get('/manage/{id}', [ComponentController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Component')->name('manage');
    Route::get('/{id}/view', [ComponentController::class, 'view'])->middleware('role_or_permission:Super Admin|View Component')->name('view');
    Route::delete('/destroy', [ComponentController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Component')->name('destroy');
    Route::get('/list', [ComponentController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Component')->name('list');
  });

  #SubComponent
  Route::prefix('sub-component')->name('subComponent.')->group(function () {
    Route::get('/create', [SubComponentController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Sub Component')->name('create');
    Route::post('/store', [SubComponentController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Sub Component|Manage Sub Component')->name('store');
    Route::get('/manage/{id}', [SubComponentController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Sub Component')->name('manage');
    Route::get('/{id}/view', [SubComponentController::class, 'view'])->middleware('role_or_permission:Super Admin|View Sub Component')->name('view');
    Route::delete('/destroy', [SubComponentController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Sub Component')->name('destroy');
    Route::get('/list', [SubComponentController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Sub Component')->name('list');
  });

  #SubsidiaryComponent
  Route::prefix('subsidiary-component')->name('subsidiaryComponent.')->group(function () {
    Route::get('/create', [SubsidiaryComponentController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Subsidiary Component')->name('create');
    Route::post('/store', [SubsidiaryComponentController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Subsidiary Component|Manage Subsidiary Component')->name('store');
    Route::get('/manage/{id}', [SubsidiaryComponentController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Subsidiary Component')->name('manage');
    Route::get('/{id}/view', [SubsidiaryComponentController::class, 'view'])->middleware('role_or_permission:Super Admin|View Subsidiary Component')->name('view');
    Route::delete('/destroy', [SubsidiaryComponentController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Subsidiary Component')->name('destroy');
    Route::get('/list', [SubsidiaryComponentController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Subsidiary Component')->name('list');
  });

  #FiscalYear
  Route::prefix('fiscal-year')->name('fiscal.year.')->group(function () {
    Route::get('/create', [FiscalYearController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Fiscal Year')->name('create');
    Route::post('/store', [FiscalYearController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Fiscal Year|Manage Fiscal Year')->name('store');
    Route::get('/manage/{id}', [FiscalYearController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Fiscal Year')->name('manage');
    Route::get('/{id}/view', [FiscalYearController::class, 'view'])->middleware('role_or_permission:Super Admin|View Fiscal Year')->name('view');
    Route::delete('/destroy', [FiscalYearController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Fiscal Year')->name('destroy');
    Route::get('/list', [FiscalYearController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Fiscal Year')->name('list');
  });


  #FiscalPeriod
  Route::prefix('fiscal-period')->name('fiscalPeriod.')->group(function () {
    Route::get('/create', [FiscalPeriodController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Fiscal Period')->name('create');
    Route::post('/store', [FiscalPeriodController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Fiscal Period|Manage Fiscal Period')->name('store');
    Route::get('/manage/{id}', [FiscalPeriodController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Fiscal Period')->name('manage');
    Route::get('/{id}/view', [FiscalPeriodController::class, 'view'])->middleware('role_or_permission:Super Admin|View Fiscal Period')->name('view');
    Route::delete('/destroy', [FiscalPeriodController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Fiscal Period')->name('destroy');
    Route::get('/list', [FiscalPeriodController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Fiscal Period')->name('list');
  });

  #FiscalBudget
  Route::prefix('fiscal-budget')->name('fiscal.budget.')->group(function () {
    Route::get('/create', [FiscalBudgetController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Fiscal Budget')->name('create');
    Route::post('/store', [FiscalBudgetController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Fiscal Budget|Manage Fiscal Budget')->name('store');
    Route::get('/manage/{id}', [FiscalBudgetController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Fiscal Budget')->name('manage');
    Route::get('/{id}/view', [FiscalBudgetController::class, 'view'])->middleware('role_or_permission:Super Admin|View Fiscal Budget')->name('view');
    Route::delete('/destroy', [FiscalBudgetController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Fiscal Budget')->name('destroy');
    Route::get('/list', [FiscalBudgetController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Fiscal Budget')->name('list');

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

  #InstituteType
  Route::prefix('institute-type')->name('institute.type.')->group(function () {
    Route::get('/create', [InstituteTypeController::class, 'create'])->middleware('role_or_permission:Super Admin')->name('create');
    Route::any('/store', [InstituteTypeController::class, 'store'])->middleware('role_or_permission:Super Admin')->name('store');
    Route::delete('/destroy', [InstituteTypeController::class, 'destroy'])->middleware('role_or_permission:Super Admin')->name('destroy');
  });

  Route::get('/my-trainings', [TrainingController::class, 'myTrainings'])->name('my.trainings');
  Route::get('/withdraw/{id}/my-training', [TrainingController::class, 'myTrainingWithdraw'])->name('my.training.withdraw');
//    Route::get('/training/{trainingId}/file/{id}/delete', [TrainingController::class, 'trainingFileDelete'])->name('training.delete');

#Training
  Route::prefix('training')->name('training.')->group(function () {
    Route::get('/create', [TrainingController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Training')->name('create');
    Route::post('/store', [TrainingController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Training|Manage Training')->name('store');
    Route::get('/manage/{id}', [TrainingController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Training')->name('manage');
    Route::get('/make/completed/{id}', [TrainingController::class, 'makeCompleted'])->middleware('role_or_permission:Super Admin|Manage Training')->name('make.completed');
    Route::get('/{id}/view', [TrainingController::class, 'view'])->middleware('role_or_permission:Super Admin|View Training')->name('view');
    Route::delete('/destroy', [TrainingController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Training')->name('destroy');
    Route::get('/list', [TrainingController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Training')->name('list');


    Route::prefix('/apply')->name('apply.')->middleware('role_or_permission:Institute Head')->group(function () {
      Route::get('/list', [TrainingApprovalController::class, 'applyListOfInstituteHead'])->name('list');
      Route::get('/{id}/details', [TrainingApprovalController::class, 'applyDetailsOfInstituteHead'])->name('details');
      Route::post('/approval/members/update', [TrainingApprovalController::class, 'approvalMemberListUpdateInstituteHead'])->name('member.list.update');
      Route::get('/approval/{id}/{status}', [TrainingApprovalController::class, 'approvalMemberUpdateInstituteHead'])->name('member.update');
    });


    Route::prefix('/approval')->name('approval.')->middleware('role_or_permission:Super Admin|Batch Creator|Batch Approver')->group(function () {
      Route::get('/list', [TrainingApprovalController::class, 'approval'])->name('list');
      Route::get('/{id}/member-list', [TrainingApprovalController::class, 'approvalMemberList'])->name('member.list');
      Route::post('/members/update', [TrainingApprovalController::class, 'approvalMemberListUpdate'])->name('member.list.update');
      Route::post('/{id}/members/add', [TrainingApprovalController::class, 'addMemeberToTraining'])->middleware('role_or_permission:Super Admin|Batch Approver')->name('member.add');
      Route::get('/{id}/{status}', [TrainingApprovalController::class, 'approvalMemberUpdate'])->name('member.update');
      Route::post('/replace', [TrainingApprovalController::class, 'replace'])->name('replace');
    });

    #TrainingMember
    Route::prefix('/{training_id}/member')->name('member.')->group(function () {
      Route::get('/create', [TrainingMemberController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Training Member')->name('create');
      Route::post('/store', [TrainingMemberController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Training Member|Manage Training Member')->name('store');
      Route::get('/manage/{id}', [TrainingMemberController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Training Member')->name('manage');
      Route::get('/{id}/view', [TrainingMemberController::class, 'view'])->middleware('role_or_permission:Super Admin|View Training Member')->name('view');
      Route::delete('/destroy', [TrainingMemberController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Training Member')->name('destroy');
      Route::get('/list', [TrainingMemberController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Training Member')->name('list');
      Route::post('/import', [TrainingMemberController::class, 'importMember'])->middleware('role_or_permission:Super Admin|List Of Training Member')->name('import');
    });


  });


#Job Event
  Route::prefix('event')->name('event.')->group(function () {
    Route::prefix('/job')->name('job.')->group(function () {
//      Route::get('/manage', function () { return view('admin.event.job.manage'); })->name('manage');
//      Route::get('/applied-fair-list', function () { return view('admin.Job.applied_fair_list'); })->name('applied_fair_list');
      Route::get('/applied-fair-list', [IndustryPostController::class, 'fairList'])->middleware('role_or_permission:Industry|List Of Industry Post')->name('applied_fair_list');
      Route::get('/create', [JobEventController::class, 'create'])->middleware('role_or_permission:Institute Head|Create Job Event')->name('create');
      Route::post('/store', [JobEventController::class, 'store'])->middleware('role_or_permission:Institute Head|Create Job Event|Manage Job Event')->name('store');
      Route::get('/manage/{id}', [JobEventController::class, 'manage'])->middleware('role_or_permission:Institute Head|Industry|Manage Job Event')->name('manage');
      Route::delete('/destroy', [JobEventController::class, 'destroy'])->middleware('role_or_permission:Institute Head|Delete Job Event')->name('destroy');
      Route::get('/list', [JobEventController::class, 'index'])->middleware('role_or_permission:Institute Head|List Of Job Event')->name('list');
      Route::get('/{id}/participant/industry/', [IndustryPostController::class, 'fairAttendedIndustriesList'])->middleware('role_or_permission:Institute Head|List Of Job Event')->name('participant.industry.list');
    });
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

//  #Job Event
//  Route::prefix('fair')->name('fair.')->group(function () {
//    Route::prefix('/organizer')->name('organizer.')->group(function () {
//      Route::get('/create', function () { return view('admin.event.job.create'); })->name('create');
//      Route::get('/list', function () { return view('admin.event.job.list'); })->name('list');
//    });
//    Route::prefix('/industry')->name('industry.')->group(function () {
//      Route::get('/create', function () { return view('admin.event.stall.create'); })->name('create');
//      Route::get('/list', function () { return view('admin.event.stall.list'); })->name('list');
//    });
//    Route::prefix('/student')->name('st.')->group(function () {
//      Route::get('/create', function () { return view('admin.event.stall.create'); })->name('create');
//      Route::get('/list', function () { return view('admin.event.stall.list'); })->name('list');
//    });
//  });

#District
  Route::prefix('district')->name('district.')->group(function () {
    Route::get('/create', [DistrictController::class, 'create'])->middleware('role_or_permission:Super Admin|Create District')->name('create');
    Route::post('/store', [DistrictController::class, 'store'])->middleware('role_or_permission:Super Admin|Create District|Manage District')->name('store');
    Route::get('/manage/{id}', [DistrictController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage District')->name('manage');
    Route::get('/{id}/view', [DistrictController::class, 'view'])->middleware('role_or_permission:Super Admin|View District')->name('view');
    Route::delete('/destroy', [DistrictController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete District')->name('destroy');
    Route::get('/list', [DistrictController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of District')->name('list');
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
    Route::get('/create', [UserController::class, 'create'])->middleware('role_or_permission:Super Admin|Create User')->name('create');
    Route::post('/store', [UserController::class, 'store'])->middleware('role_or_permission:Super Admin|Create User|Manage User')->name('store');
    Route::get('/manage/{id}', [UserController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage User')->name('manage');
    Route::get('/{id}/view', [UserController::class, 'view'])->middleware('role_or_permission:Super Admin|View User')->name('view');
    Route::delete('/destroy', [UserController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete User')->name('destroy');
    Route::get('/list', [UserController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of User')->name('list');

    #Education
    Route::post('education/store', [TraineeController::class, 'employeeStore'])->middleware('role_or_permission:Super Admin|update_education')->name('education.store');
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

  Route::prefix('trainee')->name('trainee.')->group(function () {
    Route::get('/view', [TraineeController::class, 'view'])->middleware('role_or_permission:Super Admin|update_trainee')->name('view');
    Route::post('/update', [TraineeController::class, 'update'])->middleware('role_or_permission:Super Admin|update_trainee')->name('update');
  });
  #Education
  Route::prefix('education')->name('education.')->group(function () {
    Route::get('/create', [EducationController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Education')->name('create');
    Route::post('/store', [EducationController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Education|Manage Education')->name('store');
    Route::get('/manage/{id}', [EducationController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Education')->name('manage');
    Route::delete('/destroy', [EducationController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Education')->name('destroy');
    Route::get('/list', [EducationController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Education')->name('list');
  });

  #Certificate
  Route::prefix('certificate')->name('certificate.')->group(function () {
    Route::get('/create', [CertificateController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Certificate')->name('create');
    Route::post('/store', [CertificateController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Certificate|Manage Certificate')->name('store');
    Route::get('/manage/{id}', [CertificateController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Certificate')->name('manage');
    Route::delete('/destroy', [CertificateController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Certificate')->name('destroy');
    Route::get('/list', [CertificateController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Certificate')->name('list');
  });

  #Job Experience
  Route::prefix('job/experience')->name('job.experience.')->group(function () {
    Route::get('/create', [JobExperiencController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Job Experience')->name('create');
    Route::post('/store', [JobExperiencController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Job Experience|Manage Job Experience')->name('store');
    Route::get('/manage/{id}', [JobExperiencController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Job Experience')->name('manage');
    Route::delete('/destroy', [JobExperiencController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Job Experience')->name('destroy');
    Route::get('/list', [JobExperiencController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Job Experience')->name('list');
  });

  #Institute Head
  Route::prefix('institute/member/')->name('institute.head.')->group(function () {
    Route::get('/pending', [InstituteHeadController::class, 'registration'])->middleware('role_or_permission:Super Admin|Manage Institute User')->name('registration');
    Route::get('/approved', [InstituteHeadController::class, 'approved'])->middleware('role_or_permission:Super Admin|Manage Institute User')->name('approved');
    Route::get('/rejected', [InstituteHeadController::class, 'rejected'])->middleware('role_or_permission:Super Admin|Manage Institute User')->name('rejected');
    Route::get('/create', [InstituteHeadController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User')->name('create');
    Route::get('/manage/{id}', [InstituteHeadController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Institute User|Manage Institute User')->name('manage');
    Route::delete('/destroy', [InstituteHeadController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Institute User|Manage Institute User')->name('destroy');
    Route::get('/list', [InstituteHeadController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Institute User|Manage Institute User')->name('list');

    Route::prefix('student')->name('student.')->group(function () {
      Route::get('/create', [InstituteHeadController::class, 'createStudent'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User')->name('create');
      Route::post('/store', [InstituteHeadController::class, 'storeStudent'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User|Manage Institute User')->name('store');
      Route::get('/manage/{id}', [InstituteHeadController::class, 'manageStudent'])->middleware('role_or_permission:Super Admin|Manage Institute User|Manage Institute User')->name('manage');
      Route::get('/list', [InstituteHeadController::class, 'students'])->middleware('role_or_permission:Super Admin|Industry|List Of Institute User|Manage Institute User')->name('list');
      Route::get('/graduate-profile/{id}', [InstituteHeadController::class, 'profile'])->middleware('role_or_permission:Super Admin|Industry|List Of Institute User|Manage Institute User')->name('profile');
    });
    Route::prefix('employee')->name('employee.')->group(function () {
      Route::get('/create', [InstituteHeadController::class, 'createEmployee'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User')->name('create');
      Route::post('/store', [InstituteHeadController::class, 'storeEmployee'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User|Manage Institute User')->name('store');
      Route::get('/manage/{id}', [InstituteHeadController::class, 'manageEmployee'])->middleware('role_or_permission:Super Admin|Manage Institute User|Manage Institute User')->name('manage');
      Route::get('/list', [InstituteHeadController::class, 'employeeList'])->middleware('role_or_permission:Super Admin|List Of Institute User|Manage Institute User')->name('list');
    });

    Route::prefix('teacher')->name('teacher.')->group(function () {
      Route::get('/create', [InstituteHeadController::class, 'createTeacher'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User')->name('create');
      Route::post('/create', [InstituteHeadController::class, 'storeTeacher'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User')->name('create');
      Route::get('/list', [InstituteHeadController::class, 'teachers'])->middleware('role_or_permission:Super Admin|List Of Institute User|Manage Institute User')->name('list');
    });

    Route::prefix('staff')->name('staff.')->group(function () {
      Route::get('/create', [InstituteHeadController::class, 'createStaff'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User')->name('create');
      Route::post('/create', [InstituteHeadController::class, 'storeStaff'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User')->name('create');
      Route::get('/list', [InstituteHeadController::class, 'staffs'])->middleware('role_or_permission:Super Admin|List Of Institute User|Manage Institute User')->name('list');
    });

    Route::prefix('officer')->name('officer.')->group(function () {
      Route::get('/create', [InstituteHeadController::class, 'createOfficer'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User')->name('create');
      Route::post('/create', [InstituteHeadController::class, 'storeOfficer'])->middleware('role_or_permission:Super Admin|Create Institute User|Manage Institute User')->name('create');
      Route::get('/list', [InstituteHeadController::class, 'officers'])->middleware('role_or_permission:Super Admin|List Of Institute User|Manage Institute User')->name('list');
    });
  });

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

  #Report
  Route::prefix('report')->name('report.')->group(function () {
    Route::get('/subsidiary-component-code-wise', [ReportController::class, 'subsidiaryComponentCodeWiseReport'])->middleware('role_or_permission:Super Admin|Subsidiary Component code wise')->name('subsidiary.component.code.wise');
    Route::get('/subsidiary-component-quater-wise', [ReportController::class, 'subsidiaryComponentQuarterWiseReport'])->middleware('role_or_permission:Super Admin|Subsidiary Component quarter wise')->name('subsidiary.component.quarter.wise');
  });

#Training Type
  Route::prefix('trainingType')->name('trainingType.')->group(function () {
    Route::get('/create', [TrainingTypeController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Training Type')->name('create');
    Route::post('/store', [TrainingTypeController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Training Type|Manage Training Type')->name('store');
    Route::delete('/destroy', [TrainingTypeController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Training Type')->name('destroy');
    // Route::get('/manage/{id}', [TrainingTypeController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Training Type')->name('manage');
    // Route::get('/{id}/view', [TrainingTypeController::class, 'view'])->middleware('role_or_permission:Super Admin|View Training Type')->name('view');

    // Route::get('/list', [TrainingTypeController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Training Type')->name('list');
  });

#Project Idea
  Route::prefix('projectIdea')->name('projectIdea.')->group(function () {
    Route::get('/create', [ProjectIdeaController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Project Idea')->name('create');
    Route::post('/store', [ProjectIdeaController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Project Idea|Manage Project Idea')->name('store');
    Route::get('/manage/{id}', [ProjectIdeaController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Project Idea')->name('manage');
    Route::get('/{id}/view', [ProjectIdeaController::class, 'view'])->middleware('role_or_permission:Super Admin|View Project Idea')->name('view');
    Route::delete('/destroy', [ProjectIdeaController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Project Idea')->name('destroy');
    Route::get('/{project_idea_id}/file/destroy/{id}', [ProjectIdeaController::class, 'fileDestroy'])->middleware('role_or_permission:Super Admin|Delete Project Idea')->name('file.delete');
    Route::get('/list', [ProjectIdeaController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Project Idea')->name('list');
    Route::get('/mentor/list', [ProjectIdeaController::class, 'indexMentor'])->middleware('role_or_permission:Super Admin|List Of Project Idea')->name('list.mentor');
    Route::get('/hod/list', [ProjectIdeaController::class, 'indexHod'])->middleware('role_or_permission:Super Admin|List Of Project Idea')->name('list.hod');
    Route::get('/head/list', [ProjectIdeaController::class, 'indexHead'])->middleware('role_or_permission:Super Admin|List Of Project Idea')->name('list.head');
  });

#Project Idea
//  Route::prefix('projectIdea')->name('projectIdea.')->group(function () {
//    Route::get('/create', [ProjectIdeaController::class, 'create'])->name('create');
//    Route::post('/store', [ProjectIdeaController::class, 'store'])->name('store');
//    Route::get('/manage/{id}', [ProjectIdeaController::class, 'manage'])->name('manage');
//    Route::get('/{id}/view', [ProjectIdeaController::class, 'view'])->name('view');
//    Route::delete('/destroy', [ProjectIdeaController::class, 'destroy'])->name('destroy');
//    Route::get('/{project_idea_id}/file/destroy/{id}', [ProjectIdeaController::class, 'fileDestroy'])->name('file.delete');
//    Route::get('/list', [ProjectIdeaController::class, 'index'])->name('list');
//  });


  #Core Modules
  Route::prefix('coremodule')->name('coremodule.')->group(function () {
    Route::get('/create', [CoreModuleController::class, 'create'])->name('create');
    Route::post('/store', [CoreModuleController::class, 'store'])->name('store');
    Route::get('/manage/{id}', [CoreModuleController::class, 'manage'])->name('manage');
    Route::get('/{id}/view', [CoreModuleController::class, 'view'])->name('view');
    Route::delete('/destroy', [CoreModuleController::class, 'destroy'])->name('destroy');
    Route::get('/list', [CoreModuleController::class, 'index'])->name('list');
  });

  #Background Image
  Route::match(['get', 'post'], '/background-image', [BackgroundImageController::class, 'createOrIndex'])->name('backgroundImage');
  Route::delete('/background-image/destroy', [BackgroundImageController::class, 'destroy'])->name('backgroundImage.destroy');

  Route::get('/eligibility/forms', [IdgController::class, 'index'])->name('eligibility.forms');

  // technology
  Route::prefix('/technology')->name('technology.')->group(function () {
    Route::get('/create', [TechnologyController::class, 'create'])->middleware('role_or_permission:Institute Head|Create Technology')->name('create');
    Route::post('/store', [TechnologyController::class, 'store'])->middleware('role_or_permission:Institute Head|Create Technology|Manage Technology')->name('store');
    Route::delete('/destroy', [TechnologyController::class, 'destroy'])->middleware('role_or_permission:Institute Head|Delete Technology')->name('destroy');
  });
  // shift
  Route::prefix('/shift')->name('shift.')->group(function () {
    Route::get('/create', [ShiftController::class, 'create'])->middleware('role_or_permission:Institute Head|Create Shift')->name('create');
    Route::post('/store', [ShiftController::class, 'store'])->middleware('role_or_permission:Institute Head|Create Shift|Manage Shift')->name('store');
    Route::delete('/destroy', [ShiftController::class, 'destroy'])->middleware('role_or_permission:Institute Head|Delete Shift')->name('destroy');
  });
  // semester
  Route::prefix('/semester')->name('semester.')->group(function () {
    Route::get('/create', [SemesterController::class, 'create'])->middleware('role_or_permission:Institute Head|Create Semester')->name('create');
    Route::post('/store', [SemesterController::class, 'store'])->middleware('role_or_permission:Institute Head|Create Semester|Manage Semester')->name('store');
    Route::delete('/destroy', [SemesterController::class, 'destroy'])->middleware('role_or_permission:Institute Head|Delete Semester')->name('destroy');
  });

  #Job Event
  Route::prefix('job')->name('job.')->group(function () {
    Route::prefix('/post')->name('post.')->group(function () {
//      Route::get('/create', function () {return view('admin.job.post.create');})->name('create');
      Route::get('/create', [IndustryPostController::class, 'create'])->middleware('role_or_permission:Industry|Institute Head|Create Industry Post')->name('create');
      Route::get('/create/{id}', [IndustryPostController::class, 'createEventPost'])->middleware('role_or_permission:Industry|Institute Head|Create Industry Post')->name('create.event');
      Route::post('/store', [IndustryPostController::class, 'store'])->middleware('role_or_permission:Industry|Institute Head|Create Industry Post|Manage Industry Post')->name('store');
      Route::get('/manage/{id}', [IndustryPostController::class, 'manage'])->middleware('role_or_permission:Industry|Institute Head|Manage Industry Post')->name('manage');
      Route::delete('/destroy', [IndustryPostController::class, 'destroy'])->middleware('role_or_permission:Industry|Institute Head|Delete Industry Post')->name('destroy');
      Route::get('/list', [IndustryPostController::class, 'index'])->middleware('role_or_permission:Industry|Institute Head|List Of Industry Post')->name('list');

//      Route::get('/list', function () {return view('admin.event.stall.list');})->name('list');
    });
    Route::prefix('/application')->name('application')->group(function () {
      Route::get('/list', function () {
        return view('admin.Job.application.list');
      })->name('list');
    });
  });

  Route::prefix('graduate')->name('graduate.')->group(function () {
    Route::prefix('/job')->name('job.')->group(function () {
      Route::get('/list', [GraduateController::class, 'appliedList'])->middleware('role_or_permission:Student')->name('list');
    });
  });

  Route::prefix('employer')->name('employer.')->group(function () {
    Route::prefix('/application')->name('application.')->group(function () {
      Route::get('/list/{id}', [EmployerController::class, 'applicationList'])->middleware('role_or_permission:Industry')->name('list');
    });
  });

  Route::prefix('organizer')->name('organizer.')->group(function () {
    Route::prefix('/post')->name('post.')->group(function () {
//      Route::get('/create', function () { return view('admin.job.post.create'); })->name('create');
//      Route::get('/list', function () { return view('admin.organizer.post');})->name('list');
      Route::get('/list/{id}', [JobEventController::class, 'posts'])->middleware('role_or_permission:Institute Head|List Of Job Event')->name('list');
//      Route::get('/list', [JobEventController::class, 'posts'])->middleware('role_or_permission:Institute Head|List Of Job Event')->name('list');
    });
    Route::prefix('/guest')->name('guest.')->group(function () {
      Route::get('/list', function () {
        return view('admin.organizer.guest');
      })->name('list');

    });
    Route::prefix('/applicant')->name('applicant.')->group(function (){
      Route::get('/list', function () { return view('admin.organizer.applicant'); })->name('list');
    });
  });

  Route::get('/resume', [\App\Http\Controllers\ResumeController::class, 'registrationInfo'])->middleware('role_or_permission:Super Admin|Student')->name('resume');
  Route::post('/resume/update', [\App\Http\Controllers\ResumeController::class, 'registrationInfoUpdate'])->middleware('role_or_permission:Super Admin|Student')->name('resume.update');

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

// Eligibility Criteria for RPL Grant
Route::prefix('/eligibility-rpl')->name('eligibility.rpl.')->group(function () {

  Route::match(['get', 'post'], '/without-score', [RplController::class, 'withoutScore'])->name('without.score');
  Route::get('/without-score/{id}', [RplController::class, 'withoutScorePdf'])->name('without.score.pdf');
  Route::get('/without-score/{formId}/file/{id}/delete', [RplController::class, 'formFileDelete'])->name('without.score.file.delete');
  Route::delete('/without-score/delete/ayo', [RplController::class, 'withoutScoreDeleteAyo'])->name('without.score.delete.ayo');
  Route::delete('/without-score/delete/ooi', [RplController::class, 'withoutScoreDeleteOoi'])->name('without.score.delete.ooi');
  Route::match(['get', 'post'], '/create-store', [RplController::class, 'createOrStore'])->name('createOrStore');
});


Route::match(['get', 'post'], '/eligibility-short-course', [ShortCourseController::class, 'createOrStore'])->middleware('auth')->name('eligibility.course.createOrStore');
Route::get('/eligibility-short-course/{id}', [ShortCourseController::class, 'pdf'])->name('eligibility.course.pdf');
Route::get('/eligibility-short-course/{formId}/file/{id}/delete', [ShortCourseController::class, 'formFileDelete'])->name('eligibility.course.file.delete');
Route::delete('/short-course/delete/ayo', [ShortCourseController::class, 'shortCourseDeleteAco'])->name('eligibility.short.course.delete.aco');
Route::delete('/short-course/delete/coi', [ShortCourseController::class, 'shortCourseDeleteCoi'])->name('eligibility.short.course.delete.coi');


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
