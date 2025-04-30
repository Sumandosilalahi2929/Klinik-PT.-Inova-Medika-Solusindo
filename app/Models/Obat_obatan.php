<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat_obatan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function obat_pasien()
    {
        return $this->hasMany(Obat_pasien::class);
    }
}
