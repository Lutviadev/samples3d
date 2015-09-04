<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use App\User;
use App\Profile;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
 		 * Create Owner Account	
 	     */
        $role = Role::find(2)->toArray();

        $user = User::create(['username' => 'AEC', 'email' => 'mail@aec.com', 'password' => bcrypt('aecpass')]);
		$profile = Profile::create(['firstname' => 'AEC', 'lastname' => '3D']);

		$user->attachRole($role['id']);
		$user->profile()->save($profile);
    }
}
