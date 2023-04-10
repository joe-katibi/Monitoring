<?php

use App\Models\User;
use App\Models\Courses;
use App\Models\AlertForm;
use App\Models\Categories;
use App\Models\FiberWelcomeQuestion;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::group(['middleware' => ['role:super-admin|admin']], function () {



//     Route::get('/admin/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
//     Route::get('/admin/permissions', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions');
//     Route::get('/admin/roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role');
//     Route::get('/admin/roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles');
//     Route::post('/admin/roles', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('store');
//     Route::get('/admin/usermanagement', [App\Http\Controllers\Admin\UserManagementController::class, 'index'])->name('usermanagement');
//     Route::resource('roles', RoleController::class);
//     Route::resource('permission', PermissionController::class);
//     Route::resource('users', UserController::class);
//     Route::delete('roles/{role}/roles',[RolesController::class,'roles.edit'])->name('roles.edit');
//     Route::delete('roles/{role}/edit',[RolesController::class,'roles.edit'])->name('roles.edit');
//     Route::post('/roles/create', [App\Http\Controllers\admin\RoleController::class, 'store'])->name('roles.store');
//     Route::get('/admin/role/edit', [App\Http\Controllers\admin\RoleController::class, 'edit'])->name('edit');
//     Route::get('roles/{role}/roles',[App\Http\Controllers\admin\RoleController::class,'edit'])->name('roles.update');
//     Route::put('users/{role}/users',[App\Http\Controllers\admin\UserController::class,'edit'])->name('users.update');
//     Route::delete('roles/{role}',[RoleController::class,'removeRole'])->name('users.roles.remove');
//     Route::get('/admin/Users/edit', [App\Http\Controllers\admin\UserController::class, 'edit'])->name('edit');
//     Route::get('/admin/Users/create', [App\Http\Controllers\admin\UserController::class, 'update'])->name('update');
//     Route::get('/admin/Users/{user}/view', [App\Http\Controllers\admin\UserController::class, 'show'])->name('show');
//     Route::post('/users/create', [App\Http\Controllers\admin\UserController::class, 'store'])->name('store');
//     Route::post('roles/{role}/permissions',[App\Http\Controllers\admin\RoleController::class,'givePermission'])->name('roles.permissions');
//     Route::delete('roles/{role}/permissions/{permission}',[App\Http\Controllers\admin\RoleController::class,'revokePermission'])->name('roles.permissions.revoke');
//     Route::delete('/users/{user}/roles/{role}', [App\Http\Controllers\admin\UserController::class, 'removeRole'])->name('roles.remove');
//     Route::post('/users/{user}/roles', [App\Http\Controllers\admin\UserController::class, 'assignRole'])->name('users.roles');
//     Route::get('/users/{user}/user', [App\Http\Controllers\admin\UserController::class, 'destroy'])->name('users.destroy');
//     Route::delete('roles/{role}/role',[App\Http\Controllers\admin\RoleController::class,'destroy'])->name('roles.destroy');
//     Route::get('admin/permission/create', [App\Http\Controllers\admin\PermissionController::class, 'create'])->name('permission.create');
//     Route::get('/admin/permission/edit', [App\Http\Controllers\admin\PermissionController::class, 'update'])->name('permission.update');
//     Route::delete('permission/{role}',[App\Http\Controllers\admin\PermissionController::class,'destroy'])->name('permission.destroy');



//     // Route::post('roles/{role}/permissions',[RolesController::class,'givePermission'])->name('roles.permissions');
//     // Route::delete('roles/{role}/permissions/{permission}',[RolesController::class,'revokePermission'])->name('roles.permissions.revoke');


//     // Route::delete('users/{user}',[UserController::class,'destroy'])->name('users.destroy');
//     // Route::get('users/{user}',[UserController::class,'show'])->name('users.show');
//     // Route::post('roles/{role}/roles',[UserController::class,'assignRole'])->name('users.destory');
//     // Route::delete('roles/{role}',[UserController::class,'removeRole'])->name('users.roles.remove');
//     // Route::post('roles/{role}/permissions',[UserController::class,'givePermission'])->name('users.permissions');
//     // Route::delete('roles/{role}/permissions/{permission}',[UserController::class,'revokePermission'])->name('users.permissions.revoke');
//     //Route::get('results/billing/billing_results', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'index'])->name('result');

});

