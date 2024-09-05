<?php

namespace App\Http\Controllers;

use Share;
use App\Models\Tv;
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

        $data = Post::where('title', 'like', '%' . $search . '%')->paginate(32);
        request()->flash();
        return view('search', compact('data', 'search'));
    }
    public function movieByGenre($genre)
    {
        $data = Post::where('genre', 'like', '%' . $genre . '%')->paginate(32);
        return view('genre', compact('data', 'genre'));
    }
    public function movieByYear($year)
    {
        $data = Post::where('release', 'like', '%' . $year . '%')->paginate(32);
        return view('year', compact('data', 'year'));
    }
    public function movieByCountry($country)
    {
        $data = Post::where('country', 'like', '%' . $country . '%')->paginate(32);
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

        $shareButton = Share::page(url('/movie/' . $slug), 'Nonton film ini...',)
            ->facebook()
            ->telegram()
            ->linkedin()
            ->whatsapp()
            ->reddit()
            ->twitter()
            ->pinterest();
        //update views 
        Post::where('slug', $slug)->first()->update(['views' => $data->views + 1]);
        return view('detail_movie', compact('data', 'shareButton'));
    }
    public function detailSeries($slug, $season, $episode)
    {
        $tv = Tv::where('slug', $slug)->first();
        $semuaEpisode = $tv->episode;
        $data = $tv->episode->where('season', $season)->where('episode', $episode)->first();

        return view('detail_series', compact('data', 'semuaEpisode'));
    }
}
