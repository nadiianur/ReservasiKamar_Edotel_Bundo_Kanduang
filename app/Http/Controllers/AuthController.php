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
            'email' => 'required|unique:users,email',
            'password'  => 'required|min:8' ,
            'no_hp' => 'required|numeric',
            'jenis_kelamin'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect('signUp')->withErrors($validator)->withInput();
        }

        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password'  => 'required|min:8' ,
            'no_hp' => 'required|numeric',
            'jenis_kelamin'=>'required'
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'customer';

        User::create($data);
        return redirect('signIn')->with('success', 'Registration Successful!');
    }

    public function show()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    Public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        // Update profile
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');
        $user->jenis_kelamin = $request->input('jenis_kelamin');

        $user->save();
        return redirect('profile')->with('success', 'Profile updated successfully.');
    }

    public function showUpdatePass()
    {
        $user = Auth::user();
        return view('profile.updatePass', compact('user'));
    }

    Public function updatePass(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password',
        ]);

        // cek old password
        if (!Hash::check($request->input('old_password'),  $user->password)) {
            return redirect()->back()->withErrors(['error' => 'The old password does not match']);
        }

        //update pass
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('updatePassword')->with('success', 'Password updated successfully.');
    }

    public function logOut(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/signIn')->with('success', 'You have been logged out.');
    }
}
