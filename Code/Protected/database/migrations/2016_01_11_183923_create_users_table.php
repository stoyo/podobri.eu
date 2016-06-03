<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->integer('day');
            $table->string('month');
            $table->integer('year');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('about')->nullable();
            $table->enum('is_admin', [0, 1])->default(0);
            $table->enum('is_owner', [0, 1])->default(0);
            $table->string('remember_token')->nullable();
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
        Schema::drop('users');
    }
}
