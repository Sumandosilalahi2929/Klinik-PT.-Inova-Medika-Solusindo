<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan_medis extends Model
{
    use HasFactory;

    protected $table = 'tindakan_medis';

    protected $guarded = [];

    public function pasien()
    {
        return $this->belongsTo(Data_pasien::class, 'data_pasiens_id');
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungans_id');
    }
}
