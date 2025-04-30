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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pasiens_id')->constrained('data_pasiens')->onDelete('cascade');
            $table->foreignId('obat_pasiens_id')->constrained('obat_pasiens')->onDelete('cascade');
            $table->foreignId('kunjungans_id')->constrained('kunjungans')->onDelete('cascade');
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['dibayar', 'belum_dibayar']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
