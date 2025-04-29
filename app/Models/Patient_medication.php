<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_medication extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visits_id');
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class, 'drugs_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patients_id');
    }
}
