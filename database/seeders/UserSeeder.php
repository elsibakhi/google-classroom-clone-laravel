<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 

DB::table('users')->insert([ "name" => "baraa",
"email" =>"baraa@gmail.com",
"email_verified_at" =>null,
"password" =>Hash::make("test1234")]);


DB::table('users')->insert([ "name" => "ahmed",
"email" =>"ahmed@gmail.com",
"email_verified_at" =>null,
"password" =>Hash::make("test1234")]);



DB::table('users')->insert([ "name" => "hazem",
"email" =>"hazem@gmail.com",
"email_verified_at" =>null,
"password" =>Hash::make("test1234")]);
    }
}
