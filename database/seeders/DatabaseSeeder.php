<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default setting
        Setting::firstOrCreate([
            'header_logo' => ''
        ]);


        // Create test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create Super Admin
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // Change it in production
            ]
        );

        // Create super-admin role
        $role = Role::firstOrCreate(
            ['name' => 'super-admin', 'guard_name' => 'admin']
        );

        // Define all permissions
        $permissions = [
            
            // dashboard dashboard
            'create dashboard',
            'edit dashboard',
            'view dashboard',
            'delete dashboard',


            // role permissions
            'create role',
            'edit role',
            'view role',
            'delete role',

            // permission permissions
            'create permission',
            'edit permission',
            'view permission',
            'delete permission',


            // user permissions
            'create user',
            'edit user',
            'view user',
            'delete user',


            // setting permissions
            'create setting',
            'edit setting',
            'view setting',
            'delete setting',


            // deposit permissions
            'create deposit',
            'edit deposit',
            'view deposit',
            'delete deposit',

            // sendmoney permissions
            'create sendmoney',
            'edit sendmoney',
            'view sendmoney',
            'delete sendmoney',


            // banktransfer permissions
            'create banktransfer',
            'edit banktransfer',
            'view banktransfer',
            'delete banktransfer',


            // withdraw permissions
            'create withdraw',
            'edit withdraw',
            'view withdraw',
            'delete withdraw',


            // account permissions
            'create account',
            'edit account',
            'view account',
            'delete account',


        ];

        // Create and assign permissions to role
        foreach ($permissions as $perm) {
            $permission = Permission::firstOrCreate([
                'name' => $perm,
                'guard_name' => 'admin'
            ]);

            // Assign permission to role if not already assigned
            if (!$role->hasPermissionTo($permission)) {
                $role->givePermissionTo($permission);
            }
        }

        // Assign role to admin
        if (!$admin->hasRole($role)) {
            $admin->assignRole($role);
        }
    }
}
