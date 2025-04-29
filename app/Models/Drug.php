<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Patient_medication()
    {
        return $this->hasMany(Patient_medication::class);
    }
}
