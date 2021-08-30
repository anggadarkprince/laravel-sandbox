<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function follow(Request $request)
    {
        $request->user()->followings()->attach($request->input('user_id'));
    }
}
