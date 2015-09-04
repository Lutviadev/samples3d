<?php

use App\Briefcase;
use Illuminate\Database\Seeder;

class BriefcaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Briefcase::create(['name' => 'SAMPLES']);
    }
}