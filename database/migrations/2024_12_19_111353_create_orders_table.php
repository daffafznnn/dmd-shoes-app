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
        // Tabel Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code_order')->unique();  // Kode unik untuk setiap pesanan
            $table->string('customer_name');          // Nama pelanggan
            $table->string('customer_contact');       // Kontak pelanggan (misalnya nomor HP)
            $table->text('shipping_address');         // Alamat pengiriman
            $table->text('note')->nullable();         // Catatan tambahan untuk pesanan
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');  // Status pesanan
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade');         // Metode pembayaran (misalnya transfer bank, COD)
            $table->string('payment_proof')->nullable();  // Bukti transaksi (URL atau path gambar)
            $table->foreignId('shipping_method_id')->constrained('shipping_methods')->onDelete('cascade');   // Nama ekspedisi (misalnya JNE, TIKI)
            $table->string('tracking_number')->nullable();     // Nomor resi pengiriman
            $table->decimal('total', 10, 2);          // Total harga pesanan
            $table->softDeletes();                    // Untuk fitur penghapusan lunak
            $table->timestamps();
        });

        // Tabel Order Details
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity');             // Jumlah produk yang dipesan
            $table->decimal('price', 10, 2);         // Harga satuan produk saat pemesanan
            $table->decimal('sub_total', 10, 2);     // Sub-total untuk item ini (harga x jumlah)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
    }
};
