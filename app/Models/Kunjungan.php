<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function data_pasien()
    {
        return $this->belongsTo(Data_pasien::class, 'data_pasiens_id');
    }

    public function data_pegawai()
    {
        return $this->belongsTo(Data_pegawai::class, 'data_pegawais_id');
    }


    public function obat_pasien()
    {
        return $this->hasMany(Obat_pasien::class, 'visit_id');
    }

    public function tagihan()
    {
        return $this->hasOne(Tagihan::class, 'visit_id');
    }
}
