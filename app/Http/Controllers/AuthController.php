<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showlogin()
    {
    	return view('auth.login');
    }
    public function login(Request $request)
    {
    	if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) )
    	{
    		if (Auth::User()->status =='admin')
    		{
    			return redirect('/admin');
    		}
    		else
    		{
    			return redirect('/member');
    		}
    	}
    	else
    	{
    		return redirect ('/login');
    	}
    }
	public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function home()
    {
    	return view ('admin.admin');
    }
    public function homemember()
    {
    	return view('member.home');
    }
    public function hak()
    {
        return view('hak');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
