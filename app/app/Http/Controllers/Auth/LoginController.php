<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        /*$info = $request->only('email','password');
        dd($info);*/
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        /*        auth()->attempt([
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);*/
        if(!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('status', 'Invalid Login Credentials');
        }

        return redirect()->route('dashboard');
    }
}
