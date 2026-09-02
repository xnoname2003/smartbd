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
        Schema::create('search_keywords', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // Relasi ke tabel service_categories
            $table->foreignUuid('service_category_id')->constrained('service_categories')->cascadeOnDelete();
            
            $table->string('keyword');
            $table->boolean('is_active')->default(true); // Flag buat matiin keyword kalau hasilnya jelek
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_keywords');
    }
};
