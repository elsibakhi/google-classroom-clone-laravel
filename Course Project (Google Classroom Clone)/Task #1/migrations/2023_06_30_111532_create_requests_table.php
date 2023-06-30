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
    { // request is a special kind  of class_work
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreign("class_work_id")->references("id")->on("class_works");
            $table->integer("points");
            $table->dateTime("deadline");
            $table->longText("instructions")->nullable();
            $table->boolean("isReviewed")->nullable()->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
