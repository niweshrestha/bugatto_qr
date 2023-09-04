<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
      
    public function login(Request $request)
    {
        if($request->isMethod('GET'))
        {
            return view('dashboard.pages.login');
        }

        if($request->isMethod('POST'))
        {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
       
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('admin.dashboard')->with('success', "Wel-come back admin");
            }
      
            return redirect()->route('login')->with('error_message', 'Login details are not valid');
        }
    }
}
