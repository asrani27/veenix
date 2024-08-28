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
    public function request()
    {
        return view('request');
    }
    public function search()
    {
        $search = request()->search;

        $data = Post::where('title', 'like', '%' . $search . '%')->paginate(16);
        request()->flash();
        return view('search', compact('data', 'search'));
    }
    public function movieByGenre($genre)
    {
        $data = Post::where('genre', 'like', '%' . $genre . '%')->paginate(16);
        return view('genre', compact('data', 'genre'));
    }
    public function movieByYear($year)
    {
        $data = Post::where('release', 'like', '%' . $year . '%')->paginate(16);
        return view('year', compact('data', 'year'));
    }
    public function movieByCountry($country)
    {
        $data = Post::where('country', 'like', '%' . $country . '%')->paginate(16);
        return view('country', compact('data', 'country'));
    }
    public function latestMovies()
    {
        $data = Post::orderBy('id', 'desc')->paginate(32);
        return view('latest', compact('data'));
    }

    public function detailMovie($slug)
    {
        $data = Post::where('slug', $slug)->first();
        //update views 
        Post::where('slug', $slug)->first()->update(['views' => $data->views + 1]);
        return view('detail_movie', compact('data'));
    }
    public function detailSeries($slug)
    {
        $data = Post::where('slug', $slug)->first();
        return view('detail_series', compact('data'));
    }
}
