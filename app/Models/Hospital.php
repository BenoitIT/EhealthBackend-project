<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Authenticatable
{
    use HasFactory, HasApiTokens,Notifiable;
    public $timestamps=false;
    protected $fillable=['hospital_name','hospital_Admin','province','district',
    'password','hospital_OwnershipType','created_at','updated_at'];
}
