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
        Schema::create('assignment_criteria_levels', function (Blueprint $table) {
            $table->id();
            $table->foreign("assignment_criteria_id")->references("id")->on("assignment_criterias");
            $table->integer("points");
            $table->string("title");
            $table->longText("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_criteria_levels');
    }
};
