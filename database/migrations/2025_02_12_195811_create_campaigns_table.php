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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('campaign_id')->primary();
            $table->char('whatsapp_business_account_id', 36);
            $table->uuid('template_id')->nullable(); // Si usa plantillas
            $table->string('name', 255);
            $table->text('message_content'); // Mensaje personalizado
            $table->enum('type', ['INMEDIATA', 'PROGRAMADA']);
            $table->timestamp('scheduled_at')->nullable();
            $table->enum('status', ['DRAFT', 'ACTIVE', 'PAUSED', 'COMPLETED', 'CANCELLED']);
            $table->integer('total_recipients');
            $table->json('filters')->nullable(); // Filtros de segmentación (ej: país, etiquetas)
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('whatsapp_business_account_id')
                  ->references('whatsapp_business_id')
                  ->on('whatsapp_business_accounts');

            $table->foreign('template_id')
                  ->references('template_id')
                  ->on('templates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
