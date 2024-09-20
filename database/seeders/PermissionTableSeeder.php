<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    // php artisan db:seed --class=PermissionTableSeeder
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            'news-list',
            'news-create',
            'news-edit',
            'news-delete',
        ];
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
