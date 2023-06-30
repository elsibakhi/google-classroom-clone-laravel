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
    { // <Note> : submission may be (link ,  file path , sign(Indicates the completion of work) )
          // assignment is a special kind  of contributions
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreign("assignment_id")->references("id")->on("assignments");
            $table->enum("submission_type",["link"," file_path","sign"]);
            $table->string("submission");
            
            $table->foreign("contribution_id")->references("id")->on("contributions");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
