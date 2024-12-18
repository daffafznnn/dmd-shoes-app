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
        // Tabel untuk Material Produk
        Schema::create('product_materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // Tabel untuk Warna Produk
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // Tabel untuk Ukuran Produk
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('size_number');
            $table->string('size_chart');
            $table->string('slug')->unique();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // Tabel untuk Variasi Produk
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('product_colors')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('product_sizes')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('product_materials')->onDelete('cascade');
            $table->decimal('price', 10, 2)->nullable();  // Harga spesifik untuk variasi produk
            $table->timestamps();
        });

        // Tabel untuk Gambar Variasi Produk
        Schema::create('product_variant_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained('product_variants')->onDelete('cascade');
            $table->string('image');  // Gambar untuk variasi produk
            $table->timestamps();
        });

        // Tabel untuk Stok Produk berdasarkan Variasi
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained('product_variants')->onDelete('cascade');
            $table->integer('stock');  // Jumlah stok untuk variasi produk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stocks');
        Schema::dropIfExists('product_variant_images');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('product_sizes');
        Schema::dropIfExists('product_colors');
        Schema::dropIfExists('product_materials');
    }
};
