<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

$users = array(
    array('id' => '1', 'name' => 'Sushmitha' ,'email' => 'sush@gmail.com','password' => '123456'),
    array('id' => '2', 'name' => 'Sakthi' ,'email' => 'sak@gmail.com','password' => '123456'),
   
);

DB::table('users')->insert($users);

    }
}
