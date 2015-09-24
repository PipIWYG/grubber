<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableWithRequiredFieldsAndAddForeignKeyIndexToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify the existing users table. Add fields required in project spec
        // Also add an index field to reference user_role
        Schema::table('users', function($table) {
            $table->dropColumn('name');
            
            $table->integer('role_id')->after('id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            
            $table->string('title', 8)->after('role_id')->nullable();
            $table->string('first_name', 50)->after('title');
            $table->string('last_name', 50)->after('first_name');
            $table->string('tel_number', 10)->after('last_name')->nullable();
            $table->string('fax_number', 10)->after('tel_number')->nullable();
            $table->string('mobile_number', 10)->after('fax_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Modify the existing users table. Add fields required in project spec
        // Also add an index field to reference user_role
        Schema::table('users', function($table) {
            $table->dropColumn('role_id');
            $table->dropColumn('title');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('tel_number');
            $table->dropColumn('fax_number');
            $table->dropColumn('mobile_number');
            
            $table->string('name', 255)->after('id');
        });
    }
}
