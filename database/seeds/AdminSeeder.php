<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use App\User;
use App\Profile;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
 		 * Create Admin Account	
 	     */
        $role = Role::find(3)->toArray();

        $user = User::create(['username' => 'Admin', 'email' => 'admin@lutvia.com', 'password' => bcrypt('lutviadev')]);
		$profile = Profile::create(['firstname' => 'AEC', 'lastname' => '3D']);

		$user->attachRole($role['id']);
		$user->profile()->save($profile);
    }
}
