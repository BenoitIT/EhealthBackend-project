<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $fillable=['FirstName','LastName',
                        'province','district',
                        'Gender','BirthDate',
                        'Telephone','password',
                        'assigned_doctor','hospital_id'];

         public function Hospital(){
         return $this->belongsTo(Hospital::class);
                        }
                        public function Test(){
                            return $this->hasMany(Medical_test::class);
                          }
                          public function medecine(){
                            return $this->hasMany(Medecine::class);
                          }
                          public function medicalreport(){
                            return $this->hasMany(Medical_report::class);
                          }
                    }

