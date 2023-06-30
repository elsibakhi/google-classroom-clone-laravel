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
        Schema::create('class_works', function (Blueprint $table) {
            $table->id();
            $table->foreign("class_id")->references("id")->on("classrooms");
            $table->enum("for",["all","specific"]);
            $table->foreign("topic_id")->references("id")->on("topics");
            $table->enum("type",["post","schedule","draft"]);
            $table->dateTime("schedule")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_works');
    }
};
