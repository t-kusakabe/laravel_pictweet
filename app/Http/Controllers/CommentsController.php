<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Tweet;
use Auth;

class CommentsController extends Controller
{
    public function store($id, Request $request)
    {
    	$tweet = Tweet::findOrFail($id);
    	$tweet->comments()->create([
            'user_id' => Auth::user()->id,
            'text' => $request->text
        ]);

        return redirect("tweets/{$tweet->id}");
    }
}