// settiing --- roles -- permissions---deartments//
Route::prefix('settings')->group(function () {

    //users
    Route::get('users', [UserController::class, 'index'])->name('settings.users');
    Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('settings.create');
    Route::post('users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('settings.store');
    Route::get('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('settings.users.show');
    Route::put('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('settings.users.update');
    Route::get('users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('settings.users.edit');
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
});

// Route::prefix('Quality Analysts')->group(function () {

//     Route::get('quality_analyst/Welcometeamcategory', [App\Http\Controllers\QualityAnalyst\WelcomeCategoryController::class, 'index'])->name('welcometeamcategory');




// });


/* Create parameters and Edit */
Route::resource('parametor', fiberWelcomeEditController::class);
Route::post('admin/edit_parametors/Fiber/{parametors}/edit', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'edit'])->name('parametor.edit');
Route::get('admin/edit_parametors/Fiber/{parametors}/edit', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'edit'])->name('parametor.edit');
Route::post('admin/edit_parametors/Fiber/{parametors}/update', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'update'])->name('parametor.update');
Route::get('admin/edit_parametors/Fiber/welcomequestion', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'create'])->name('create_parametor');
Route::post('admin/edit_parametors/Fiber/welcomequestionedit', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'store'])->name('parametor.store');
Route::get('admin/edit_parametors/Fiber/welcomequestionedit', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'index'])->name('welcomequestionedit');
Route::delete('admin/edit_parametors/Fiber/welcomequestionedit/{parametors}', [App\Http\Controllers\FiberQuestions\fiberWelcomeEditController::class, 'destroy'])->name('parametor.destroy');


Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

/* QA Category and Results Routes */
Route::get('quality_analyst/category', [App\Http\Controllers\QualityAnalyst\CategoryController::class, 'index'])->name('category');

Route::resource('billing', BillingCategoryController::class);
Route::get('quality_analyst/{billing}/billingteamcategory', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'index'])->name('billingteamcategory');
Route::post('quality_analyst/billingteamcategory', [App\Http\Controllers\QualityAnalyst\BillingCategoryController::class, 'store'])->name('billing.store');
Route::get('results/billing/billing_results/{billing}', [App\Http\Controllers\Results\billing\BillingResultsController::class, 'index'])->name('billing_results');
Route::get('results/billing/billing_edit/{billing}', [App\Http\Controllers\Results\billing\BillingResultsController::class, 'edit'])->name('billing_edit');


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


// Route::get('categorylivesupervisor/{id}', function ($id) {
//     $supervisorName = App\Models\user::where('category',$id)->where('position', '=', 'Supervisor')->get();
//     return response()->json($supervisorName);
// });

// Route::get('categoryliveagent/{id}', function ($id) {
//     $supervisorName = App\Models\user::where('category',$id)->where('position', '=', 'Agent')->get();
//     return response()->json($supervisorName);
// });

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
Route::get('exams/{conductexam}/edit_conduct',[App\Http\Controllers\Exams\ConductExamController::class,'update'])->name('conductexam.update');
Route::delete('exams/{conductexam}/view_conduct',[App\Http\Controllers\Exams\ConductExamController::class,'destroy'])->name('conductexam.destroy');
Route::post('exams/schedule_exam',[App\Http\Controllers\Exams\ConductExamController::class,'store'])->name('conductexam.store');

Route::resource('examination',ExaminationController::class);
Route::get('exams/{examination}/examination',[App\Http\Controllers\Exams\ExaminationController::class,'index'])->name('examination.index');
Route::post('exams/examination',[App\Http\Controllers\Exams\ExaminationController::class,'store'])->name('examination.store');
Route::get('exams/agent_examination',[App\Http\Controllers\Exams\ExaminationController::class,'show'])->name('examination.show');


Route::resource('examresult',ExamsResultsController::class);
Route::get('exams/exam_result',[App\Http\Controllers\Exams\ExamsResultsController::class, 'index'])->name('examresult.index');
Route::get('/exams/view_exam_results/{examresult}',[App\Http\Controllers\Exams\ExamsResultsController::class, 'show'])->name('examresult.show');
Route::post('exams/exam_result',[App\Http\Controllers\Exams\ExamsResultsController::class, 'store'])->name('examresult.store');

