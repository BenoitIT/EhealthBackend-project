<?php

namespace App\Http\Controllers;

use App\Models\Medical_blog;
use Illuminate\Http\Request;

class MedicalBlogsController extends Controller
{
    //
    public function store(request $request){
        if(auth()->user()->role== 1){
        $request->validate([
            'title'=>'required',
            'blog_file'=>'required',
            'description'=>'required'
        ]);
        $BlogFile = Medical_blog::saveBlogs($request->file('blog_file'));
        Medical_blog::create([
            'title'=>$request->title,
            'blog_file'=> $BlogFile,
            'description'=>$request->description
        ]);
        return response([
            'message'=>'medical blog created'
        ]);
    }
    else{
        return response(['message'=>'you are not allowed']);
    }
    }
    public function show(){
        $blogs= Medical_blog::all();
        return response([
            'blogs'=>$blogs
        ]);

    }
    public function delete(Medical_blog $blog){
        if(auth()->user()->role== 1){
    Medical_blog::where('id',$blog)->delete();
    return response([
        'message'=>'deleted'
    ]);
}
else{
    return response(['message'=>'you are not allowed']);
}}
}
