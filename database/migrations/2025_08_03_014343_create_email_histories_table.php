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
        Schema::create('email_histories', function (Blueprint $table) {            
            $table->id();
            $table->foreignId('sent_by')->constrained('users')->onDelete('cascade');
            $table->text('recipient')->nullable();
            $table->string('subject')->nullable();
            $table->longText('body')->nullable();
            $table->text('image_url')->nullable();
            $table->string('status')->default('pending');
            $table->text('error_message')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_histories');
    }
};
