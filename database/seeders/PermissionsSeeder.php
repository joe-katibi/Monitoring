<?php

namespace database\seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [


            // Dashboard
            [
                'module' => 'Dashboard',
                'sub_module' => 'Quality Analyst Dashboard',
                'description' => 'View Dashboard for Quality Analyst',
                'name' => 'view-dashboard-quality-Analyst'
            ],
            [
                'module' => 'Dashboard',
                'sub_module' => 'Team leadder Dashboard',
                'description' => 'View Dashboard for Team leader',
                'name' => 'view-dasboard-team-leader'
            ],
            [
                'module' => 'Dashboard',
                'sub_module' => 'Trainer Dashboard',
                'description' => 'View Dashboard for Trainer',
                'name' => 'view-dasboard-trainer'
            ],
            [
                'module' => 'Dashboard',
                'sub_module' => 'Agent Dashboard',
                'description' => 'View Dashboard for Agent',
                'name' => 'view-dasboard-agent'
            ],
            //REPORTS
            [
                'module' => 'Reports',
                'sub_module' => 'all reports',
                'description' => 'View All Reports',
                'name' => 'view-reports-menu'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'global reports',
                'description' => 'View global Reports',
                'name' => 'view-global-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'global button reports',
                'description' => 'View global button Reports',
                'name' => 'view-global-button-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'service reports',
                'description' => 'View service Reports',
                'name' => 'view-service-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'service button reports',
                'description' => 'View service button Reports',
                'name' => 'view-service-button-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'productivity reports',
                'description' => 'View productivity Reports',
                'name' => 'view-productivity-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'productivity button reports',
                'description' => 'View productivity button Reports',
                'name' => 'view-productivity-button-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'percentile reports',
                'description' => 'View percentile Reports',
                'name' => 'view-percentile-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'percentile button reports',
                'description' => 'View percentile button Reports',
                'name' => 'view-percentile-button-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'autofail reports',
                'description' => 'View autofail Reports',
                'name' => 'view-autofail-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'autofail button reports',
                'description' => 'View autofail button Reports',
                'name' => 'view-autofail-button-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'category reports',
                'description' => 'View category Reports',
                'name' => 'view-category-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'category button reports',
                'description' => 'View category button Reports',
                'name' => 'view-category-button-reports'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'course reports',
                'description' => 'View course Reports',
                'name' => 'view-course-report'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'course button reports',
                'description' => 'View course button Reports',
                'name' => 'view-course-button-report'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'livecall reports',
                'description' => 'View livecall Reports',
                'name' => 'view-livecall-report'
            ],
            [
                'module' => 'Reports',
                'sub_module' => 'livecall button reports',
                'description' => 'View livecall button Reports',
                'name' => 'view-livecall-button-report'
            ],
            //Results
            [
                'module' => 'Results',
                'sub_module' => 'all results',
                'description' => 'View All results',
                'name' => 'view-results-menu'
            ],
            [
                'module' => 'Results',
                'sub_module' => 'audit results',
                'description' => 'View All results',
                'name' => 'view-results-audit-menu'
            ],
            [
                'module' => 'Results',
                'sub_module' => 'audit button results',
                'description' => 'View All button results',
                'name' => 'view-results-audit-button'
            ],
            [
                'module' => 'Results',
                'sub_module' => 'audit edit results',
                'description' => 'View All edit results',
                'name' => 'view-results-audit-edit'
            ],
            [
                'module' => 'Results',
                'sub_module' => 'audit delete results',
                'description' => 'View All delete results',
                'name' => 'view-results-audit-delete'
            ],
            [
                'module' => 'Results',
                'sub_module' => 'exam results',
                'description' => 'View All results',
                'name' => 'view-results-exam-menu'
            ],
            [
                'module' => 'Results',
                'sub_module' => 'exam button results',
                'description' => 'View All button results',
                'name' => 'view-results-exam-button-menu'
            ],
            [
                'module' => 'Results',
                'sub_module' => 'Auto Fails results',
                'description' => 'View All results',
                'name' => 'view-results-autofail-menu'
            ],
            [
                'module' => 'Results',
                'sub_module' => 'Auto Fails button results',
                'description' => 'View All button results',
                'name' => 'view-results-autofail-button'
            ],
            [
                'module' => 'Results',
                'sub_module' => 'Auto Fails view results',
                'description' => 'View All view results',
                'name' => 'view-results-autofail-button-view'
            ],

            //Users

            [
                'module' => 'Users',
                'sub_module' => 'all Users',
                'description' => 'View Users',
                'name' => 'view-users-menu'
            ],
            [
                'module' => 'Users',
                'sub_module' => 'Roles',
                'description' => 'View Roles',
                'name' => 'view-roles-menu'
            ],
            [
                'module' => 'Users',
                'sub_module' => 'create Roles',
                'description' => 'Create button Roles',
                'name' => 'view-create-roles'
            ],
            [
                'module' => 'Users',
                'sub_module' => 'edit Roles and permission',
                'description' => 'edit Roles and permission button Roles',
                'name' => 'view-edit-roles-permission'
            ],
            [
                'module' => 'Users',
                'sub_module' => 'Permissions',
                'description' => 'View Permissions',
                'name' => 'view-permissions-menu'
            ],
            [
                'module' => 'Users',
                'sub_module' => 'Departments',
                'description' => 'View Departments',
                'name' => 'view-departments-menu'
            ],
            [
                'module' => 'Users',
                'sub_module' => 'Add Departments',
                'description' => 'add new Departments',
                'name' => 'view-add-departments'
            ],
            [
                'module' => 'Users',
                'sub_module' => 'edit delete Departments',
                'description' => 'edit delete Departments',
                'name' => 'view-edit-delete-departments'
            ],
            [
                'module' => 'Users',
                'sub_module' => 'add user or create',
                'description' => 'button to create user',
                'name' => 'view-create-user-button'
            ],
            [
                'module' => 'Users',
                'sub_module' => 'edit and user status',
                'description' => 'edit and user status button',
                'name' => 'view-edit-user-status'
            ],
            //Audits
            [
                'module' => 'Audits',
                'sub_module' => 'Quality Audits',
                'description' => 'Audit Agents',
                'name' => 'view-audit-menu'
            ],
            [
                'module' => 'Audits',
                'sub_module' => 'Fiber Category',
                'description' => 'View audit Fiber Category',
                'name' => 'view-audit-fiber-categories'
            ],
            [
                'module' => 'Audits',
                'sub_module' => 'DTH Category',
                'description' => 'View audit DTH Category',
                'name' => 'view-audit-dth-categories'
            ],

            //Call trackers ---CRM
            [
                'module' => 'Call Trackers',
                'sub_module' => 'Trackers menu',
                'description' => 'View Trackers',
                'name' => 'view-trackers-menu'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'create Trackers',
                'description' => 'button for creating a tracker',
                'name' => 'view-button-create-tracker'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'create Trackers actions',
                'description' => 'button for editing view and delete',
                'name' => 'view-button-edit-delete-view-tracker'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'Trackers add category',
                'description' => 'Trackers add category',
                'name' => 'view-add-category-tracker'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'Trackers add Button category',
                'description' => 'Trackers add Button category',
                'name' => 'view-add-category-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'Trackers Save category',
                'description' => 'Trackers Save category',
                'name' => 'view-save-category-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'Create trackers',
                'description' => 'Create edit Trackers',
                'name' => 'view-tracker-sub-menu'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'General issues submit',
                'description' => 'General issues submit button',
                'name' => 'view-general-submit-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'General issues add Category button',
                'description' => 'General issues add Category button',
                'name' => 'view-general-add-category-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'General issues action button',
                'description' => 'General issues action button',
                'name' => 'view-general-action-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'General issues save subcategory button',
                'description' => 'General issues save subcategory button',
                'name' => 'view-general-save-category-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'General issues ',
                'description' => 'Create General issues',
                'name' => 'view-general-menu'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'Strength Summary ',
                'description' => 'Create Strength Summary',
                'name' => 'view-strength-menu'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'VOC Summary ',
                'description' => 'Create VOC Summary',
                'name' => 'view-voc-menu'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'VOC Summary button',
                'description' => 'VOC Summary button',
                'name' => 'view-voc-summary-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'strength Summary button',
                'description' => 'strength Summary button',
                'name' => 'view-strenght-summary-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'Gap Summary button',
                'description' => 'Gap Summary button',
                'name' => 'view-gap-summary-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'save strength Summary button',
                'description' => 'save strength Summary button',
                'name' => 'view-save-strength-summary-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'save VOC Summary button',
                'description' => 'save VOC Summary button',
                'name' => 'view-save-voc-summary-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'save GAP Summary button',
                'description' => 'save GAP Summary button',
                'name' => 'view-save-gap-summary-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'save edit Summary button',
                'description' => 'save edit Summary button',
                'name' => 'view-saving-done-exam-button'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'edit gap Summary button',
                'description' => 'edit gap Summary button',
                'name' => 'view-gap-edit-delete-action'
            ],
            [
                'module' => 'Call Trackers',
                'sub_module' => 'edit voc Summary button',
                'description' => 'edit voc Summary button',
                'name' => 'view-voc-edit-delete-action'
            ],

            [
                'module' => 'Call Trackers',
                'sub_module' => 'edit strength Summary button',
                'description' => 'edit strength Summary button',
                'name' => 'view-strength-edit-delete-action'
            ],

            [
                'module' => 'Call Trackers',
                'sub_module' => 'view edit summary button',
                'description' => 'view edit summary button',
                'name' => 'view-edit-summary-button'
            ],


            //Examination
            [
                'module' => 'Examination',
                'sub_module' => 'Question bank',
                'description' => 'Create Questions',
                'name' => 'view-question-bank-menu'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'Create Question',
                'description' => 'Create Questions button for page view',
                'name' => 'view-create-question-page'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'Question Action Buttons',
                'description' => 'Action Buttons view',
                'name' => 'view-edit-view-delete-button-question'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'Create Questions button',
                'description' => 'Create Questions button',
                'name' => 'view-create-question-button'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'Question edit Buttons',
                'description' => 'edit question Buttons ',
                'name' => 'view-edit-question-button'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'button for new Conduct Exam',
                'description' => 'button to open a new schedule exam',
                'name' => 'view-new-conduct-page-button'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'button for edit view delete Conduct Exam',
                'description' => 'button for edit view delete Conduct Exam',
                'name' => 'view-edit-view-delete-conduct--button'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'button for scheduling Conduct Exam',
                'description' => 'button for scheduling Conduct Exam',
                'name' => 'view-scheduling-exam-button'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'button for saving exams',
                'description' => 'button for saving exams',
                'name' => 'view-saving-done-exam-buttons'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'Conduct Exam',
                'description' => 'Schedule Examination',
                'name' => 'view-conduct-menu'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'edit Conduct Exam',
                'description' => 'edit Scheduled Examination',
                'name' => 'view-edit-conduct-menu'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'Course',
                'description' => 'Create courses for questions',
                'name' => 'view-course-menu'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'create Course',
                'description' => 'Button for Creating Courses',
                'name' => 'view-create-course-button'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'edit Course',
                'description' => 'Button for editing Courses',
                'name' => 'view-edit-course-button'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'edit -delete Course',
                'description' => 'Button for edit or delete Courses',
                'name' => 'view-edit-delete-course-button'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'submit Course',
                'description' => 'Button for submiting Courses',
                'name' => 'view-submit-course-button'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'Agent Examination',
                'description' => 'View for agents to perform Exams',
                'name' => 'view-agent-exam-menu'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'start and Results exam button',
                'description' => 'Buttons for Start and Results Exam',
                'name' => 'view-start-results-exam-buttons'
            ],
            [
                'module' => 'Examination',
                'sub_module' => 'View Question answered with their selected answeres',
                'description' => 'Buttons for view results with question and answers for only supervisors/trainer and Quality Analyst',
                'name' => 'view-exam-results-question-with-answers'
            ],
            // Upload Calls either Good or Bad
            [
                'module' => 'Upload Calls',
                'sub_module' => 'Upload Calls',
                'description' => 'View for Good and bad Calls',
                'name' => 'view-upload-calls-menu'
            ],
            [
                'module' => 'Upload Calls',
                'sub_module' => 'Upload button',
                'description' => 'Button for uploading good or bad calls',
                'name' => 'view-upload-call-button'
            ],
            //Mapping of Agents
            [
                'module' => 'Mapping Agents',
                'sub_module' => 'All Mapping Agents',
                'description' => 'View for Mapping Agents',
                'name' => 'view-Mapping-menu'
            ],

            //View parametors
            [
                'module' => 'Parametor',
                'sub_module' => 'Edit Parameters',
                'description' => 'Create Edit delete Parameters',
                'name' => 'view-parameter-menu'
            ],
            [
                'module' => 'Parametor',
                'sub_module' => 'Create Parametor',
                'description' => 'View create parametor page',
                'name' => 'view-create-parametor'
            ],
            [
                'module' => 'Parametor',
                'sub_module' => 'Edit Parametor',
                'description' => 'edit paratmetor button',
                'name' => 'view-edit-parametor'
            ],
            [
                'module' => 'Parametor',
                'sub_module' => 'delete Parametor',
                'description' => 'delete paratmetor button',
                'name' => 'view-delete-parametor'
            ],
            [
                'module' => 'Parametor',
                'sub_module' => 'btn create Parametor',
                'description' => 'button for creating parameter',
                'name' => 'view-btn-create-parameters'
            ],
            [
                'module' => 'Parametor',
                'sub_module' => 'btn edit Parametor',
                'description' => 'button for editing parameter',
                'name' => 'view-btn-edit-parameters'
            ],
                //Coaching Form pdf
            [
                    'module' => 'Coaching Form PDF ',
                    'sub_module' => 'Coaching Export PDF',
                    'description' => 'Button for exporting Sign PDF Coaching form',
                    'name' => 'view-export-PDF-coaching-button'
            ],

                  //Alert Form pdf
            [
                    'module' => 'Alert Form PDF',
                    'sub_module' => 'Alert Export PDF',
                    'description' => 'Button for Exporting signed Alert PDF form',
                    'name' => 'view-export-PDF-alert-button'
            ],
                  //Alert form-report supervisor request
            [
                    'module' => 'Audit Supervisor Report',
                    'sub_module' => 'Audit Supervisor Report',
                    'description' => 'Supervisor to pull audit report',
                    'name' => 'supervisor-report-request'
            ],

                  //Alert form-report agent request
            [
                    'module' => 'Audit Agent Report',
                    'sub_module' => 'Audit Agent Report',
                    'description' => 'Agent to pull audit report',
                    'name' => 'agent-report-request'
            ],
                //Alert form-report Quality request
            [
                    'module' => 'Audit Quality Analysts Report',
                    'sub_module' => 'Audit Quality Analysts  Report',
                    'description' => 'Quality Analysts  to pull audit report',
                    'name' => 'quality-analysts-report-request'
            ],
                       //Exam -results agent request
            [
                    'module' => 'Exam Agent Results',
                    'sub_module' => 'Exam Agent Results',
                    'description' => 'Agent to pull exam Results',
                    'name' => 'admin-agent-exam-results'
            ],
                //Exam-results Supervisor- Quality  request
            [
                    'module' => 'Exam Admin Supervisor Quality Analysts results',
                    'sub_module' => 'Admin Supervisor and Quality Analysts  Exam Results',
                    'description' => ' supervisor and Quality Analysts  to pull exam Results',
                    'name' => 'admin-supervisor-quality-exam-results'
            ],




        ];
        foreach ($permissions as $permission) {
            $permission = array_merge($permission, ['guard_name' => config('auth.defaults.guard')]);
            try {
                /** @var Permission $created_permission */
                $created_permission = Permission::findByName($permission['name'], $permission['guard_name']);
                $created_permission->description = $permission['description'];
                $created_permission->module = $permission['module'];
                $created_permission->sub_module = $permission['sub_module'];

                $created_permission->save();
            } catch (PermissionDoesNotExist $e) {
                Permission::insert($permission);
            }
        }
    }
}
