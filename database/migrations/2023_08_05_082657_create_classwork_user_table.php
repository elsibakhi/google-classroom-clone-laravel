<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignIdColumnDefinition;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('classwork_user');

        Schema::create('classwork_user', function (Blueprint $table) {
           
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->foreignId("classwork_id")->constrained()->cascadeOnDelete();
       
                        $table->float("grade")->nullable();
                        $table->timestamp("created_at")->nullable();
                        $table->enum("status",["assigned","draft","submitted","returned"]);
                        $table->timestamp("submitted_at")->nullable();
                        $table->primary(["classwork_id","user_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classwork_user');
    }
};
