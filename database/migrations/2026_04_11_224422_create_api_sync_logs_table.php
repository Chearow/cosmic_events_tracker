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
        Schema::create('api_sync_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_id')->constrained('external_sources');
            $table->enum('status', ['success', 'failed', 'partial']);
            $table->text('message');
            $table->dateTime('started_at');
            $table->dateTime('finished_at');
            $table->json('raw_request')->nullable();
            $table->json('raw_response')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_sync_logs');
    }
};
