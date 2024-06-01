<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Courses;
use App\Models\AlertForm;
use App\Models\Categories;
use App\Models\FiberWelcomeQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Exams\CourseController;
use App\Http\Controllers\Exams\ExamBankController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Exams\ConductExamController;
use App\Http\Controllers\Exams\ExaminationController;
use App\Http\Controllers\Upload\UploadCallController;
use App\Http\Controllers\Exams\ExamsResultsController;
use App\Http\Controllers\CallTracker\TrackerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Reports\CourseReportController;
use App\Http\Controllers\AlertForm\QaAlertFormController;
use App\Http\Controllers\Reports\AutoFailReportController;
use App\Http\Controllers\Reports\LiveCallReportController;
use App\Http\Controllers\Reports\ServicesReportController;
use App\Http\Controllers\CallSummary\CallSummaryController;
use App\Http\Controllers\Reports\CategoriesReportController;
use App\Http\Controllers\Reports\PercentileReportController;
use App\Http\Controllers\FiberQuestions\FiberChurnController;
use App\Http\Controllers\Leader\agentActionResultsController;
use App\Http\Controllers\Reports\ProductivityReportController;
use App\Http\Controllers\FiberQuestions\FiberInboundController;
use App\Http\Controllers\FiberQuestions\FiberWelcomeController;
use App\Http\Controllers\FiberQuestions\shopQuestionController;
use App\Http\Controllers\FiberQuestions\FiberLiveCallController;
use App\Http\Controllers\FiberQuestions\FiberOutboundController;
use App\Http\Controllers\FiberQuestions\billingQuestionController;
use App\Http\Controllers\FiberQuestions\digitalQuestionController;
use App\Http\Controllers\FiberQuestions\FiberEscalationController;
use App\Http\Controllers\QualityAnalyst\BillingCategoryController;
use App\Http\Controllers\FiberQuestions\fiberWelcomeEditController;
use App\Http\Controllers\QualityAnalyst\LiveCallCategoryController;
use App\Http\Controllers\QualityAnalyst\DthBillingCategoryController;
use App\Http\Controllers\QualityAnalyst\DthLiveCallCategoryController;
use App\Http\Controllers\FiberQuestions\ServiceSupportQuestionController;



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
//     return view('auth.login');
// });
Route::get('/', [App\Http\Controllers\CELinks\CELinksController::class, 'show'])->name('CEdashboard.show');
Route::post('/authenticate/user', [App\Http\Controllers\Auth\LoginController::class, 'authenticateUser'])->name('user.authenticate');

// Route::post('/authenticate/user', [AuthenticationController::class, 'login'])->name('user.authenticate');
Auth::routes();

