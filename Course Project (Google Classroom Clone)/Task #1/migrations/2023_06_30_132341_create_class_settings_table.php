<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_settings', function (Blueprint $table) {
            $table->id();
            $table->foreign("class_id")->references("id")->on("classrooms");
            $table->enum("stream",[
                "students can post and comment",
                "students can comment only",
                "only teachers can post and comment",
                ])->nullable()->default("students can post and comment");
            $table->enum("classwork_on_stream",[
                "show attachments and details",
                "show condensed notifications",
                "hide notifications",
                ])->nullable()->default("show condensed notifications");
          
                $table->boolean("show_deleted_items")->nullable()->default(false);
                $table->enum("overall_grade_calculation",[
                    "no overall grade",
                    "total points",
                    "weighted by category",
                    ])->nullable()->default("no overall grade");
                $table->boolean("show_overall_grade_to_students")->nullable()->default(false);
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_settings');
    }
};
