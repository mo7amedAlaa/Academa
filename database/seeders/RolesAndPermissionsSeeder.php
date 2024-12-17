<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $permissionsToAdd = [
            'manage users',
            'manage courses',
            'add to cart',
            'add to favorites',
            'checkout',
            'view instructors',
            'manage instructors',
            'manage categories',
            'view dashboard',
        ];

        $permissionsToRemove = [
            'mange users', // إذن غير صحيح (خطأ في الكتابة)
            'view courses', // حذف
        ];

        // إضافة الأذونات الجديدة
        foreach ($permissionsToAdd as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // إزالة الأذونات غير المرغوبة
        foreach ($permissionsToRemove as $permission) {
            $perm = Permission::where('name', $permission)->first();
            if ($perm) {
                $perm->delete();
            }
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions([
            'manage users',
            'manage courses',
            'add to cart',
            'checkout',
            'manage instructors',
            'manage categories',
            'view dashboard',
        ]);

        $instructor = Role::firstOrCreate(['name' => 'instructor']);
        $instructor->syncPermissions([
            'manage courses',
            'view instructors',
        ]);

        $student = Role::firstOrCreate(['name' => 'student']);
        $student->syncPermissions([
            'add to cart',
            'checkout',
            'add to favorites',
        ]);
    }
}
