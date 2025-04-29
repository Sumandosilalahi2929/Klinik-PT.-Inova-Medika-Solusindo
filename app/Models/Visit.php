<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi untuk pasien
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patients_id');
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employees_id');
    }


    public function patientActions()
    {
        return $this->hasMany(Patient_actions::class, 'visit_id');
    }


    public function patientMedications()
    {
        return $this->hasMany(Patient_medication::class, 'visit_id');
    }

    public function bill()
    {
        return $this->hasOne(Bill::class, 'visit_id');
    }
}
