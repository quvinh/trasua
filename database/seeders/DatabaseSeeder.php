<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Ngô Quang Vinh',
            'username' => 'admin',
            'email' => 'vinhhp2620@gmail.com',
            'password' => bcrypt('admin123'),
            'phone' => '0962334135',
            'gender' => 1,
            'address' => 'Chiến Thắng, An Lão, Hải Phòng',
        ]);

        User::create([
            'name' => 'Username',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'phone' => '0962334135',
            'gender' => 1,
            'address' => 'Chiến Thắng, An Lão, Hải Phòng',
        ]);

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permission
        DB::table('permissions')->insert([
            // Product
            ['name' => 'pro.add', 'guard_name' => 'admin'],
            ['name' => 'pro.edit', 'guard_name' => 'admin'],
            ['name' => 'pro.delete', 'guard_name' => 'admin'],
            ['name' => 'pro.view', 'guard_name' => 'admin'],
            ['name' => 'pro.confirm', 'guard_name' => 'admin'],

            // Formula
            ['name' => 'for.add', 'guard_name' => 'admin'],
            ['name' => 'for.edit', 'guard_name' => 'admin'],
            ['name' => 'for.delete', 'guard_name' => 'admin'],
            ['name' => 'for.view', 'guard_name' => 'admin'],
            ['name' => 'for.confirm', 'guard_name' => 'admin'],

            // Bill
            ['name' => 'bil.add', 'guard_name' => 'admin'],
            ['name' => 'bil.edit', 'guard_name' => 'admin'],
            ['name' => 'bil.delete', 'guard_name' => 'admin'],
            ['name' => 'bil.view', 'guard_name' => 'admin'],
            ['name' => 'bil.confirm', 'guard_name' => 'admin'],

            // Table order
            ['name' => 'tab.add', 'guard_name' => 'admin'],
            ['name' => 'tab.edit', 'guard_name' => 'admin'],
            ['name' => 'tab.delete', 'guard_name' => 'admin'],
            ['name' => 'tab.view', 'guard_name' => 'admin'],
            ['name' => 'tab.confirm', 'guard_name' => 'admin'],

            // Store
            ['name' => 'sto.add', 'guard_name' => 'admin'],
            ['name' => 'sto.edit', 'guard_name' => 'admin'],
            ['name' => 'sto.delete', 'guard_name' => 'admin'],
            ['name' => 'sto.view', 'guard_name' => 'admin'],
            ['name' => 'sto.confirm', 'guard_name' => 'admin'],

            // Shop
            ['name' => 'sho.add', 'guard_name' => 'admin'],
            ['name' => 'sho.edit', 'guard_name' => 'admin'],
            ['name' => 'sho.delete', 'guard_name' => 'admin'],
            ['name' => 'sho.view', 'guard_name' => 'admin'],
            ['name' => 'sho.confirm', 'guard_name' => 'admin'],

            // Customer
            ['name' => 'cus.add', 'guard_name' => 'admin'],
            ['name' => 'cus.edit', 'guard_name' => 'admin'],
            ['name' => 'cus.delete', 'guard_name' => 'admin'],
            ['name' => 'cus.view', 'guard_name' => 'admin'],
            ['name' => 'cus.confirm', 'guard_name' => 'admin'],

            // Account
            ['name' => 'acc.add', 'guard_name' => 'admin'],
            ['name' => 'acc.edit', 'guard_name' => 'admin'],
            ['name' => 'acc.delete', 'guard_name' => 'admin'],
            ['name' => 'acc.view', 'guard_name' => 'admin'],
            ['name' => 'acc.confirm', 'guard_name' => 'admin'],
        ]);

        // Role
        $roleAdmin = Role::create(['name' => 'Administrator', 'guard_name' => 'admin']);
        $rolePresident = Role::create(['name' => 'Giám đốc', 'guard_name' => 'admin']);
        $roleAccount = Role::create(['name' => 'Kế toán', 'guard_name' => 'admin']);
        $roleManager = Role::create(['name' => 'Quản lý', 'guard_name' => 'admin']);
        $roleEmployee = Role::create(['name' => 'Nhân viên', 'guard_name' => 'admin']);

        // Give permission
        $roleAdmin->givePermissionTo(Permission::all());
        $rolePresident->givePermissionTo(Permission::where([
            ['name', '<>', 'acc.delete'],
            ['name', '<>', 'acc.edit']
        ])->get());
        $roleManager->givePermissionTo(Permission::where([
            ['name', 'not like', 'sto%'],
            ['name', 'not like', 'sho%'],
            ['name', 'not like', 'acc%'],
        ])->get());
        $roleAccount->givePermissionTo(Permission::where([
            ['name', 'not like', 'sto%'],
            ['name', 'not like', 'sho%'],
            ['name', 'not like', 'acc%'],
            ['name', '<>', 'cus.delete'],
        ])->get());
        $roleEmployee->givePermissionTo(Permission::where([
            ['name', 'not like', 'sto%'],
            ['name', 'not like', 'sho%'],
            ['name', 'not like', 'acc%'],
            ['name', 'not like', 'cus%'],
            ['name', 'not like', '%confirm'],
            ['name', 'not like', '%delete'],
            ['name', 'not like', '%edit'],
            ['name', 'not like', '%add'],
        ])->get());

        // Assign role
        $admin->assignRole($roleAdmin);

        // Unit
        DB::table('units')->insert([
            ['name' => 'ml'],
            ['name' => 'gam'],
            ['name' => 'lít'],
            ['name' => 'kg'],
            ['name' => 'muỗm'],
            ['name' => 'gói'],
            ['name' => 'cốc'],
            ['name' => 'chiếc'],
            ['name' => 'cái'],
            ['name' => 'thùng'],
        ]);

        // Size
        DB::table('sizes')->insert([
            ['name' => 'size M', 'capacity' => 300],
            ['name' => 'size L', 'capacity' => 700],
        ]);
    }
}
