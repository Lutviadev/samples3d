<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use App\User;
use App\Profile;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
 		 * Create Superadmin Account	
 	     */
        $role = Role::find(1)->toArray();

        $user = User::create(['username' => 'Lutvia', 'email' => 'ricardo@lutvia.com', 'password' => bcrypt('lutviadev')]);
		$profile = Profile::create(['firstname' => 'Ricardo', 'lastname' => 'Marcattini']);

		$user->attachRole($role['id']);
		$user->profile()->save($profile);
    }
}
