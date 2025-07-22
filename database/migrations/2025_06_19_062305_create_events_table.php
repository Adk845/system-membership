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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->string('createdBy')->nullable();
            $table->string('nama')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('narasumber')->nullable();
            $table->string('jenis_peminatan')->nullable();
            $table->string('Lokasi')->nullable();
            $table->string('link')->nullable();
            $table->date('tanggal')->nullable();
            // $table->time('waktu')->nullable();
            $table->string('waktu')->nullable();
            $table->string('wilayah_koordinator')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
