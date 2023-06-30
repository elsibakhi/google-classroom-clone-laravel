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
    { // if for attribute in class_work is not "all"
        Schema::create('allowed_students', function (Blueprint $table) {
            $table->id();
            $table->foreign("student_id")->references("id")->on("students");
            $table->foreign("class_work_id")->references("id")->on("class_works");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowed_students');
    }
};
