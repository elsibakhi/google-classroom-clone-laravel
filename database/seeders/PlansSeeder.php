<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Plan::insert([
                ["name"=>"free" , "price"=>0 , "featured"=>0],
                ["name"=>"basic" , "price"=>2000 , "featured"=>1],
                ["name"=>"pro" , "price"=>7000 , "featured"=>0],

        ]);

        Feature::insert([
           ["name"=>"Classroom #","code"=>"classrooms-count"],
           ["name"=>"Students Per Classroom","code"=>"classroom-students"],
        ]);

        DB::table('plan_feature')->insert([

            ["plan_id"=>1,"feature_id"=>1,"feature_value"=>1],
            ["plan_id"=>1,"feature_id"=>2,"feature_value"=>10],
            ["plan_id"=>2,"feature_id"=>1,"feature_value"=>7],
            ["plan_id"=>2,"feature_id"=>2,"feature_value"=>40],
            ["plan_id"=>3,"feature_id"=>1,"feature_value"=>100],
            ["plan_id"=>3,"feature_id"=>2,"feature_value"=>100],
        ]);

    }
}
