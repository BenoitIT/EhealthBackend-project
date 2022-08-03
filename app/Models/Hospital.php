<?php

namespace App\Models;
use App\Models\Reciptionist;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Hospital extends Authenticatable
{
    use HasFactory, HasApiTokens,Notifiable;
    public $timestamps=false;
    protected $fillable=['hospital_name','hospital_Admin','province','district',
    'password','hospital_OwnershipType','created_at','updated_at'];

    public function Doctor(){
    return $this->hasMany(Doctor::class);
    }
    public function Reciptionist(){
        return $this->hasMany(Reciptionist::class);
        }
}

