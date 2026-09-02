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
        Schema::create('upwork_leads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('service_category_id')->nullable()->constrained('service_categories')->nullOnDelete();

            $table->string('job_title');
            $table->text('description')->nullable();
            $table->string('budget')->nullable();
            $table->string('client_payment_status')->nullable();
            $table->string('url');
            $table->enum('rank', ['A', 'B', 'C'])->nullable();

            $table->timestamp('ditemukan_pada')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upwork_leads');
    }
};
