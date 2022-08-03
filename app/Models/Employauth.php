<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employauth extends Authenticatable
{
    use HasFactory, HasApiTokens,Notifiable;
    protected $fillable=['empl_names','email','password','access_role'];
}
