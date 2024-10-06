<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function show()
    {
        $posts = Post::latest()->get();
        return view('welcome' , ['posts'=>$posts]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content'=>'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov|max:10000',
        ]);
        $images = [];
        $video_path = NULL;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_path = $image->store('images_uploads' , 'uploads');
                $images[] = $image_path;
            }
        }
        if($request->hasFile('video_path'))
        {
            $file = $request->file('video_path');
            $video_path = $file->store('video_uploads' , 'uploads');
        }

        Post::create([
            'content'=>$request->content,
            'images' => json_encode($images),
            'video_path'=>$video_path,
        ]);
        return redirect()->back();
    }
}