Route::get('/auth/notActivated', [App\Http\Controllers\Auth\NotActivatedController::class, 'showNotActivated'])->name('notActivated');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {

Route::post('/home/store', [App\Http\Controllers\HomeController::class, 'store'])->name('home.store');
Route::resource('home', HomeController::class);
Route::post('/home/{id}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('home.edit');
Route::delete('/home/{id}/destroy', [App\Http\Controllers\HomeController::class, 'destroy'])->name('home.destroy');
Route::get('home/{id}/activate', [App\Http\Controllers\HomeController::class, 'activate'])->name('home.activate');
Route::get('home/{id}/deactivate',[App\Http\Controllers\HomeController::class,  'deactivate'])->name('home.deactivate');
Route::get('/home/destroy', [App\Http\Controllers\HomeController::class, 'show'])->name('home.show');


// setting --- roles -- permissions---departments//
Route::prefix('settings')->group(function () {

    //users
    Route::get('users', [UserController::class, 'index'])->name('settings.users');
    Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('settings.create');
    Route::post('users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('settings.store');
    Route::get('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('settings.users.show');
    Route::put('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('settings.users.update');
    Route::get('users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('settings.users.edit');
    Route::get('users/{id}/newUser', [App\Http\Controllers\Admin\UserController::class, 'newUser'])->name('settings.users.newUser');
    Route::get('users/{id}/profile', [App\Http\Controllers\Admin\UserController::class, 'profile'])->name('settings.users.profile');
    Route::get('users/{id}/view', [App\Http\Controllers\Admin\UserController::class, 'view'])->name('settings.users.view');
    Route::get('users/{id}/activate', [App\Http\Controllers\Admin\UserController::class, 'activate'])->name('settings.users.activate');
    Route::get('users/{id}/deactivate',[App\Http\Controllers\Admin\UserController::class,  'deactivate'])->name('settings.users.deactivate');
    Route::get('users/{id}/reset-password', [App\Http\Controllers\Admin\UserController::class, 'requestPasswordReset'])->name('settings.users.password.reset');
    Route::post('users/{id}/permissions', [App\Http\Controllers\Admin\UserController::class, 'updateUserPermissions'])->name('user.permissions.store');

    //roles
    Route::get('roles', [App\Http\Controllers\Admin\RolesController::class, 'index'])->name('settings.roles');
    Route::post('roles/post', [App\Http\Controllers\Admin\RolesController::class,'store'])->name('roles.store');
    Route::put('{id}', [App\Http\Controllers\Admin\RolesController::class,'update'])->name('roles.update');
    Route::get('roles/{id}/permissions', [App\Http\Controllers\Admin\RolesController::class,'rolePermissions'])->name('roles.permissions');
    Route::post('roles/{id}/permissions', [App\Http\Controllers\Admin\RolesController::class,'updateRolePermissions'])->name('roles.permissions.store');
    Route::get('roles/{id}/view', [App\Http\Controllers\Admin\RolesController::class,'view'])->name('roles.permissions.view');

    //permissions
    Route::get('permissions', [App\Http\Controllers\Admin\PermissionsController::class, 'index'])->name('settings.permissions');
    Route::get('permissions/filter', [App\Http\Controllers\Admin\PermissionsController::class, 'filterPermissions'])->name('permissions.modules');
    Route::get('permissions/modules', [App\Http\Controllers\Admin\PermissionsController::class,'permissionModules'])->name('permissions.modules');
    Route::get('permissions/modules/{module}/sub-modules', [App\Http\Controllers\Admin\PermissionsController::class,'permissionSubModules'])->name('permissions.sub-modules');
    Route::get('permissions/sub-modules', [App\Http\Controllers\Admin\PermissionsController::class,'permissionSubModules'])->name('permissions.sub-modules');

    //departments
    Route::get('departments', [App\Http\Controllers\DepartmentsController::class, 'index'])->name('settings.departments.index');
    Route::post('departments/post', [App\Http\Controllers\DepartmentsController::class, 'store'])->name('settings.departments.post');
    Route::post('departments/edit', [App\Http\Controllers\DepartmentsController::class, 'edit'])->name('settings.departments.edit');
});


/* Create parameters and Edit */
Route::resource('parametor', fiberWelcomeEditController::class);
Route::get('admin/edit_parametors/Fiber/{parametor}/show', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'show'])->name('parametor.show');
Route::post('admin/edit_parametors/Fiber/{parametors}/edit', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'edit'])->name('parametor.edit');
Route::get('admin/edit_parametors/Fiber/{parametors}/edit', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'edit'])->name('parametor.edit');
Route::post('admin/edit_parametors/Fiber/{parametors}/update', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'update'])->name('parametor.update');
Route::get('admin/edit_parametors/Fiber/welcomequestion', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'create'])->name('create_parametor');
Route::post('admin/edit_parametors/Fiber/welcomequestionedit', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'store'])->name('parametor.store');
Route::get('admin/edit_parametors/Fiber/welcomequestionedit', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'index'])->name('welcomequestionedit');
Route::delete('admin/edit_parametors/Fiber/welcomequestionedit/{parametors}', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'destroy'])->name('parametor.destroy');


Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

Route::get('/system_links/dashboard_link', [App\Http\Controllers\CELinks\CELinksController::class, 'index'])->name('CEdashboard');
Route::post('/system_links/dashboard_link', [App\Http\Controllers\CELinks\CELinksController::class, 'store'])->name('link.store');
Route::resource('systemLinks', CELinksController::class);


/* QA Category and Results Routes */
Route::get('quality_analyst/category', [App\Http\Controllers\QualityAnalyst\CategoryController::class, 'index'])->name('category');