Route::resource('exambank',ExamBankController::class);
Route::get('exams/exam_bank',[App\Http\Controllers\Exams\ExamBankController::class, 'index'])->name('exam_bank');
Route::get('exams/{exambank}/exam_bank',[App\Http\Controllers\Exams\ExamBankController::class, 'destroy'])->name('exambank.destroy');
Route::post('/exams/create_exam',[App\Http\Controllers\Exams\ExamBankController::class, 'store'])->name('store');
Route::get('/exams/create_exam',[App\Http\Controllers\Exams\ExamBankController::class, 'create'])->name('exambank.store');
Route::get('exams/edit_exam',[App\Http\Controllers\Exams\ExamBankController::class, 'edit'])->name('exam_bank.edit');
Route::get('exams/{question}/exam_view',[App\Http\Controllers\Exams\ExamBankController::class, 'show'])->name('exam_view.show');
Route::get('/exams/create_exam',[App\Http\Controllers\Exams\ExamBankController::class, 'choicestore'])->name('exambank.choicestore');

Route::resource('create_course',CourseController::class);
Route::get('/exams/course_view',[App\Http\Controllers\Exams\CourseController::class, 'index'])->name('course_view');
Route::get('exams/create_course',[App\Http\Controllers\Exams\CourseController::class, 'create'])->name('create_course');
Route::post('/exams/create_course',[App\Http\Controllers\Exams\CourseController::class, 'store'])->name('store');
Route::delete('exams/{create_course}/create_course',[App\Http\Controllers\Exams\CourseController::class, 'destory'])->name('course.destory');
Route::get('exams/{create_course}/edit_course',[App\Http\Controllers\Exams\CourseController::class, 'edit'])->name('create_course.edit');
Route::get('exams/{create_course}/edit_course',[App\Http\Controllers\Exams\CourseController::class, 'update'])->name('create_course.update');



//crm//
Route::get('call_tracker/tracker_view', [App\Http\Controllers\CallTracker\TrackerController::class, 'index'])->name('tracker_view');
Route::resource('call_tracker', TrackerController::class);
Route::post('/call_tracker/create', [App\Http\Controllers\CallTracker\TrackerController::class, 'store'])->name('call_tracker.store');
Route::get('/call_tracker/{call_tracker}/edit_tracker', [App\Http\Controllers\CallTracker\TrackerController::class, 'edit'])->name('call_tracker.edit');
Route::get('/call_tracker/{call_tracker}/show_tracker', [App\Http\Controllers\CallTracker\TrackerController::class, 'show'])->name('call_tracker.show');
Route::get('call_tracker/{call_tracker}/create', [App\Http\Controllers\CallTracker\TrackerController::class, 'store_sub'])->name('store_sub');
Route::post('call_tracker/{call_tracker}/create', [App\Http\Controllers\CallTracker\TrackerController::class, 'store_sub'])->name('store_sub');
Route::post('/call_tracker/{call_tracker}/create', [App\Http\Controllers\CallTracker\TrackerController::class, 'destroy'])->name('call_tracker.destroy');

Route::get('calltracker/{id}', function ($id) {
    $SubCallTracker = App\Models\SubCallTracker::where('call_tracker_id',$id)->get();
    return response()->json($SubCallTracker);
});

Route::get('call_summary/summary', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'index'])->name('summaryview');
Route::resource('summary', CallSummaryController::class);
Route::post('/call_summary/create', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'store'])->name('summary.store');
Route::put('call_summary/create', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'create'])->name('summary.create');
Route::post('/call_summary/create', [App\Http\Controllers\CallSummary\CallSummaryController::class, 'storeGap'])->name('summary.storeGap');

Route::resource('general', App\Http\Controllers\General\GeneralIssueController::class);
Route::get('general_issue/general_view', [App\Http\Controllers\General\GeneralIssueController::class, 'index'])->name('general.index');
Route::post('general_issue/general_view', [App\Http\Controllers\General\GeneralIssueController::class, 'store'])->name('general.store');
Route::post('general_issue/{general}/general_view', [App\Http\Controllers\General\GeneralIssueController::class, 'storeGen'])->name('general.storeGen');
Route::get('general_issue/{general}/general_edit', [App\Http\Controllers\General\GeneralIssueController::class, 'edit'])->name('general.edit');
Route::get('general_issue/{general}/general_show', [App\Http\Controllers\General\GeneralIssueController::class, 'show'])->name('general.show');
Route::delete('general_issue/{general}/general_show', [App\Http\Controllers\General\GeneralIssueController::class, 'destroy'])->name('general.destroy');

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
//Route::get('/alert_forms/alert_forms_view', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'alertformsview'])->name('autofail.alertformsview');
//Route::get('/alert_forms/alert_forms_view', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'searchAutofail'])->name('autofail.searchAutofail');
Route::get('alert_forms/alert_view_full/{id}', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'show'])->name('autofail.show');
Route::get('/quality_analyst/qa_agent_alert_form/{id}', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'index'])->name('qa_agent_alert_form');
Route::post('/quality_analyst/qa_agent_alert_form/', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'store'])->name('autofail.store');
Route::get('team_leader/tl_agent_alert_form/{id}', [App\Http\Controllers\AlertForm\QaAlertFormController::class, 'edit'])->name('autofail.edit');

