<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginPage () {
        return view('login');
    }

    public function login (Request $req) {
        $credentials = [
            'email' => $req->email,
            'password' => $req->password
        ];

        if ($req->remember){
            Cookie::queue('mycookie', $req->email, 60);
        }
        if (Auth::attempt($credentials)){
            Session::put('mysession', $credentials);
            return redirect('home');
        }

        $fail = 'Login Failed!';
        if (Session::get('locale') == 'id') {
            $fail = 'Gagal';
        }
        return redirect()->back()->with(['loginError' => $fail]);
    }

    public function logout () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

    public function adminPage () {
        return view('admin');
    }
}