Route::resource('billing', BillingCategoryController::class);
Route::get('quality_analyst/{billing}/billingteamcategory', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'index'])->name('billingteamcategory');
Route::post('quality_analyst/billingteamcategory', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'store'])->name('billing.store');
Route::get('results/billing/billing_results/{billing}', [App\Http\Controllers\Results\billing\BillingResultsController::class, 'index'])->name('billing_results');
Route::get('results/billing/billing_edit/{billing}', [App\Http\Controllers\Results\billing\BillingResultsController::class, 'edit'])->name('billing_edit');
Route::post('results/billing/billing_edit/{billing}', [App\Http\Controllers\Results\billing\BillingResultsController::class, 'update'])->name('billing_update');


//Route::post('quality_analyst/livecallsteamcategory', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'livecalls'])->name('livecalls');
//Route::get('/results/Fiber/fiber_livecalls_results', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'show'])->name('fiber_livecalls_results');

Route::resource('dthbilling', DthBillingCategoryController::class);
Route::get('quality_analyst/{dthbilling}/dthbillingteamcategory', [App\Http\Controllers\QualityAnalyst\DthBillingCategoryController::class, 'index'])->name('dthbillingteamcategory');
Route::post('quality_analyst/dthbillingteamcategory', [App\Http\Controllers\QualityAnalyst\DthBillingCategoryController::class, 'store'])->name('dthbilling.store');
Route::post('quality_analyst/dthbillingteamcategory', [App\Http\Controllers\QualityAnalyst\DthBillingCategoryController::class, 'storelive'])->name('dthbilling.storelive');
Route::get('results/Dth/dth_billing_results/{dthbilling}', [App\Http\Controllers\Results\Dth\DthBillingResultsController::class, 'index'])->name('dth_billing_results');
Route::get('results/Dth/dth_edit_results/{dthbilling}', [App\Http\Controllers\Results\Dth\DthBillingResultsController::class, 'edit'])->name('dthbilling.edit');

Route::resource('dthlivecalls', DthLiveCallCategoryController::class);
//Route::get('quality_analyst/{dthlivecalls}/dthlivecallsteamcategory', [App\Http\Controllers\QualityAnalyst\DthLiveCallCategoryController::class, 'index'])->name('dthlivecallsteamcategory');
Route::post('quality_analyst/dthlivecallsteamcategory', [App\Http\Controllers\QualityAnalyst\DthLiveCallCategoryController::class, 'store'])->name('dthlivecalls.store');
Route::get('results/Dth/dth_livecalls_results/{dthlivecalls}', [App\Http\Controllers\QualityAnalyst\DthLiveCallCategoryController::class, 'index'])->name('dthlivecalls.index');

Route::resource('livecalls', LiveCallCategoryController::class);
// Route::get('quality_analyst/{livecalls}/livecallsteamcategory', [App\Http\Controllers\QualityAnalyst\LiveCallCategoryController::class, 'index'])->name('livecallsteamcategory');
Route::post('quality_analyst/livecallsteamcategory', [App\Http\Controllers\QualityAnalyst\LiveCallCategoryController::class, 'store'])->name('livecalls.store');
Route::get('results/Fiber/fiber_livecalls_results/{livecalls}', [App\Http\Controllers\QualityAnalyst\LiveCallCategoryController::class, 'index'])->name('livecalls.index');
//Route::get('results/Fiber/fiber_livecalls_results/{livecalls}', [App\Http\Controllers\Results\Fiber\FiberliveCallsResultsController::class, 'show'])->name('fiber_livecalls_results');

Route::get('categorylivesupervisor/{id}', function ($id) {
    $supervisorName = App\Models\Role::join('model_has_roles','model_has_roles.role_id','=','roles.id')
                                       ->join('users','users.id','=','model_has_roles.model_id')
                                        ->join('user_categories','user_categories.user_id','=','model_has_roles.model_id')
                                       ->where('user_categories.category_id','=',$id)
                                       ->where('roles.name', '=', 'team-leader')
                                     ->get();
    return response()->json($supervisorName);
});