// Route::get('category/{id}', function ($id) {
//     $AgentName = App\Models\user::where('category',$id)->where('position', '=', 'Agent')->get();
//     return response()->json($AgentName);
// })->name('category_agent');


Route::get('category/{id}', function ($id) {
    $AgentName = App\Models\Role::join('model_has_roles','model_has_roles.role_id','=','roles.id')
                                       ->join('users','users.id','=','model_has_roles.model_id')
                                        ->join('user_categories','user_categories.user_id','=','model_has_roles.model_id')
                                       ->where('user_categories.category_id','=',$id)
                                       ->where('roles.name', '=', 'Agent')
                                     ->get();
    return response()->json($AgentName);
})->name('category_agent');




    /* agent Routes */
    Route::get('agent/agent_action', [App\Http\Controllers\Agent\AgentActionController::class, 'index'])->name('agent_action');
    Route::get('agent/agentdashboard', [App\Http\Controllers\Agent\AgentDashboardController::class, 'index'])->name('agentdashboard');
    Route::get('agent/agent_results', [App\Http\Controllers\Agent\AgentResultsController::class, 'index'])->name('agent_results');
    Route::get('agent/agent_alert_form', [App\Http\Controllers\Agent\AgentAlertFormController::class, 'index'])->name('agent_alert_form');
    Route::get('agent_alert_form', [App\Http\Controllers\Agent\AgentAlertFormController::class, 'agent_alert_form']);
    Route::post('agent/agent_alert_form', [App\Http\Controllers\Agent\AgentAlertFormController::class, 'agent_alert_form'])->name('agent_alert_form');
    Route::get('agent/agent_view_results', [App\Http\Controllers\Agent\AgentViewResultsController::class, 'index'])->name('agent_view_results');

/* Result view */

Route::get('results/result_view', [App\Http\Controllers\Results\Result\ResultController::class, 'index'])->name('results/result_view');

Route::resource('final_show_view', App\Http\Controllers\AlertForm\AlertResultsController::class);
Route::get('/alert_forms/alert_forms_view', [App\Http\Controllers\AlertForm\AlertResultsController::class, 'index'])->name('final_show_view.index');
Route::get('/alert_forms/alert_forms_view', [App\Http\Controllers\AlertForm\AlertResultsController::class, 'show'])->name('final_show_view.show');



/* Team Leader Routes */
Route::resource('qaresults',agentActionResultsController::class);
Route::get('team_leader/{qaresults}/Teamleader_action_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'edit'])->name('qaresults.edit');
Route::get('team_leader/agents_actions_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'index'])->name('qaresults.index');
Route::get('team_leader/{qaresults}/teamleader_view_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'show'])->name('qaresults.show');
Route::get('team_leader/agents_actions_results', [App\Http\Controllers\Leader\agentActionResultsController::class, 'search'])->name('qaresults.search');



Route::get('team_leader/TeamleaderDashboard', [App\Http\Controllers\Leader\teamleaderdashboardController::class, 'index'])->name('TeamleaderDashboard');
Route::get('team_leader/Teamleader_action_results', [App\Http\Controllers\Leader\TeamLeaderActionResultsController::class, 'index'])->name('Teamleader_action_results');




/* Quality Analyst Routes */
Route::get('quality_analyst/agent_mapping', [App\Http\Controllers\QualityAnalyst\AgentMappingController::class, 'index'])->name('agent_mapping');
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


/*Route::prefix('admin')->name('/admin/dashboard')->middleware(['auth:sanctum', 'verified', 'role: super-admin|admin|moderator|developer'])->group(function() {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('admins', AdminController::class)->parameters(['admins' => 'user'])->only(['index', 'update']);
    Route::resource('/admin/user', UserController::class)->except(['create', 'show', 'edit']);
    Route::resource('/admin/permissions', PermissionController::class)->except(['create', 'show', 'edit']);
    Route::resource('/admin/roles', RoleController::class)->except(['create', 'show', 'edit']);
});*/
