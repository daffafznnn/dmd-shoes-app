<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->date('start_date')->change();
            $table->date('end_date')->change();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dateTime('start_date')->change();  // Mengembalikan ke tipe datetime jika rollback
            $table->dateTime('end_date')->change();    // Mengembalikan ke tipe datetime jika rollback
        });
    }
};
