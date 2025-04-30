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
        Schema::create('obat_obatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode_obat')->unique();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 8, 2);
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat_obatans');
    }
};
