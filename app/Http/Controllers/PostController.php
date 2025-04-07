<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Jobs\DeadLinkVideo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::orderBy('id', 'DESC')->paginate(10);
        $data->getCollection()->transform(function ($item) {
            if ($item->genre == null) {
                $item->genre = null;
            } else {
                $item->genre = implode(", ", json_decode($item->genre));
            }
            if ($item->country == null) {
                $item->country = null;
            } else {
                $item->country = implode(", ", json_decode($item->country));
            }

            if ($item->actor == null) {
                $item->actor = null;
            } else {
                $item->actor = implode(", ", json_decode($item->actor));
            }

            if ($item->link_download != null) {
                $item->link_download = json_decode($item->link_download);
            }
            return $item;
        });

        return view('superadmin.post.index', compact('data'));
    }

    public function add()
    {
        return view('superadmin.post.add');
    }
    public function create()
    {
        return view('superadmin.post.create');
    }
    public function store(Request $req)
    {
        if ($req->image != null) {
            $validator = Validator::make($req->all(), [
                'image' => 'mimes:png,jpg,jpeg|max:1024',
            ]);

            if ($validator->fails()) {
                Session::flash('error', 'Format Harus PNG/JPG max 1024');
                return back();
            }

            $image = Image::read($req->file('image'));
            $filename = time() . '-' . str_replace(" ", "", $req->file('image')->getClientOriginalName());

            $destinationPathThumbnail = public_path('storage/poster/');

            $image->resize(175, 260);
            $image->save($destinationPathThumbnail . $filename);
            if (config('app.env') == 'local') {
                $namafile = config('app.url') . ':8000/storage/poster/' . $filename;
            } else {
                $namafile = config('app.url') . '/storage/poster/' . $filename;
            }
        } else {
            $namafile = null;
        }
        $param = $req->all();

        $param['username'] = Auth::user()->username;
        $param['slug'] = Str::of($req->title)->slug('-')->value();

        $param['image'] = $namafile;
        $param['genre'] = json_encode(array_map('trim', (explode(',', $req->genre))));
        $param['country'] = json_encode(array_map('trim', (explode(',', $req->country))));
        $param['actor'] = json_encode(array_map('trim', (explode(',', $req->actor))));
        if ($req->link_download == null) {
            $param['link_download'] = null;
        } else {
            $param['link_download'] = json_encode(array_map('trim', (explode(',', $req->link_download))));
        }

        $data = Post::create($param);
        Session::flash('success', 'Disimpan');
        return redirect('/superadmin/post');
    }
    public function edit($id)
    {
        $data = Post::findOrFail($id);
        if ($data->genre == null) {
            $data->genre = null;
        } else {
            $data->genre = implode(', ', json_decode($data->genre));
        }
        if ($data->actor == null) {
            $data->actor = null;
        } else {
            $data->actor = implode(', ', json_decode($data->actor));
        }
        if ($data->country == null) {
            $data->country = null;
        } else {
            $data->country = implode(', ', json_decode($data->country));
        }

        if ($data->link_download == null) {
        } else {
            $data->link_download = implode(', ', json_decode($data->link_download));
        }

        return view('superadmin.post.edit', compact('data'));
    }
    public function update(Request $req, $id)
    {
        if ($req->image != null) {
            $validator = Validator::make($req->all(), [
                'image' => 'mimes:png,jpg,jpeg|max:1024',
            ]);

            if ($validator->fails()) {
                Session::flash('error', 'Format Harus PNG/JPG max 1024');
                return back();
            }

            $image = Image::read($req->file('image'));
            $filename = time() . '-' . str_replace(" ", "", $req->file('image')->getClientOriginalName());

            $destinationPathThumbnail = public_path('storage/poster/');

            $image->resize(175, 260);
            $image->save($destinationPathThumbnail . $filename);
            if (config('app.env') == 'local') {
                $namafile = config('app.url') . ':8000/storage/poster/' . $filename;
            } else {
                $namafile = config('app.url') . '/storage/poster/' . $filename;
            }
        } else {
            $namafile = Post::findOrFail($id)->image;
        }
        $param = $req->all();
        $param['image'] = $namafile;
        $param['genre'] = json_encode(array_map('trim', (explode(',', $req->genre))));
        $param['country'] = json_encode(array_map('trim', (explode(',', $req->country))));
        $param['actor'] = json_encode(array_map('trim', (explode(',', $req->actor))));
        if ($req->link_download == null) {
            $param['link_download'] = null;
        } else {
            $param['link_download'] = json_encode(array_map('trim', (explode(',', $req->link_download))));
        }

        $data = Post::findOrFail($id)->update($param);
        Session::flash('success', 'DiUpdate');
        return redirect('/superadmin/post');
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        Session::flash('success', 'Dihapus');
        return back();
    }

    public function scrap(Request $req)
    {
        // URL yang akan di-scrape
        $url = $req->url;

        // Inisialisasi cURL
        $ch = curl_init();

        // Set opsi cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Set URL tujuan
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Agar hasil dikembalikan sebagai string, bukan langsung ditampilkan
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Ikuti redirect jika ada
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Lewati verifikasi SSL (opsional, hanya jika ada masalah SSL)
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3"); // Set User-Agent seperti browser

        // Eksekusi permintaan cURL
        $response = curl_exec($ch);

        // Cek apakah ada error
        if (curl_errno($ch)) {
            // Tampilkan error jika ada
            $html = 'Error: ' . curl_error($ch);
        } else {
            // Tampilkan hasil scraping (HTML dari halaman yang diakses)
            $html = $response;
        }
        // Tutup sesi cURL
        curl_close($ch);

        $html = preg_replace('/\s+/', ' ', trim($html));

        if (strpos($html, 'posting') !== false) {
            $param = muviproIndo($html);
        } else {
            $param = muviproEnglish($html);
        }



        $check = Post::where('slug', $param['slug'])->first();
        if ($check == null) {
            Post::create($param);
            Session::flash('success', 'Disimpan');
            return redirect('/superadmin/post');
        } else {
            Session::flash('error', 'Movie ini sudah di input');
            request()->flash();
            return back();
        }
    }

    public function search()
    {
        $search = request()->search;
        $data = Post::where('title', 'like', '%' . $search . '%')->paginate(10)->withQueryString();
        $data->getCollection()->transform(function ($item) {
            if ($item->genre == null) {
                $item->genre = null;
            } else {
                $item->genre = implode(", ", json_decode($item->genre));
            }
            if ($item->country == null) {
                $item->country = null;
            } else {
                $item->country = implode(", ", json_decode($item->country));
            }

            if ($item->actor == null) {
                $item->actor = null;
            } else {
                $item->actor = implode(", ", json_decode($item->actor));
            }

            if ($item->link_download != null) {
                $item->link_download = json_decode($item->link_download);
            }
            return $item;
        });
        // $data->getCollection()->transform(function ($item) {
        //     $item->genre = implode(", ", json_decode($item->genre));
        //     $item->country = implode(", ", json_decode($item->country));
        //     $item->actor = implode(", ", json_decode($item->actor));
        //     return $item;
        // });
        request()->flash();

        return view('superadmin.post.index', compact('data'));
    }
}
