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
        Schema::create('rule', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();  // R1-R10
            $table->foreignId('penyakit_id')->constrained('penyakit')->onDelete('cascade');
            $table->string('kondisi_format');  // "G12 AND G18 AND G06 AND G07"
            $table->integer('jumlah_gejala');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule');
    }
};
