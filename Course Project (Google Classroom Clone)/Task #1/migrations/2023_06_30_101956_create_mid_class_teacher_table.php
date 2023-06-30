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
    {  // many to many relationship between class and teacher
        Schema::create('mid_class_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreign("teacher_id")->references("id")->on("teachers");
            $table->foreign("class_id")->references("id")->on("classrooms");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mid_class_teacher');
    }
};
