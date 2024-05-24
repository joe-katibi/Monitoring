<?php
namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
/** @package Database\Seeders */
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super-admin
        try {
            $role = Role::create(['name' => 'super-admin', 'description' => 'Super Admin']);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {
            // Ignore
        }
        $role = Role::findByName('super-admin');
        $role->givePermissionTo(Permission::all());


         // admin
         try {
            $roleAdmin = Role::create(['name' => 'Admin', 'description' => 'Admin']);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {
            // Ignore
        }
        $roleAdmin= Role::findByName('Admin');
          // Find or create specific permissions
          $permissions = ['view-add-departments','view-create-user-button','view-create-roles','view-edit-user-status','view-edit-delete-departments','view-edit-roles-permission','view-departments-menu','view-permissions-menu','view-roles-menu','view-users-menu','view-edit-summary-button'];
          foreach ($permissions as $permissionName) {
          $permission = Permission::where('name', $permissionName)->first();

          // Assign the permission to the role
          $roleAdmin->givePermissionTo($permission);
           }

         // quality-analyst
         try {
            $roleQualityAnalyst = Role::create(['name' => 'quality-analyst', 'description' => 'Quality Analyst']);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {
            // Ignore
        }
        $roleQualityAnalyst = Role::findByName('quality-analyst');
         // Find or create specific permissions
         $permissions = ['view-dashboard-quality-Analyst','view-reports-menu','view-results-menu','view-audit-menu','view-upload-calls-menu','view-audit-fiber-categories','view-audit-dth-categories','view-global-reports','view-service-reports','view-productivity-reports','view-percentile-reports','view-autofail-reports','view-category-reports','view-course-report','view-livecall-report','	view-global-button-reports','view-service-button-reports','view-productivity-button-reports','view-percentile-button-reports','view-autofail-button-reports','view-category-button-reports','view-course-button-report','view-livecall-button-report','view-results-audit-menu','view-results-exam-menu','view-results-autofail-menu','view-results-audit-button-menu','view-results-exam-button-menu','view-results-autofail-button-menu','view-results-audit-button','view-results-audit-edit','view-results-audit-delete','view-results-autofail-button','view-results-autofail-button-view','view-upload-call-button','view-exam-results-question-with-answers','view-export-PDF-coaching-button','view-export-PDF-alert-button','quality-analysts-report-request','admin-supervisor-quality-exam-results'];
         foreach ($permissions as $permissionName) {
          $permission = Permission::where('name', $permissionName)->first();

          // Assign the permission to the role
          $roleQualityAnalyst->givePermissionTo($permission);
         }

         // Agent
         try {
            $roleAgent = Role::create(['name' => 'Agent', 'description' => 'Agent']);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {
            // Ignore
        }
        $roleAgent = Role::findByName('Agent');
        // Find or create specific permissions
          $permissions = ['view-dasboard-agent','view-results-menu','view-agent-exam-menu','view-results-audit-menu','view-results-exam-menu','view-results-autofail-menu','view-results-audit-button-menu','view-results-exam-button-menu','view-results-autofail-button-menu','view-results-audit-button','view-results-audit-edit','view-results-audit-delete','view-results-autofail-button','view-results-autofail-button-view','view-start-results-exam-buttons','view-saving-done-exam-button','agent-report-autofail-request','agent-report-request','admin-agent-exam-results'];
          foreach ($permissions as $permissionName) {
          $permission = Permission::where('name', $permissionName)->first();
         // Assign the permission to the role
         $roleAgent->givePermissionTo($permission);
         }

         // team-leader
         try {
            $roleTeamleader = Role::create(['name' => 'Team-leader', 'description' => 'Team-leader']);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {
            // Ignore
        }
        $roleTeamleader = Role::findByName('Team-leader');
         // Find or create specific permissions
         $permissions = ['view-dasboard-team-leader','view-reports-menu','view-results-menu','view-global-reports','view-service-reports','view-productivity-reports','view-percentile-reports','view-autofail-reports','view-category-reports','view-course-report','view-livecall-report','view-global-button-reports','view-service-button-reports','view-productivity-button-reports','view-percentile-button-reports','view-autofail-button-reports','view-category-button-reports','view-course-button-report','view-livecall-button-report','view-results-audit-menu','view-results-exam-menu','view-results-autofail-menu','view-results-audit-button-menu','view-results-exam-button-menu','view-results-autofail-button-menu','view-results-audit-button','view-results-audit-edit','view-results-audit-delete','view-results-autofail-button','view-results-autofail-button-view','view-export-PDF-coaching-button','view-export-PDF-alert-button','supervisor-report-autofail-request','supervisor-report-request','admin-supervisor-quality-exam-results','supervisor-report-request'];
         foreach ($permissions as $permissionName) {
         $permission = Permission::where('name', $permissionName)->first();

            // Assign the permission to the role
            $roleTeamleader->givePermissionTo($permission);
          }


         // trainer
         try {
            $roleTrainer = Role::create(['name' => 'Trainer', 'description' => 'Trainer']);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {
            // Ignore
        }
        $roleTrainer = Role::findByName('Trainer');
          // Find or create specific permissions
          $permissions = ['view-dasboard-trainer','view-reports-menu','view-results-menu','view-question-bank-menu','view-conduct-menu','view-course-menu','view-global-reports','view-service-reports','view-productivity-reports','view-percentile-reports','view-autofail-reports','view-category-reports','view-course-report','view-livecall-report','view-global-button-reports','view-service-button-reports','view-productivity-button-reports','view-percentile-button-reports','view-autofail-button-reports','view-category-button-reports','view-course-button-report','view-livecall-button-report','view-results-audit-menu','view-results-exam-menu','view-results-autofail-menu','view-results-audit-button-menu','view-results-exam-button-menu','view-results-autofail-button-menu','view-results-audit-button','view-results-audit-edit','view-results-audit-delete','view-results-autofail-button','view-results-autofail-button-view','view-create-course-button','view-edit-delete-course-button','view-new-conduct-page-button','view-edit-view-delete-conduct--button','view-submit-course-button','view-scheduling-exam-button','view-edit-course-button','view-edit-conduct-menu','view-create-question-page','view-edit-view-delete-button-question','view-edit-question-button','view-create-question-button','view-exam-results-question-with-answers','view-export-PDF-coaching-button','view-export-PDF-alert-button','trainer-report-request'];
          foreach ($permissions as $permissionName) {
          $permission = Permission::where('name', $permissionName)->first();

             // Assign the permission to the role
             $roleTrainer->givePermissionTo($permission);
           }


         // Quality-Analyst- WGKL
         try {
            $roleQualityAnalystWgkl = Role::create(['name' => 'Quality-Analyst- WGKL', 'description' => 'Quality Analyst WGKL Staff Only']);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {
            // Ignore
        }
        $roleQualityAnalystWgkl = Role::findByName('Quality-Analyst- WGKL');
             // Find or create specific permissions
             $permissions = ['view-dashboard-quality-Analyst', 'view-reports-menu','view-results-menu','view-audit-menu','view-parameter-menu','view-trackers-menu','view-tracker-sub-menu','view-general-menu','view-strength-menu','view-voc-menu','view-question-bank-menu','view-conduct-menu','view-course-menu','view-agent-exam-menu','view-upload-calls-menu','view-audit-fiber-categories','view-audit-dth-categories','view-create-parametor','view-edit-parametor','view-delete-parametor','view-btn-create-parameters','view-btn-edit-parameters','view-global-reports','view-service-reports','view-productivity-reports','view-percentile-reports','view-autofail-reports','view-category-reports','view-course-report','view-livecall-report','view-global-button-reports','view-service-button-reports','view-productivity-button-reports','view-percentile-button-reports','view-autofail-button-reports','view-category-button-reports','view-course-button-report','view-livecall-button-report','view-results-audit-menu','view-results-exam-menu','view-results-autofail-menu','view-results-audit-button-menu','view-results-exam-button-menu','view-results-autofail-button-menu','view-results-audit-button','view-results-audit-edit','view-results-audit-delete','view-results-autofail-button','view-results-autofail-button-view','view-upload-call-button','view-start-results-exam-buttons','view-create-course-button','view-edit-delete-course-button','view-new-conduct-page-button','view-edit-view-delete-conduct--button','view-submit-course-button','view-scheduling-exam-button','view-saving-done-exam-button','view-edit-course-button','view-edit-conduct-menu','view-create-question-page','view-edit-view-delete-button-question','view-edit-question-button','view-create-question-button','view-voc-summary-button','view-strenght-summary-button','view-gap-summary-button','view-save-strength-summary-button','view-save-voc-summary-button','view-save-gap-summary-button','view-gap-edit-delete-action','view-voc-edit-delete-action','view-strength-edit-delete-action','view-general-submit-button','view-general-add-category-button','view-general-action-button','view-general-save-category-button','view-button-create-tracker','view-exam-results-question-with-answers','view-export-PDF-coaching-button','view-export-PDF-alert-button','quality-analysts-report-request','admin-supervisor-quality-exam-results','view-edit-summary-button'];
             foreach ($permissions as $permissionName) {
             $permission = Permission::where('name', $permissionName)->first();

             // Assign the permission to the role
             $roleQualityAnalystWgkl->givePermissionTo($permission);
              }





    }
}
