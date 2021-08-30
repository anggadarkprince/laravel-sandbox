<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     */
    public function auth(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            return redirect()->to('tweets');
        } else {
            return redirect()->to('login')->with([
                'status' => 'danger',
                'message' => 'Username or password wrong'
            ]);
        }
    }

}
