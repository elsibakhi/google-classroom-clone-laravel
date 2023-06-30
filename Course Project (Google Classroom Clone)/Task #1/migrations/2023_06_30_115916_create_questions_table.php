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
    { // question is a special kind  of request
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreign("request_id")->references("id")->on("requests");
            $table->enum("question_type",["short_answer"," multiple_choice"]);
            $table->longText("question");
            $table->boolean("can_students_reply");
            $table->boolean("can_students_edit_answer");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
