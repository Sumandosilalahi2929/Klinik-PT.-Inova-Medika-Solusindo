<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_pasien extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class, 'kunjungans_id');
    }
}
