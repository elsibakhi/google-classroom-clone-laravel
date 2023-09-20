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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("plan_id")->nullable()->constrained()->nullOnDelete();
            $table->foreignId("user_id")->nullable()->constrained()->nullOnDelete();
                $table->unsignedSmallInteger("price")->default(0);
                $table->unsignedSmallInteger("period")->default(1);
                $table->enum("status",["pending","active","expired"])->default("pending");
                $table->timestamp("expires_at");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
