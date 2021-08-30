<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tweets = Tweet::all();

        return view('tweet.index', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tweet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $countTweets = Auth::user()->tweets->count();

        if ($countTweets >= 5) {
            return redirect()
                ->route('tweets.create')
                ->with([
                    'status' => 'danger',
                    'message' => 'Error! Tweet cannot be more than 5'
                ]);
        }

        $request->user()->tweets()->create($request->input());

        return redirect()->route('tweets.index')->with([
            'status' => 'success',
            'message' => 'Create tweet success!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tweet  $tweet
     * @return Response
     */
    public function show(Tweet $tweet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tweet  $tweet
     * @return Response
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Tweet  $tweet
     * @return Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tweet  $tweet
     * @return Response
     */
    public function destroy(Tweet $tweet)
    {
        //
    }
}
