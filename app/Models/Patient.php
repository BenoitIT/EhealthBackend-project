<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $fillable=['FirstName','LastName',
                        'province','district',
                        'Gender','BirthDate',
                        'Telephone','access_password',
                        'assigned_doctor','hospital_id'];

         public function Hospital(){
         
                        }
                    }

