<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function registerPage () {
        return view('register');
    }

    public function register (Request $req) {
        $validatedData = $req->validate([
            'username'=> 'required|unique:users||min:5|max:20',
            'email'=> 'required|email:dns|unique:users',
            'password'=> 'required|min:5|max:20',
            'phone_number' => 'required|min:10|max:13',
            'address' => 'required|min:5'
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $new_user = User::create($validatedData);
        Cart::insert(['user_id' => $new_user->id]);

        $success = 'Registration Success!';
        if (Session::get('locale') == 'id') {
            $success = 'Registrasi Sukses!';
        }
        return redirect('login')->with(['success' => $success]);
    }

    public function profilePage () {
        return view('profile');
    }

    public function editProfile () {
        return view ('edit_profile');
    }

    public function updateProfile (Request $req) {
        $user_id = auth()->user()->id;
        $validatedData = $req->validate([
            'username'=>'required|unique:users||min:5|max:20',
            'email'=> 'required|email:dns|unique:users',
            'phone_number'=> 'required|min:10|max:13',
            'address'=>'required|min:5'
        ]);
        User::where('id', $user_id)->update($validatedData);

        $success = 'Profile has been changed.';
        if (Session::get('locale') == 'id') {
            $success = 'Profil berhasil diubah.';
        }
        return redirect('profile')->with(['editProfileSuccess' => $success]);
    }

    public function editPassword () {
        return view ('edit_password');
    }

    public function updatePassword (Request $req) {
        $user = auth()->user();
        $validatedData = $req->validate([
            'old_password'=>'required|min:5|max:20',
            'new_password'=>'required|min:5|max:20'
        ]);

        $old_password = $user->password;
        if (Hash::check($validatedData['old_password'], $old_password)) {
            User::where('id', $user->id)->update([
                'password' => bcrypt($validatedData['new_password']),
                'updated_at' => Carbon::now(),
            ]);

            $success = 'Password has been updated.';
            if (Session::get('locale') == 'id') {
                $success = 'Kata Sandi berhasil diperbaharui.';
            }
            return redirect('profile')->with(['editPasswordSuccess' => $success]);
        } else {
            $fail = 'Wrong password!';
            if (Session::get('locale') == 'id') {
                $fail = 'Kata Sandi salah.';
            }
            return redirect()->back()->with(['wrongPassword' => $fail]);
        }
    }
}
