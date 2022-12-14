<?php

namespace App\Models;

use App\Models\Reciptionist;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Hospital extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    public $timestamps = false;
    protected $fillable = [
        'hospital_name', 'hospital_Admin', 'province', 'district',
        'hospital_OwnershipType', 'created_at', 'updated_at', 'hospital_email', 'password', 'role'
    ];

    public function Doctor()
    {
        return $this->hasMany(Doctor::class);
    }
    public function Reciptionist()
    {
        return $this->hasMany(Reciptionist::class);
    }
    public function Hospital()
    {
        return $this->hasMany(Hospital::class);
    }
    public function Test()
    {
        return $this->hasMany(Medical_test::class);
    }
    public function medecine()
    {
        return $this->hasMany(Medecine::class);
    }
    public function medicalreport()
    {
        return $this->hasMany(Medical_report::class);
    }
}
