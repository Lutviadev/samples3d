<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('TopRoleSeeder');
        $this->call('SuperAdminSeeder');
        $this->call('OwnerSeeder');
        $this->call('AdminSeeder');
        $this->call('BriefcaseSeeder');
        $this->call('BasicCategoriesSeeder');

        Model::reguard();
    }
}
