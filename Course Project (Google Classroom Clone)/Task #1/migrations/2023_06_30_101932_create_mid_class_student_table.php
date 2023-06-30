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
    {  // many to many relationship between class and student
        Schema::create('mid_class_student', function (Blueprint $table) {
            $table->id();
            $table->foreign("student_id")->references("id")->on("students");
            $table->foreign("class_id")->references("id")->on("classrooms");
            $table->boolean("is_muted");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mid_class_student');
    }
};
