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
    {   // assignment is a special kind  of contributions
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreign("question_id")->references("id")->on("questions");
            $table->foreign("student_id")->references("id")->on("students");
            $table->longText("answer");
            $table->foreign("contribution_id")->references("id")->on("contributions");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
