<?php

namespace App\Http\Controllers;

use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class AuthController extends Controller
{
    function getSignIn(){
        return view("auth.signIn");
    }

    function signIn(Request $request){
        // Session::flash('email', $request->email);
        $credentials = $request->validate([
            'email'  => 'required',
            'password'  => 'required'
        ]);

        //cek apakah login valid
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'email' => 'Email atau Password Salah',
        ]);

    }
    function getSignUp(){
        return view("auth.signUp");
    }

    function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password'  => 'required|min:8' ,
            'no_hp' => 'required|max:12|numeric',
            'jenis_kelamin'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect('signUp')->withErrors($validator)->withInput();
        }

        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password'  => 'required|min:8' ,
            'no_hp' => 'required|max:12|numeric',
            'jenis_kelamin'=>'required'
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'customer';

        User::create($data);
        return redirect('dashboard')->withErrors($data)->with('success', 'Registration Successful!');
    }
}
