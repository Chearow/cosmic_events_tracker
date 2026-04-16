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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('theme', ['light', 'dark'])->default('dark');
            $table->foreignId('default_event_type_id')->nullable()->constrained('event_types')->onDelete('cascade');
            $table->foreignId('default_source_id')->nullable()->constrained('external_sources')->onDelete('cascade');
            $table->integer('items_per_page')->default(10);
            $table->string('timezone')->default('UTC');
            $table->string('language')->default('en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
