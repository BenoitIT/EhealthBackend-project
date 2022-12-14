<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_report extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'doctor_id', 'hospital_id', 'test_id', 'medecine_id'];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    public function medecine()
    {
        return $this->belongsTo(Medecine::class);
    }
    public function test()
    {
        return $this->hasMany(Medical_test::class);
    }
}
