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
    {  // material is a special kind  of class_work
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->longText("desciption")->nullable();
            $table->foreign("class_work_id")->references("id")->on("class_works");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
