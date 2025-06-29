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
        // dishcema aku nambahin 's' karena model laravel itu secara default mengenal nama table dengan tambahan s
        //kalau gak sesuai kita harus definisiin lagi di model protected $table = 'anggota' 
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('level')->default('member');
            $table->string('akses_level')->default('member');
            $table->string('domisili')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
