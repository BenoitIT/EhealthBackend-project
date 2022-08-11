<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    use HasFactory;
    protected $fillable=['profile','profile_description','user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
           static function saveImage($image,$path='/image/')
        {
                            $imagename = time().'.'.$image->getClientOriginalExtension();
                            $imagepath = public_path($path);
                            $image->move($imagepath,$imagename);
                            return $path.$imagename;
    }
}
