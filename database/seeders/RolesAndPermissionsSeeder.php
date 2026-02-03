<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view dashboard',
            'manage services',
            'manage projects',
            'manage clients',
            'manage contacts',
            'manage settings',
            'manage customers',
            'manage invoices',
            'manage payments',
            'manage expenses',
            'manage revenues',
            'manage accounts',
            'manage categories',
            'manage currencies',
            'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $owner = Role::firstOrCreate(['name' => 'Owner']);
        $owner->syncPermissions($permissions);

        $accountant = Role::firstOrCreate(['name' => 'Accountant']);
        $accountant->syncPermissions([
            'view dashboard',
            'manage invoices',
            'manage payments',
            'manage expenses',
            'manage revenues',
            'manage accounts',
            'manage categories',
            'manage currencies',
            'view reports',
        ]);

        $contentManager = Role::firstOrCreate(['name' => 'Content Manager']);
        $contentManager->syncPermissions([
            'view dashboard',
            'manage services',
            'manage projects',
            'manage clients',
            'manage contacts',
            'manage settings',
        ]);

        $crmManager = Role::firstOrCreate(['name' => 'CRM Manager']);
        $crmManager->syncPermissions([
            'view dashboard',
            'manage customers',
            'manage invoices',
            'manage payments',
        ]);
    }
}
