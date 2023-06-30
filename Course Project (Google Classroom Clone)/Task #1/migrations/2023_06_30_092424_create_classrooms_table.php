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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string("name");
            $table->string("section")->nullable();
            $table->string("subject")->nullable();
            $table->string("room")->nullable();
            $table->string("description")->nullable();
            $table->string("theme")->nullable();
            $table->string("header_img")->nullable();
            $table->string("code")->unique();
            $table->enum("status",["active","archived"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
