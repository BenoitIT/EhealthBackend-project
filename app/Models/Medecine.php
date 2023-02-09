<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecine extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'doctor_id', 'hospital_id', 'medecine_name'];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    public function medicalreport()
    {
        return $this->hasMany(Medical_report::class);
    }
}
