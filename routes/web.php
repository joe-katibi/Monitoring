<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\FiberQuestions\fiberWelcomeEditController;
use App\Http\Controllers\FiberQuestions\billingQuestionController;
use App\Http\Controllers\FiberQuestions\digitalQuestionController;
use App\Http\Controllers\FiberQuestions\FiberChurnController;
use App\Http\Controllers\FiberQuestions\FiberEscalationController;
use App\Http\Controllers\FiberQuestions\FiberInboundController;
use App\Http\Controllers\FiberQuestions\FiberLiveCallController;
use App\Http\Controllers\FiberQuestions\FiberOutboundController;
use App\Http\Controllers\FiberQuestions\FiberWelcomeController;
use App\Models\FiberWelcomeQuestion;
use App\Http\Controllers\AlertForm\QaAlertFormController;
use App\Models\AlertForm;
use App\Http\Controllers\FiberQuestions\ServiceSupportQuestionController;
use App\Http\Controllers\FiberQuestions\shopQuestionController;



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
    return view('welcome');
});

Route::post('/authenticate/user', [App\Http\Controllers\Auth\LoginController::class, 'authenticateUser']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
    Route::get('/admin/permissions', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions');
    Route::get('/admin/roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role');
    Route::get('/admin/roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles');
    Route::post('/admin/roles', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('store');
    Route::get('/admin/usermanagement', [App\Http\Controllers\Admin\UserManagementController::class, 'index'])->name('usermanagement');
    Route::resource('roles', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('users', UserController::class);
    Route::resource('parametor', FiberWelcomeEditController::class);
    Route::post('admin/edit_parametors/Fiber/{parametors}/edit', [App\Http\Controllers\FiberQuestions\FiberWelcomeEditController::class, 'edit'])->name('parametor.edit');
    Route::get('admin/edit_parametors/Fiber/{parametors}/edit', [App\Http\Controllers\FiberQuestions\FiberWelcomeEditController::class, 'edit'])->name('parametor.edit');
    Route::put('admin/edit_parametors/Fiber/{parametors}/edit', [App\Http\Controllers\FiberQuestions\FiberWelcomeEditController::class, 'update'])->name('parametor.update');
    Route::get('admin/edit_parametors/Fiber/welcomequestion', [App\Http\Controllers\FiberQuestions\FiberWelcomeEditController::class, 'create'])->name('create_parametor');
    Route::post('admin/edit_parametors/Fiber/welcomequestionedit', [App\Http\Controllers\FiberQuestions\FiberWelcomeEditController::class, 'store'])->name('parametor.store');
    Route::get('admin/edit_parametors/Fiber/welcomequestionedit', [App\Http\Controllers\FiberQuestions\FiberWelcomeEditController::class, 'index'])->name('welcomequestionedit');
    Route::delete('roles/{role}/roles', [RolesController::class, 'roles.edit'])->name('roles.edit');
    Route::delete('roles/{role}/edit', [RolesController::class, 'roles.edit'])->name('roles.edit');
    Route::post('/roles/create', [App\Http\Controllers\admin\RoleController::class, 'store'])->name('roles.store');
    Route::get('/admin/role/edit', [App\Http\Controllers\admin\RoleController::class, 'edit'])->name('edit');
    Route::get('roles/{role}/roles', [App\Http\Controllers\admin\RoleController::class, 'edit'])->name('roles.update');
    Route::put('users/{role}/users', [App\Http\Controllers\admin\UserController::class, 'edit'])->name('users.update');
    Route::delete('roles/{role}', [RoleController::class, 'removeRole'])->name('users.roles.remove');
    Route::get('/admin/Users/edit', [App\Http\Controllers\admin\UserController::class, 'edit'])->name('edit');
    Route::get('/admin/Users/create', [App\Http\Controllers\admin\UserController::class, 'update'])->name('update');
    Route::get('/admin/Users/{user}/view', [App\Http\Controllers\admin\UserController::class, 'show'])->name('show');
    Route::post('/users/create', [App\Http\Controllers\admin\UserController::class, 'store'])->name('store');
    Route::post('roles/{role}/permissions', [App\Http\Controllers\admin\RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('roles/{role}/permissions/{permission}', [App\Http\Controllers\admin\RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::delete('/users/{user}/roles/{role}', [App\Http\Controllers\admin\UserController::class, 'removeRole'])->name('roles.remove');
    Route::post('/users/{user}/roles', [App\Http\Controllers\admin\UserController::class, 'assignRole'])->name('users.roles');
    Route::get('/users/{user}/user', [App\Http\Controllers\admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('roles/{role}/role', [App\Http\Controllers\admin\RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('admin/permission/create', [App\Http\Controllers\admin\PermissionController::class, 'create'])->name('permission.create');
    Route::get('/admin/permission/edit', [App\Http\Controllers\admin\PermissionController::class, 'update'])->name('permission.update');
    Route::delete('permission/{role}', [App\Http\Controllers\admin\PermissionController::class, 'destroy'])->name('permission.destroy');



    // Route::post('roles/{role}/permissions',[RolesController::class,'givePermission'])->name('roles.permissions');
    // Route::delete('roles/{role}/permissions/{permission}',[RolesController::class,'revokePermission'])->name('roles.permissions.revoke');


    // Route::delete('users/{user}',[UserController::class,'destroy'])->name('users.destroy');
    // Route::get('users/{user}',[UserController::class,'show'])->name('users.show');
    // Route::post('roles/{role}/roles',[UserController::class,'assignRole'])->name('users.destory');
    // Route::delete('roles/{role}',[UserController::class,'removeRole'])->name('users.roles.remove');
    // Route::post('roles/{role}/permissions',[UserController::class,'givePermission'])->name('users.permissions');
    // Route::delete('roles/{role}/permissions/{permission}',[UserController::class,'revokePermission'])->name('users.permissions.revoke');
    //Route::get('results/billing/billing_results', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'index'])->name('result');

});

// Route::prefix('Quality Analysts')->group(function () {

//     Route::get('quality_analyst/Welcometeamcategory', [App\Http\Controllers\QualityAnalyst\WelcomeCategoryController::class, 'index'])->name('welcometeamcategory');


// });

/* QA Category and Results Routes */
Route::get('quality_analyst/category', [App\Http\Controllers\QualityAnalyst\CategoryController::class, 'index'])->name('category');

Route::resource('billing', App\Http\Controllers\QualityAnalyst\BillingCategoryController::class);
Route::get('quality_analyst/{billing}/billingteamcategory', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'index'])->name('billingteamcategory');
Route::post('quality_analyst/billingteamcategory', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'store'])->name('billing.store');
Route::get('results/billing/billing_results', [App\Http\Controllers\Results\billing\BillingResultsController::class, 'index'])->name('billing_results');


Route::post('quality_analyst/livecallsteamcategory', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'livecalls'])->name('livecalls');
Route::get('/results/Fiber/fiber_livecalls_results', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'show'])->name('fiber_livecalls_results');

Route::resource('dthbilling', App\Http\Controllers\QualityAnalyst\DthBillingCategoryController::class);
Route::get('quality_analyst/{dthbilling}/dthbillingteamcategory', [App\Http\Controllers\QualityAnalyst\DthBillingCategoryController::class, 'index'])->name('dthbillingteamcategory');
Route::post('quality_analyst/dthbillingteamcategory', [App\Http\Controllers\QualityAnalyst\DthBillingCategoryController::class, 'store'])->name('dthbilling.store');
Route::post('quality_analyst/dthbillingteamcategory', [App\Http\Controllers\QualityAnalyst\DthBillingCategoryController::class, 'storelive'])->name('dthbilling.storelive');
Route::get('results/Dth/dth_billing_results', [App\Http\Controllers\Results\Dth\DthBillingResultsController::class, 'index'])->name('dth_billing_results');

Route::resource('dthlivecalls', App\Http\Controllers\QualityAnalyst\DthLiveCallCategoryController::class);
Route::get('quality_analyst/{dthlivecalls}/dthlivecallsteamcategory', [App\Http\Controllers\QualityAnalyst\DthLiveCallCategoryController::class, 'index'])->name('dthlivecallsteamcategory');
Route::post('quality_analyst/dthlivecallsteamcategory', [App\Http\Controllers\QualityAnalyst\DthLiveCallCategoryController::class, 'store'])->name('dthlivecalls.store');
Route::get('results/Dth/dth_livecalls_results', [App\Http\Controllers\Results\Dth\DthLiveCallResultsController::class, 'index'])->name('dth_livecalls_results');

// Route::resource('livecalls', App\Http\Controllers\QualityAnalyst\LiveCallCategoryController::class);
// Route::get('quality_analyst/{livecalls}/livecallsteamcategory', [App\Http\Controllers\QualityAnalyst\LiveCallCategoryController::class, 'index'])->name('livecallsteamcategory');
// Route::post('quality_analyst/livecallsteamcategory', [App\Http\Controllers\QualityAnalyst\LiveCallCategoryController::class, 'store'])->name('livecalls.store');
// Route::get('results/Fiber/fiber_livecalls_results', [App\Http\Controllers\Results\Fiber\FiberliveCallsResultsController::class, 'index'])->name('fiber_livecalls_results');



/* Exams Routes */
Route::resource('conductexam', App\Http\Controllers\Exams\ConductExamController::class);
Route::get('exams/conduct_exam', [App\Http\Controllers\Exams\ConductExamController::class, 'index'])->name('conduct_exam');
Route::get('exams/schedule_exam', [App\Http\Controllers\Exams\ConductExamController::class, 'create'])->name('conductexam.create');
Route::get('exams/{conductexam}/edit_conduct', [App\Http\Controllers\Exams\ConductExamController::class, 'edit'])->name('conductexam.edit');
Route::get('exams/{conductexam}/view_conduct', [App\Http\Controllers\Exams\ConductExamController::class, 'show'])->name('conductexam.show');
Route::get('exams/{conductexam}/edit_conduct', [App\Http\Controllers\Exams\ConductExamController::class, 'update'])->name('conductexam.update');
Route::delete('exams/{conductexam}/view_conduct', [App\Http\Controllers\Exams\ConductExamController::class, 'destroy'])->name('conductexam.destroy');
Route::post('exams/schedule_exam', [App\Http\Controllers\Exams\ConductExamController::class, 'store'])->name('conductexam.store');

Route::resource('examination', App\Http\Controllers\Exams\ExaminationController::class);
Route::get('exams/examination', [App\Http\Controllers\Exams\ExaminationController::class, 'index'])->name('examination');
Route::post('exams/examination', [App\Http\Controllers\Exams\ExaminationController::class, 'store'])->name('examination.store');
Route::get('exams/{examination}/examination', [App\Http\Controllers\Exams\ExaminationController::class, 'show'])->name('examination.show');


Route::resource('examresult', App\Http\Controllers\Exams\ExamsResultsController::class);
Route::get('exams/exam_result', [App\Http\Controllers\Exams\ExamsResultsController::class, 'index'])->name('exam_result');
Route::get('/exams/view_exam_results', [App\Http\Controllers\Exams\ExamsResultsController::class, 'show'])->name('examresult.show');
Route::post('exams/exam_result', [App\Http\Controllers\Exams\ExamsResultsController::class, 'store'])->name('examresult.store');

Route::resource('exambank', App\Http\Controllers\Exams\ExamBankController::class);
Route::get('exams/exam_bank', [App\Http\Controllers\Exams\ExamBankController::class, 'index'])->name('exam_bank');
Route::get('exams/{exambank}/exam_bank', [App\Http\Controllers\Exams\ExamBankController::class, 'destroy'])->name('exambank.destroy');
Route::post('/exams/create_exam', [App\Http\Controllers\Exams\ExamBankController::class, 'store'])->name('store');
Route::get('/exams/create_exam', [App\Http\Controllers\Exams\ExamBankController::class, 'create'])->name('exambank.store');
Route::get('exams/edit_exam', [App\Http\Controllers\Exams\ExamBankController::class, 'edit'])->name('exam_bank.edit');
Route::get('exams/{question}/exam_view', [App\Http\Controllers\Exams\ExamBankController::class, 'show'])->name('exam_view.show');

Route::resource('create_course', App\Http\Controllers\Exams\CourseController::class);
Route::get('/exams/course_view', [App\Http\Controllers\Exams\CourseController::class, 'index'])->name('course_view');
Route::get('exams/create_course', [App\Http\Controllers\Exams\CourseController::class, 'create'])->name('create_course');
Route::post('/exams/create_course', [App\Http\Controllers\Exams\CourseController::class, 'store'])->name('store');
Route::delete('exams/{create_course}/create_course', [App\Http\Controllers\Exams\CourseController::class, 'destory'])->name('course.destory');
Route::get('exams/{create_course}/edit_course', [App\Http\Controllers\Exams\CourseController::class, 'edit'])->name('create_course.edit');
Route::get('exams/{create_course}/edit_course', [App\Http\Controllers\Exams\CourseController::class, 'update'])->name('create_course.update');



//crm//
Route::get('call_tracker/tracker_view', [App\Http\Controllers\CallTracker\TrackerController::class, 'index'])->name('tracker_view');
Route::resource('call_tracker', App\Http\Controllers\CallTracker\TrackerController::class);
Route::post('/call_tracker/create', [App\Http\Controllers\CallTracker\TrackerController::class, 'store'])->name('call_tracker.store');
Route::post('/call_tracker/{call_tracker}/create', [App\Http\Controllers\CallTracker\TrackerController::class, 'storeSub'])->name('call_tracker.storeSub');

Route::get('call_summary/summary', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'index'])->name('summaryview');
Route::resource('summary', App\Http\Controllers\CallSummary\CallSummaryController::class);
Route::post('/call_summary/create', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'store'])->name('summary.store');
Route::put('call_summary/create', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'create'])->name('summary.create');
Route::post('/call_summary/create', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'storeGap'])->name('summary.storeGap');


/** Uplaod Good and Bad Calls of the month */
Route::resource('upload', App\Http\Controllers\Upload\UploadCallController::class);
Route::get('call_saved/upload_calls', [App\Http\Controllers\Upload\UploadCallController::class, 'index'])->name('upload.index');
Route::post('call_saved/upload_calls', [App\Http\Controllers\Upload\UploadCallController::class, 'store'])->name('upload.store');
Route::get('call_saved/{upload}/upload_calls', [App\Http\Controllers\Upload\UploadCallController::class, 'show'])->name('upload.show');
Route::get('call_saved/{upload}/upload_calls', [App\Http\Controllers\Upload\UploadCallController::class, 'edit'])->name('upload.edit');
Route::delete('call_saved/{upload}/upload_calls', [App\Http\Controllers\Upload\UploadCallController::class, 'destory'])->name('upload.destory');


























/* agent Routes */
Route::get('agent/agent_action', [App\Http\Controllers\Agent\AgentActionController::class, 'index'])->name('agent_action');
Route::get('agent/agentdashboard', [App\Http\Controllers\Agent\AgentDashboardController::class, 'index'])->name('agentdashboard');
Route::get('agent/agent_results', [App\Http\Controllers\Agent\AgentResultsController::class, 'index'])->name('agent_results');
Route::get('agent/agent_alert_form', [App\Http\Controllers\Agent\AgentAlertFormController::class, 'index'])->name('agent_alert_form');
Route::get('agent_alert_form', [App\Http\Controllers\Agent\AgentAlertFormController::class, 'agent_alert_form']);
Route::post('agent/agent_alert_form', [App\Http\Controllers\Agent\AgentAlertFormController::class, 'agent_alert_form'])->name('agent_alert_form');
Route::get('agent/agent_view_results', [App\Http\Controllers\Agent\AgentViewResultsController::class, 'index'])->name('agent_view_results');


/* Alert form Routes */
Route::get('alert_forms/alert_forms_view', [App\Http\Controllers\AlertForm\AlertFormViewController::class, 'index'])->name('alert_forms_view');
Route::get('alert_forms/alert_view_full', [App\Http\Controllers\AlertForm\AlertViewFullController::class, 'index'])->name('alert_view_full');


/* Team Leader Routes */
Route::get('team_leader/agents_actions_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'index'])->name('agents_actions_result');
Route::get('team_leader/TeamleaderDashboard', [App\Http\Controllers\Leader\teamleaderdashboardController::class, 'index'])->name('TeamleaderDashboard');
Route::get('team_leader/Teamleader_action_results', [App\Http\Controllers\Leader\TeamLeaderActionResultsController::class, 'index'])->name('Teamleader_action_results');
Route::get('team_leader/tl_agent_alert_form', [App\Http\Controllers\Leader\TLAgentAlertFormController::class, 'index'])->name('tl_agent_alert_form');
Route::get('team_leader/teamleader_view_results', [App\Http\Controllers\Leader\TeamleaderViewResultsController::class, 'index'])->name('teamleader_view_results');


/* Quality Analyst Routes */
Route::get('quality_analyst/agent_mapping', [App\Http\Controllers\QualityAnalyst\AgentMappingController::class, 'index'])->name('agent_mapping');
Route::get('quality_analyst/qadashboard', [App\Http\Controllers\QualityAnalyst\QaDashboardController::class, 'index'])->name('qadashboard');
Route::post('quality_analyst/qa_agent_alert_form', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'qa_agent_alert_form'])->name('qa_agent_alert_form');
Route::get('qa_agent_alert_form', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'qa_agent_alert_form']);
Route::get('quality_analyst/qa_agent_alert_form', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'index'])->name('qa_agent_alert_form');












