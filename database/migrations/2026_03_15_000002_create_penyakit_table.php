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
        Schema::create('penyakit', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();  // P01-P10
            $table->string('nama');
            $table->string('tipe');  // Jamur, Bakteri, Hama Binatang, Hama Serangga
            $table->text('deskripsi');
            $table->json('solusi')->nullable();  // Array of solutions
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyakit');
    }
};
