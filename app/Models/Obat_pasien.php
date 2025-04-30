<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat_pasien extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungans_id');
    }

    public function obat_obatan()
    {
        return $this->belongsTo(Obat_obatan::class, 'obat_obatans_id');
    }

    public function data_pasien()
    {
        return $this->belongsTo(Data_pasien::class, 'data_pasiens_id');
    }
}
