<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminTableSeeder extends Seeder
{
    // php artisan db:seed --class=AdminTableSeeder
    public function run()
    {
        $user = User::create([
            'name' => 'Meng', 
            'email' => 'meng@gmail.com',
            'password' => bcrypt('123')
        ]);
        $role = Role::create(['name' => 'ROOT']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
