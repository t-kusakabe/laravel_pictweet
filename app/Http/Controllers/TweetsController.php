<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tweet;
use Auth;
use App\Comment;
use Input;


class TweetsController extends Controller
{
    public function index()
    {
        $tweets = Tweet::orderBy('created_at', 'DESC')->paginate(5);
        return view('tweets.index')->with('tweets', $tweets);
    }

    public function show($id)
    {
        $tweet = Tweet::findOrFail($id);
        $comments = $tweet->comments()->get();
        return view('tweets.show', compact('tweet', 'comments'));
    }

    public function create()
    {
        return view('tweets.create');
    }

    public function store(Request $request)
    {
        Tweet::create([
            'text' =>  $request->text,
            'image' => $request->image,
            'user_id' => Auth::user()->id
        ]);

        return view('tweets.store');
    }

    public function edit($id)
    {
        $tweet = Tweet::findOrFail($id);
        return view('tweets.edit')->with('tweet', $tweet);
    }

    public function update($id, Request $request)
    {
        Tweet::findOrFail($id)->update([
            'text' => $request->text,
            'image' => $request->image
        ]);

        return view('tweets.update');
    }

    public function destroy($id)
    {
        Tweet::destroy($id);
        return view('tweets.destroy');
    }
}
