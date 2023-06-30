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
        Schema::create('request_class_comment_replays', function (Blueprint $table) {
            $table->id();
            $table->foreign("request_class_comment_id")->references("id")->on("request_class_comments");
            $table->foreign("from")->references("id")->on("teachers");
            $table->string("replay");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_class_comment_replays');
    }
};
