<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view('user.beranda.index');
    }
    public function gantipass()
    {
        return view('user.gantipass');
    }

    public function update_pass(Request $req)
    {
        if ($req->password != $req->confirm_password) {
            Session::flash('error', 'Password Tidak Sama');
            return back();
        } else {
            Auth::user()->update([
                'password' => Hash::make($req->password)
            ]);
            Session::flash('success', 'berhasil di ganti');
            return back();
        }
    }
}
