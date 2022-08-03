<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reciptionist extends Model
{
    use HasFactory;
    protected $fillable=['FirstName',
    'LastName',
    'email',
    'Gender',
    'BirthDate','Telephone',
    'reciptionist_Image','hospital_id'];
     static function saveImage($image,$path='/image')
                        {
                            $imagename=time().'.'.$image->getClientOriginalExtension();
                            $imagepath=public_path($path);
                            $image->move($imagepath,$imagename);
                           return $path.$imagename;
                        }
 public function Hospital(){
         return $this->belongsTo(Hospital::class);
                          }
}
