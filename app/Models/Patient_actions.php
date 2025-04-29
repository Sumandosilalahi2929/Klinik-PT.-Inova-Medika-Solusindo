<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_actions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function visit()
    {
        return $this->belongsTo(visit::class);
    }
    public function action()
    {
        return $this->belongsTo(action::class);
    }
}
