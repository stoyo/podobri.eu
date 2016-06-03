<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function(Blueprint $table){
           $table->increments('id');
           $table->integer('user_id')->nullable();
           $table->string('user_fullname')->nullable();
           $table->string('user_email')->nullable();
           $table->string('category');
           $table->text('problem_title');
           $table->text('problem_description')->nullable();
           $table->string('location');
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
        Schema::drop('problems');
    }
}