Route::get('categoryliveagent/{id}', function ($id) {
    $supervisorName = App\Models\Role::join('model_has_roles','model_has_roles.role_id','=','roles.id')
                                       ->join('users','users.id','=','model_has_roles.model_id')
                                        ->join('user_categories','user_categories.user_id','=','model_has_roles.model_id')
                                       ->where('user_categories.category_id','=',$id)
                                       ->where('roles.name', '=', 'Agent')
                                     ->get();
    return response()->json($supervisorName);
});



/* Exams Routes */
Route::resource('conductexam',ConductExamController::class);
Route::get('exams/conduct_exam',[App\Http\Controllers\Exams\ConductExamController::class,'index'])->name('conduct_exam');
Route::get('exams/schedule_exam',[App\Http\Controllers\Exams\ConductExamController::class,'create'])->name('conductexam.create');
Route::get('exams/{conductexam}/edit_conduct',[App\Http\Controllers\Exams\ConductExamController::class,'edit'])->name('conductexam.edit');
Route::get('exams/{conductexam}/view_conduct',[App\Http\Controllers\Exams\ConductExamController::class,'show'])->name('conductexam.show');
Route::post('exams/{conductexam}/edit_conduct',[App\Http\Controllers\Exams\ConductExamController::class,'update'])->name('conductexam.update');
Route::delete('exams/{conductexam}/delete',[App\Http\Controllers\Exams\ConductExamController::class,'destroy'])->name('conductexam.destroy');
Route::post('exams/schedule_exam',[App\Http\Controllers\Exams\ConductExamController::class,'store'])->name('conductexam.store');
Route::post('exams/conduct_exams/{id}/deactivate', [App\Http\Controllers\Exams\ConductExamController::class,'deactivate'])->name('exams.conduct_exams.deactivate');
//Route::post('exams/{conductexam}/edit_conduct',[App\Http\Controllers\Exams\ConductExamController::class,'deactivate'])->name('conductexam.deactivate');
Route::post('exams/conduct_exams/{id}/reactivate', [App\Http\Controllers\Exams\ConductExamController::class,'reactivate'])->name('exams.conduct_exams.reactivate');



Route::resource('examination',ExaminationController::class);
Route::get('exams/{examination}/examination',[App\Http\Controllers\Exams\ExaminationController::class,'index'])->name('examination.index');
// Route::get('exams/{examination}/{conductid}/{examid}/examination',[App\Http\Controllers\Exams\ExaminationController::class,'index'])->name('examination.index');
Route::post('exams/examination',[App\Http\Controllers\Exams\ExaminationController::class,'store'])->name('examination.store');
Route::get('exams/agent_examination',[App\Http\Controllers\Exams\ExaminationController::class,'show'])->name('examination.show');


Route::resource('examresult',ExamsResultsController::class);
Route::get('exams/exam_result',[App\Http\Controllers\Exams\ExamsResultsController::class, 'index'])->name('examresult.index');
Route::get('/exams/view_exam_results/{examresult}/{schedule_id}',[App\Http\Controllers\Exams\ExamsResultsController::class, 'show'])->name('examresult.show');
Route::get('exams/view_results/{conductid}/{examresult}/{examid}',[App\Http\Controllers\Exams\ExamsResultsController::class, 'viewResults'])->name('examresult.viewResults');
Route::get('/exams/exams_show/{examresult}/{schedule_id}',[App\Http\Controllers\Exams\ExamsResultsController::class, 'edit'])->name('examresult.edit');
Route::post('exams/exam_result',[App\Http\Controllers\Exams\ExamsResultsController::class, 'store'])->name('examresult.store');

Route::resource('exambank',ExamBankController::class);
Route::get('exams/exam_bank',[App\Http\Controllers\Exams\ExamBankController::class, 'index'])->name('exam_bank');
Route::get('exams/{exambank}/exam_bank',[App\Http\Controllers\Exams\ExamBankController::class, 'destroy'])->name('exambank.destroy');
Route::post('/exams/create_exam',[App\Http\Controllers\Exams\ExamBankController::class, 'store'])->name('store');
Route::get('exams/{question}/view_questions',[App\Http\Controllers\Exams\ExamBankController::class, 'questionShow'])->name('view_questions.questionShow');
Route::get('/exams/create_exam',[App\Http\Controllers\Exams\ExamBankController::class, 'create'])->name('exambank.store');
Route::get('exams/edit_exam',[App\Http\Controllers\Exams\ExamBankController::class, 'edit'])->name('exam_bank.edit');
Route::post('exams/{question}',[App\Http\Controllers\Exams\ExamBankController::class, 'update'])->name('exambank.update');
Route::get('exams/{question}/exam_view',[App\Http\Controllers\Exams\ExamBankController::class, 'show'])->name('exam_view.show');
Route::get('/exams/create_exam',[App\Http\Controllers\Exams\ExamBankController::class, 'choicestore'])->name('exambank.choicestore');

