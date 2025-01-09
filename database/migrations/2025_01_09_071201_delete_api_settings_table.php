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
        Schema::dropIfExists('api_settings');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('api_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setting_id')->constrained('settings')->onDelete('cascade');
            $table->string('api_name');  // Nama API (misalnya, Stripe, Google Maps)
            $table->string('api_key');  // API Key
            $table->string('api_secret')->nullable();  // API Secret (jika diperlukan)
            $table->timestamps();
        });
    }
};
