<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_blog extends Model
{
    use HasFactory;
    protected $fillable=['title','blog_file','description'];
    static function saveBlogs($image,$path='/blogs/')
                        {
                            $imagename=time().'.'.$image->getClientOriginalExtension();
                            $imagepath=public_path($path);
                            $image->move($imagepath,$imagename);
                            return $path.$imagename;
                        }
}