Route::resource('create_course',CourseController::class);
Route::get('/exams/course_view',[App\Http\Controllers\Exams\CourseController::class, 'index'])->name('course_view');
Route::get('exams/create_course',[App\Http\Controllers\Exams\CourseController::class, 'create'])->name('create_course');
Route::post('/exams/create_course',[App\Http\Controllers\Exams\CourseController::class, 'store'])->name('store');
Route::delete('exams/{create_course}/create_course',[App\Http\Controllers\Exams\CourseController::class, 'destory'])->name('course.destory');
Route::get('exams/{create_course}/edit_course',[App\Http\Controllers\Exams\CourseController::class, 'edit'])->name('create_course.edit');
Route::post('exams/{create_course}/edit_course',[App\Http\Controllers\Exams\CourseController::class, 'update'])->name('create_course.update');



//crm//
Route::get('call_tracker/tracker_view', [App\Http\Controllers\CallTracker\TrackerController::class, 'index'])->name('tracker_view');
Route::resource('call_tracker', TrackerController::class);
Route::post('/call_tracker/create', [App\Http\Controllers\CallTracker\TrackerController::class, 'store'])->name('call_tracker.store');
Route::post('/call_tracker/{call_tracker}/edit_tracker', [App\Http\Controllers\CallTracker\TrackerController::class, 'edit'])->name('call_tracker.edit');
Route::post('/call_tracker/{call_tracker}/update', [App\Http\Controllers\CallTracker\TrackerController::class, 'update'])->name('call_tracker.update');
Route::get('/call_tracker/{call_tracker}/show_tracker', [App\Http\Controllers\CallTracker\TrackerController::class, 'show'])->name('call_tracker.show');
//Route::get('call_tracker/{call_tracker}/create', [App\Http\Controllers\CallTracker\TrackerController::class, 'storeSub'])->name('call_tracker.storeSub');
Route::post('call_tracker/{call_tracker}/{service_id}/create', [App\Http\Controllers\CallTracker\TrackerController::class, 'storeSub'])->name('call_tracker.storeSub');
Route::delete('/call_tracker/{call_tracker}/destroy', [App\Http\Controllers\CallTracker\TrackerController::class, 'destroy'])->name('call_tracker.destroy');

Route::get('calltracker/{id}', function ($id) {
    $SubCallTracker = App\Models\SubCallTracker::where('call_tracker_id',$id)->get();
    return response()->json($SubCallTracker);
});

Route::get('call_summary/summary', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'index'])->name('summaryview');
Route::resource('summary', CallSummaryController::class);
Route::post('/call_summary/create', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'store'])->name('summary.store');
Route::post('/call_summary/update', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'update'])->name('summary.update');
Route::post('/call_summary/{summary}/edit', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'edit'])->name('summary.edit');
Route::post('/call_summary/{summary}/strength', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'voc'])->name('summary.voc');
Route::post('/call_summary/create', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'storeGap'])->name('summary.storeGap');

Route::resource('general', App\Http\Controllers\General\GeneralIssueController::class);
Route::get('general_issue/general_view', [App\Http\Controllers\General\GeneralIssueController::class, 'index'])->name('general.index');
Route::post('general_issue/general_view', [App\Http\Controllers\General\GeneralIssueController::class, 'store'])->name('general.store');
Route::post('general_issue/{general}/general_view', [App\Http\Controllers\General\GeneralIssueController::class, 'storeGen'])->name('general.storeGen');
Route::post('general_issue/{general}/general_edit', [App\Http\Controllers\General\GeneralIssueController::class, 'edit'])->name('general.edit');
Route::post('general_issue/{general}/general_update', [App\Http\Controllers\General\GeneralIssueController::class, 'update'])->name('general.update');
Route::get('general_issue/{general}/general_show', [App\Http\Controllers\General\GeneralIssueController::class, 'show'])->name('general.show');
Route::delete('general_issue/{general}/general_destory', [App\Http\Controllers\General\GeneralIssueController::class, 'destroy'])->name('general.destroy');

