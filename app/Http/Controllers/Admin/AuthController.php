<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function postlogin(Request $request)
    {
        $checklogin = Auth::guard('admin')->attempt($request->only('email','password'));
        if(!$checklogin)
        {
            return redirect()->back()->with('error','Email and password dont match');
        }
        return redirect('/admin')->with('success','welcome admin');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('/admin/login');
    }
}
