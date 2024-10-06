<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'content'=>'required',
        ]);
        Comment::create($request->all());
        return redirect()->back();
    }
}