Route::get('general-id/{id}', function ($id) {
    $SubIssueGeneral = App\Models\SubIssueGeneral::where('issue_general_id',$id)->get();
    return response()->json($SubIssueGeneral);
});

/** Uplaod Good and Bad Calls of the month */
Route::resource('upload',UploadCallController::class);
Route::get('call_saved/upload_calls',[App\Http\Controllers\Upload\UploadCallController::class, 'index'])->name('upload.index');
Route::post('call_saved/upload_calls',[App\Http\Controllers\Upload\UploadCallController::class, 'store'])->name('upload.store');
Route::get('call_saved/{upload}/upload_calls',[App\Http\Controllers\Upload\UploadCallController::class, 'show'])->name('upload.show');
Route::get('call_saved/{upload}/upload_calls',[App\Http\Controllers\Upload\UploadCallController::class, 'edit'])->name('upload.edit');
Route::delete('call_saved/{upload}/upload_calls',[App\Http\Controllers\Upload\UploadCallController::class, 'destory'])->name('upload.destory');

/* Alert form Routes */
Route::resource('autofail', App\Http\Controllers\AlertForm\QaAlertFormController::class);
Route::get('alert_forms/pdf', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'generatePDF'])->name('autofail.pdf');
Route::get('/generate-pdf/{id}', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'generatePDF'])->name('autofail.generatePDF');
Route::get('alert_forms/alert_view_full/{id}', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'show'])->name('autofail.show');
Route::get('/quality_analyst/qa_agent_alert_form/{id}', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'index'])->name('qa_agent_alert_form');
Route::post('/quality_analyst/qa_agent_alert_form/', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'store'])->name('autofail.store');
Route::get('team_leader/tl_agent_alert_form/{id}', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'edit'])->name('autofail.edit');
Route::post('team_leader/tl_agent_alert_form/{id}', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'updateAlert'])->name('autofail.updateAlert');


Route::get('category/{id}', function ($id) {
    $AgentName = App\Models\Role::join('model_has_roles','model_has_roles.role_id','=','roles.id')
                                       ->join('users','users.id','=','model_has_roles.model_id')
                                        ->join('user_categories','user_categories.user_id','=','model_has_roles.model_id')
                                       ->where('user_categories.category_id','=',$id)
                                       ->where('roles.name', '=', 'Agent')
                                     ->get();
    return response()->json($AgentName);
})->name('category_agent');

 /* Coaching Forms Routes */
 Route::resource('coaching', App\Http\Controllers\CoachingController::class);
 Route::get('/coaching_forms/index/{coaching}', [App\Http\Controllers\CoachingController::class, 'index'])->name('coaching.index');
 Route::get('coaching_forms/view/', [App\Http\Controllers\CoachingController::class, 'create'])->name('coaching.create');
 Route::get('coaching_forms/view/', [App\Http\Controllers\CoachingController::class, 'coach'])->name('coaching.coach');
 Route::get('coaching_forms/agent_edit/{coaching}', [App\Http\Controllers\CoachingController::class, 'agentEdit'])->name('coaching.agentEdit');
 Route::post('coaching_forms/agent_edit/{coaching}', [App\Http\Controllers\CoachingController::class, 'update'])->name('coaching.update');
 Route::get('coaching_forms/show/{coaching}/{results_id}',[App\Http\Controllers\CoachingController::class, 'show'])->name('coaching.show');
 Route::post('/coaching_forms/index/', [App\Http\Controllers\CoachingController::class, 'store'])->name('coaching.store');
 Route::get('coaching_forms/{coaching}/edit', [App\Http\Controllers\CoachingController::class, 'edit'])->name('coaching.edit');
 Route::post('coaching_forms/{coaching}/edit', [App\Http\Controllers\CoachingController::class, 'supervisorUpdate'])->name('coaching.supervisorUpdate');
 Route::get('coaching_forms/coaching_pdf',[App\Http\Controllers\CoachingController::class, 'generatePDF'])->name('coaching.pdf');
 Route::get('/coaching_forms/coaching_pdf/{coaching}/{results_id}', [App\Http\Controllers\CoachingController::class, 'generatePDF'])->name('coaching.generatePDF');
