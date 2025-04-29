<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function patient_action()
    {
        return $this->hasMany(Patient_actions::class);
    }
    public function patient_medication()
    {
        return $this->hasMany(Patient_medication::class);
    }
    public function bill()
    {
        return $this->hasOne(Bill::class);
    }
}
