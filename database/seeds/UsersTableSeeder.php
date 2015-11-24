<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'role_id' => 1,
            'title' => '',
            'first_name' => 'Administrator',
            'last_name' => '',
            'tel_number' => '+27000000000',
            'fax_number' => '+27000000000',
            'mobile_number' => '+27000000000',
            'email' => 'dummy@domain.com',
            'password' => bcrypt('N3wT0N'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
