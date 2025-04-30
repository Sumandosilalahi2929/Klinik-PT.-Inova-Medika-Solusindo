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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pasiens_id')->constrained('data_pasiens')->onDelete('cascade');
            $table->foreignId('data_pegawais_id')->constrained('data_pegawais')->onDelete('cascade');
            $table->timestamp('tanggal_kunjungan');
            $table->enum('tipe_kunjungan', [
                'Kunjungan umum',
                'Kunjungan laboratorium',
                'Kunjungan darurat (emergency)',
                'Kunjungan spesialis',
                'Follow-up setelah perawatan',
                'Rehabilitasi fisik atau layanan lainnya'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
