<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'content'=>'required',
        ]);
        Reply::create($request->all());
        return redirect()->back();
    }
}
