<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihans';

    protected $fillable = [
        'data_pasiens_id',
        'kunjungans_id',
        'obat_pasiens_id',
        'total_amount',
        'status',
    ];

    /**
     * Relasi dengan model DataPasien
     */
    public function data_pasien()
    {
        return $this->belongsTo(Data_pasien::class, 'data_pasiens_id');
    }

    public function obat_pasien()
    {
        return $this->belongsTo(obat_pasien::class, 'obat_pasiens_id');
    }

    /**
     * Relasi dengan model Kunjungan
     */
    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungans_id');
    }
}