//  Route::get('coaching_forms/view/', [App\Http\Controllers\CoachingController::class, 'quality'])->name('coaching.quality');




    /* agent Routes */
    Route::get('agent/agent_action', [App\Http\Controllers\Agent\AgentActionController::class, 'index'])->name('agent_action');
    Route::get('agent/agentdashboard', [App\Http\Controllers\Agent\AgentDashboardController::class, 'index'])->name('agentdashboard');
    Route::get('agent/agent_results', [App\Http\Controllers\Agent\AgentResultsController::class, 'index'])->name('agent_results');
    Route::get('agent/agent_view_results', [App\Http\Controllers\Agent\AgentViewResultsController::class, 'index'])->name('agent_view_results');

    Route::resource('agent_alert_form',AgentAlertFormController::class);
    Route::get('agent/agent_alert_form', [App\Http\Controllers\Agent\AgentAlertFormController::class, 'index'])->name('agent_alert_form');
    Route::get('agent_alert_form', [App\Http\Controllers\Agent\AgentAlertFormController::class, 'agent_alert_form']);
    Route::get('agent/agent_alert_form/{agent_alert_form}/edit', [App\Http\Controllers\Agent\AgentAlertFormController::class, 'edit'])->name('agent_alert_form.edit');
    Route::post('agent/agent_alert_form/{agent_alert_form}/update', [App\Http\Controllers\Agent\AgentAlertFormController::class, 'update'])->name('agent_alert_form.update');



/* Result view */

Route::get('results/result_view', [App\Http\Controllers\Results\Result\ResultController::class, 'index'])->name('results/result_view');

Route::resource('final_show_view', App\Http\Controllers\AlertForm\AlertResultsController::class);
Route::get('/alert_forms/alert_forms_view', [App\Http\Controllers\AlertForm\AlertResultsController::class, 'index'])->name('final_show_view.index');
Route::get('/alert_forms/alert_forms_view', [App\Http\Controllers\AlertForm\AlertResultsController::class, 'show'])->name('final_show_view.show');



