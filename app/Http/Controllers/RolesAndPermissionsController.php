<?php
namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends Controller
{
    public function setupRolesAndPermissions()
    {
        $rolesAndPermissions = [
            'Super Admin' => [
                'full access',
                'manage users',
                'assign roles',
                'manage question banks',
                'approve questions',
                'generate reports',
                'perform backups',
                'send notifications',
            ],
            'Admin' => [
                'manage users',
                'manage question banks',
                'approve questions',
                'generate reports',
                'perform backups',
                'send notifications',
            ],
            'Group Admin' => [
                'manage group users',
                'assign roles',
                'manage question banks',
                'approve questions',
                'create tests',
            ],
            'Content Manager' => [
                'manage content',
                'manage question banks',
                'approve questions',
                'generate reports',
            ],
            'Teacher' => [
                'create tests',
                'monitor progress',
                'manage content',
            ],
            'Teacher Assistant' => [
                'support teacher',
                'monitor progress',
            ],
            'Student' => [
                'view grades',
                'review tests',
            ],
            'Reviewer' => [
                'review questions',
                'approve questions',
            ],
            'Technical Support' => [
                'resolve issues',
                'perform backups',
                'send notifications',
            ],
        ];

        $allPermissions = collect($rolesAndPermissions)->flatten()->unique();
        foreach ($allPermissions as $permission) {
            Permission::findOrCreate($permission); 
        }

        foreach ($rolesAndPermissions as $roleName => $permissions) {
            $role = Role::findOrCreate($roleName);
            $role->syncPermissions($permissions); }


        return response()->json(['message' => 'Roles and permissions have been set up successfully.']);
    }
}
