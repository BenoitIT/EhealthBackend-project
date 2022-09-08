<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'FirstName',
        'LastName',
        'doctor_email',
        'doctor_Gender',
        'BirthDate', 'Telephone',
        'doctor_Image', 'hospital_id'
    ];

    //    static function saveImage($image,$path='/image/')
    //             {
    //                 $imagename=time().'.'.$image->getClientOriginalExtension();
    //                 $imagepath=public_path($path);
    //                 $image->move($imagepath,$imagename);
    //                 return $path.$imagename;
    //             }
    public function Hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    public function Test()
    {
        return $this->hasMany(Medical_test::class);
    }
    public function medecine()
    {
        return $this->hasMany(Medecine::class);
    }
}
