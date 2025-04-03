<?php

namespace App\Http\Controllers;

use Share;
use App\Models\Tv;
use App\Models\Post;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

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

        $data1 = Post::where('title', 'like', '%' . $search . '%')->orderBy('id', 'desc')->get();
        $data2 = Tv::where('title', 'like', '%' . $search . '%')->orderBy('id', 'desc')->get();
        // Gabungkan kedua collection
        $mergedData = $data1->merge($data2);


        // Pastikan tetap dalam bentuk Collection
        $mergedData = collect($mergedData);

        // Ambil halaman saat ini dari request (default ke 1)
        $page = request()->get('page', 1);

        // Tentukan jumlah item per halaman
        $perPage = 40;

        // Hitung offset untuk data yang akan ditampilkan
        $offset = ($page - 1) * $perPage;

        // Ambil data yang sesuai dengan halaman saat ini
        $items = $mergedData->slice($offset, $perPage);

        // Buat LengthAwarePaginator dengan collection, bukan array
        $data = new LengthAwarePaginator($items, $mergedData->count(), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        request()->flash();
        return view('search', compact('data', 'search'));
    }
    public function movieByGenre($genre)
    {
        $data = Post::where('genre', 'like', '%' . $genre . '%')->orderBy('id', 'desc')->paginate(48);
        return view('genre', compact('data', 'genre'));
    }
    public function movieByYear($year)
    {
        $data = Post::where('release', 'like', '%' . $year . '%')->orderBy('id', 'desc')->paginate(48);
        return view('year', compact('data', 'year'));
    }
    public function movieByCountry($country)
    {
        $data = Post::where('country', 'like', '%' . $country . '%')->orderBy('id', 'desc')->paginate(48);
        return view('country', compact('data', 'country'));
    }
    public function latestMovies()
    {
        $data = Post::orderBy('id', 'desc')->paginate(48);
        return view('latest', compact('data'));
    }
    public function tvSeries()
    {
        $data = Tv::orderBy('id', 'desc')->paginate(48);
        return view('tvseries', compact('data'));
    }
    public function detailTv($slug)
    {
        $tv = Tv::where('slug', $slug)->first();
        Tv::where('slug', $slug)->first()->update(['views' => $tv->views + 1]);
        $semuaEpisode = $tv->episode;
        $data = $tv;

        return view('detail_tv', compact('data', 'semuaEpisode'));
    }
    public function detailMovie($slug)
    {
        $agent = new Agent();
        $data = Post::where('slug', $slug)->first();

        // if ($agent->isMobile()) {
        //     return view('mobile.detail_movie', compact('data'));
        // } else {

        Post::where('slug', $slug)->first()->update(['views' => $data->views + 1]);
        return view('detail_movie', compact('data'));
        //}
    }
    public function detailSeries($slug, $season, $episode)
    {
        $tv = Tv::where('slug', $slug)->first();
        Tv::where('slug', $slug)->first()->update(['views' => $tv->views + 1]);
        $semuaEpisode = $tv->episode;
        $data = $tv->episode->where('season', $season)->where('episode', $episode)->first();

        return view('detail_series', compact('data', 'semuaEpisode'));
    }
}
