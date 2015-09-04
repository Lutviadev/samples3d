<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBriefcaseRenderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefcase_render', function(Blueprint $table) 
        {
            $table->integer('briefcase_id')->unsigned()->index();
            $table->foreign('briefcase_id')->references('id')->on('briefcases')->onDelete('cascade');
            $table->integer('render_id')->unsigned()->index();
            $table->foreign('render_id')->references('id')->on('renders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('briefcase_render');
    }
}