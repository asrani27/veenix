<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->roles == 'superadmin') {
                Session::flash('success', 'Selamat Datang');
                return redirect('/superadmin/beranda');
            } elseif (Auth::user()->roles == 'anggota') {
                Session::flash('success', 'Selamat Datang');
                return redirect('/user/beranda');
            } else {
                Session::flash('success', 'Selamat Datang');
                return 'role lain';
            }
        }
        return view('login');
    }
    public function login(Request $req)
    {
        $remember = $req->remember ? true : false;
        $credential = $req->only('username', 'password');

        if (Auth::attempt($credential, $remember)) {

            if (Auth::user()->roles == 'superadmin') {
                Session::flash('success', 'Selamat Datang');
                return redirect('/superadmin/beranda');
            } elseif (Auth::user()->roles == 'anggota') {
                Session::flash('success', 'Selamat Datang');
                return redirect('/user/beranda');
            } else {
                Session::flash('success', 'Selamat Datang');
                return 'role lain';
            }
        } else {
            Session::flash('error', 'username/password salah');
            $req->flash();
            return back();
        }
    }
}