/* Report Routes */
Route::get('reports/reports', [App\Http\Controllers\Reports\ReportsController::class, 'index'])->name('reports');
Route::get('reports/fiber_reports', [App\Http\Controllers\Reports\FiberReportController::class, 'index'])->name('fiber_reports');
Route::get('reports/dth_report', [App\Http\Controllers\Reports\DthReportController::class, 'index'])->name('dth_report');
Route::get('reports/percentile_report', [App\Http\Controllers\Reports\PercentileReportController::class, 'index'])->name('percentile_report');
Route::get('reports/global_report', [App\Http\Controllers\Reports\GlobalReportController::class, 'index'])->name('global_report');
Route::get('reports/categories_report', [App\Http\Controllers\Reports\CategoriesReportController::class, 'index'])->name('categories_report');
Route::get('reports/auto_fail_report', [App\Http\Controllers\Reports\AutoFailReportController::class, 'index'])->name('auto_fail_report');
Route::get('reports/team_report', [App\Http\Controllers\Reports\TeamReportController::class, 'index'])->name('team_report');
Route::get('reports/outbound_percentile', [App\Http\Controllers\Reports\OutboundPercentileController::class, 'index'])->name('outbound_percentile');
Route::get('reports/servicesupport_percentile', [App\Http\Controllers\Reports\ServiceSupportPercentileController::class, 'index'])->name('servicesupport_percentile');
Route::get('reports/shop_percentile', [App\Http\Controllers\Reports\ShopPercentileController::class, 'index'])->name('shop_percentile');
Route::get('reports/productivity', [App\Http\Controllers\Reports\ShopPercentileController::class, 'index'])->name('produtivity');
Route::get('reports/Welcome_percentile', [App\Http\Controllers\Reports\WelcomePercentileController::class, 'index'])->name('Welcome_percentile');





/*Route::prefix('admin')->name('/admin/dashboard')->middleware(['auth:sanctum', 'verified', 'role: super-admin|admin|moderator|developer'])->group(function() {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('admins', AdminController::class)->parameters(['admins' => 'user'])->only(['index', 'update']);
    Route::resource('/admin/user', UserController::class)->except(['create', 'show', 'edit']);
    Route::resource('/admin/permissions', PermissionController::class)->except(['create', 'show', 'edit']);
    Route::resource('/admin/roles', RoleController::class)->except(['create', 'show', 'edit']);
});*/
