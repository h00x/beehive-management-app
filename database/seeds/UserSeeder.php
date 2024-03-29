<?php

use App\Hive;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Dave',
            'email' => 'dave@unnatural.nl',
            'password' => Hash::make('password'),
        ]);
    }
}
