<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create a roles table to index and reference user access.
        Schema::create('roles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('role_system_name',20)->unique();
            $table->string('role_name',50);
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
        // Drop the entire roles table in one go. WHAM!
        Schema::drop('roles');
    }
}
