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
        Schema::create('flows', function (Blueprint $table) {
            $table->uuid('flow_id')->primary();
            $table->foreignUuid('bot_id'); // Bot asociado
            $table->string('name');
            $table->json('trigger_keywords')->nullable();
            $table->boolean('is_case_sensitive')->default(false);
            $table->boolean('is_default')->default(false); // Flujo por defecto
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flows');
    }
};
