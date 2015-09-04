<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;

class TopRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $totalControl = Permission::create([
        	'name' => 'Total control',
        	'slug' => 'total.control'
        ]);

        $superadmin = Role::create([
            'name' => 'Superadmin',
            'slug' => 'superadmin',
            'description' => 'This user have total access and can use debuge tools.',
            'level' => 1000
        ]);

        $owner = Role::create([
            'name' => 'Owner',
            'slug' => 'owner',
            'description' => 'This user can manage all resources, users, groups and briefcases.',
            'level' => 999
        ]);

        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'This user can manage all resources of all briefcases. But can\'t manage user, groups and briefcases.'
        ]);

        $superadmin->attachPermission($totalControl);
        $owner->attachPermission($totalControl);
    }
}
