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
        // Tabel untuk pengaturan aplikasi secara umum
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->string('logo')->nullable();  // Logo aplikasi
            $table->string('favicon')->nullable();  // Favicon aplikasi
            $table->text('description')->nullable();  // Deskripsi tentang aplikasi atau perusahaan
            $table->string('email')->nullable();  // Email kontak perusahaan
            $table->string('phone')->nullable();  // Nomor telepon
            $table->text('address')->nullable();  // Alamat perusahaan
            $table->string('latitude')->nullable();  // Koordinat latitude untuk peta
            $table->string('longitude')->nullable();  // Koordinat longitude untuk peta
            $table->boolean('is_maintenance')->default(false);  // Status pemeliharaan aplikasi
            $table->string('app_key')->nullable();  // Kunci aplikasi untuk validasi perubahan pengaturan
            $table->timestamps();
        });

        // Tabel untuk pengaturan sosial media yang terhubung dengan aplikasi
        Schema::create('social_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setting_id')->constrained('settings')->onDelete('cascade');
            $table->string('name');  // Nama sosial media (misalnya: Facebook, Instagram)
            $table->string('icon');  // Nama file icon atau class untuk sosial media
            $table->string('url');  // URL sosial media (misalnya: https://facebook.com)
            $table->timestamps();
        });

        // Tabel untuk pengaturan API yang terhubung dengan aplikasi
        Schema::create('api_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setting_id')->constrained('settings')->onDelete('cascade');
            $table->string('api_name');  // Nama API (misalnya, Stripe, Google Maps)
            $table->string('api_key');  // API Key
            $table->string('api_secret')->nullable();  // API Secret (jika diperlukan)
            $table->timestamps();
        });

        // Tabel untuk pengaturan metode pembayaran
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nama metode pembayaran (misalnya: Transfer Bank, COD, dll)
            $table->string('description')->nullable();  // Deskripsi singkat metode pembayaran
            $table->boolean('is_active')->default(true);  // Status aktif atau tidaknya metode pembayaran
            $table->timestamps();
        });

        // Tabel untuk pengaturan pengiriman
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nama metode pengiriman (misalnya: JNE, Tiki, jne)
            $table->decimal('cost', 10, 2)->default(0);  // Biaya pengiriman standar untuk metode ini
            $table->boolean('is_active')->default(true);  // Status aktif atau tidaknya metode pengiriman
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('api_settings');
        Schema::dropIfExists('social_settings');
        Schema::dropIfExists('settings');
    }
};
