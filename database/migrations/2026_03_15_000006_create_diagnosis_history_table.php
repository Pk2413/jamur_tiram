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
        Schema::create('diagnosis_history', function (Blueprint $table) {
            $table->id();
            $table->json('gejala_terpilih');  // Array gejala IDs
            $table->foreignId('hasil_penyakit_id')->constrained('penyakit')->onDelete('cascade');
            $table->decimal('confidence_level', 5, 2);  // 0-100
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosis_history');
    }
};
