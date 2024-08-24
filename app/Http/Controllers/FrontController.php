<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/superadmin/beranda');
        } else {
            return view('welcome');
        }
    }
    public function detailMovie($slug)
    {
        $data = Post::where('slug', $slug)->first();
        return view('detail_movie', compact('data'));
    }
    public function detailSeries($slug)
    {
        $data = Post::where('slug', $slug)->first();
        return view('detail_series', compact('data'));
    }
}
