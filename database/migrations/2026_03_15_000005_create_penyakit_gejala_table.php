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
        Schema::create('penyakit_gejala', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyakit_id')->constrained('penyakit')->onDelete('cascade');
            $table->foreignId('gejala_id')->constrained('gejala')->onDelete('cascade');
            $table->decimal('cf_pakar', 3, 2);  // 0.1-1.0
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->unique(['penyakit_id', 'gejala_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyakit_gejala');
    }
};
