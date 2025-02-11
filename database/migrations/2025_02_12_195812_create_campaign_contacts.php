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
        Schema::create('campaign_contact', function (Blueprint $table) {
            $table->uuid('campaign_id');
            $table->uuid('contact_id');
            $table->enum('status', ['PENDING', 'SENT', 'DELIVERED', 'READ', 'FAILED']);
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->integer('response_count')->default(0); // Interacciones
            $table->text('error_details')->nullable();

            $table->foreign('campaign_id')
                  ->references('campaign_id')
                  ->on('campaigns');

            $table->foreign('contact_id')
                  ->references('contact_id')
                  ->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_contacts');
    }
};
