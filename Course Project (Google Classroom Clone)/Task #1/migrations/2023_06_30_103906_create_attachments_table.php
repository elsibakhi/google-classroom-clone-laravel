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
    { // <Note> : attachment may be (link ,  file path  )
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreign("class_work_id")->references("id")->on("class_works");
            $table->enum("attachment_type",["link"," file_path"]);
            $table->string("attachment");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
