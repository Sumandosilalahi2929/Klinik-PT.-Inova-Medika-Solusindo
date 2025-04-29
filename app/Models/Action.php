<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patient_action()
    {
        return $this->hasMany(Patient_actions::class);
    }
}