/* Team Leader Routes */
Route::resource('qaresults',agentActionResultsController::class);
Route::get('team_leader/{qaresults}/Teamleader_action_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'edit'])->name('qaresults.edit');
Route::Post('team_leader/Teamleader_action_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'update'])->name('qaresults.update');
Route::get('team_leader/Teamleader_action_results/{qaresults}', [App\Http\Controllers\Leader\agentActionResultsController::class, 'index']);
Route::get('team_leader/agents_actions_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'index'])->name('qaresults.index');
Route::get('team_leader/agents_actions_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'create'])->name('qaresults.create');
Route::get('team_leader/{qaresults}/teamleader_view_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'show'])->name('qaresults.show');
Route::get('team_leader/teamleader_view_results/{qaresults}', [App\Http\Controllers\Leader\agentActionResultsController::class, 'show'])->name('qaresults.show');
Route::get('team_leader/agents_actions_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'destroy'])->name('qaresults.destroy');
Route::get('team_leader/agents_actions_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'qualityreport'])->name('qaresults.qualityreport');



Route::get('team_leader/TeamleaderDashboard', [App\Http\Controllers\Leader\teamleaderdashboardController::class, 'index'])->name('TeamleaderDashboard');
Route::get('team_leader/Teamleader_action_results', [App\Http\Controllers\Leader\TeamLeaderActionResultsController::class, 'index'])->name('Teamleader_action_results');
Route::get('team_leader/Teamleader_action_results', [App\Http\Controllers\Leader\TeamLeaderActionResultsController::class, 'store'])->name('qareport');





/* Quality Analyst Routes */
Route::get('quality_analyst/qadashboard', [App\Http\Controllers\QualityAnalyst\QaDashboardController::class, 'index'])->name('qadashboard');
Route::post('quality_analyst/qa_agent_alert_form', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'qa_agent_alert_form'])->name('qa_agent_alert_form');
Route::get('qa_agent_alert_form', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'qa_agent_alert_form']);
Route::get('quality_analyst/qa_agent_alert_form', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'index'])->name('qa_agent_alert_form');






/* Report Routes */
Route::get('reports/reports', [App\Http\Controllers\Reports\ReportsController::class, 'index'])->name('reports');
/* Gobal Report Routes */
Route::resource('global',App\Http\Controllers\Reports\GlobalReportController::class);
Route::get('reports/global_report', [App\Http\Controllers\Reports\GlobalReportController::class, 'index'])->name('global.index');
Route::get('reports/global_report', [App\Http\Controllers\Reports\GlobalReportController::class, 'show'])->name('global.show');

/* service Report Routes */
Route::resource('servicereport', ServicesReportController::class);
Route::get('reports/service_reports', [App\Http\Controllers\Reports\ServicesReportController::class, 'index'])->name('servicereport.index');
Route::get('reports/service_reports', [App\Http\Controllers\Reports\ServicesReportController::class, 'show'])->name('servicereport.show');

/* productivity Report Routes */
Route::resource('productivity',ProductivityReportController::class);
Route::get('reports/productivity', [App\Http\Controllers\Reports\ProductivityReportController::class, 'index'])->name('productivity.index');
Route::get('reports/productivity', [App\Http\Controllers\Reports\ProductivityReportController::class, 'show'])->name('produtivity.show');

/* percentile Report Routes */
Route::resource('percentile',PercentileReportController::class);
Route::get('reports/percentile_report', [App\Http\Controllers\Reports\PercentileReportController::class, 'index'])->name('percentile.index');
Route::get('reports/percentile_report', [App\Http\Controllers\Reports\PercentileReportController::class, 'show'])->name('percentile.show');

/* Auto -Fail Report Routes */
Route::resource('autofailreport', AutoFailReportController::class);
Route::get('reports/auto_fail_report', [App\Http\Controllers\Reports\AutoFailReportController::class, 'index'])->name('autofailreport.index');
Route::get('reports/auto_fail_report', [App\Http\Controllers\Reports\AutoFailReportController::class, 'show'])->name('autofailreport.show');

Route::get('auto-fail/{id}', function ($id) {
    $categoryName = App\Models\Categories::where('service_id',$id)->get();
    return response()->json($categoryName);
});

/* category Report Routes */
Route::resource('categories_report', CategoriesReportController::class);
Route::get('reports/categories_report', [App\Http\Controllers\Reports\CategoriesReportController::class, 'index'])->name('categories_report.index');
Route::get('reports/categories_report', [App\Http\Controllers\Reports\CategoriesReportController::class, 'show'])->name('categories_report.show');

/*courses Report Routes*/
Route::resource('course_report', CourseReportController::class);
Route::get('reports/course_report', [App\Http\Controllers\Reports\CourseReportController::class, 'index'])->name('course_report.index');
Route::get('reports/course_report', [App\Http\Controllers\Reports\CourseReportController::class, 'show'])->name('course_report.show');

Route::get('course-report/{id}', function ($id) {
    $course_name = App\Models\Courses::where('service_id',$id)->get();
    return response()->json($course_name);
});

/*livecalls Report Routes*/
Route::resource('livecallsreport', LiveCallReportController::class);
Route::get('reports/livecallsreports', [App\Http\Controllers\Reports\LiveCallReportController::class, 'index'])->name('livecallsreport.index');
Route::get('reports/livecallsreports', [App\Http\Controllers\Reports\LiveCallReportController::class, 'show'])->name('livecallsreport.show');



Route::get('course-exam/{id}', function ($id) {
    $exam_name = App\Models\ConductExam::where('course',$id)->get();
    return response()->json($exam_name);
});



Route::get('trainer-exam/{id}', function ($id) {
    $trainerInfo = App\Models\ConductExam::where('course', $id)
             ->select('conduct_exams.trainer_qa', 'users.username')

        ->join('users', 'users.id', '=', 'conduct_exams.trainer_qa')
        ->first();

    if ($trainerInfo) {
        return response()->json(['username' => $trainerInfo->username]);
    } else {
        return response()->json(['error' => 'Trainer not found'], 404);
    }
});


});
