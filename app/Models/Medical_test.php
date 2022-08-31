<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_test extends Model
{
    use HasFactory;
    protected $fillable=['patient_id','doctor_id','hospital_id','test_name','test_result','testing_date'];
    public function Patient(){
        return $this->belongsTo(Patient::class);
    }
    public function Doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function Hospital(){
        return $this->belongsTo(Hospital::class);
    }
    public function report(){
        return $this->hasMany(Medical_report::class);
    }
}
