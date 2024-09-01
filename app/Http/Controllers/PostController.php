<?php

namespace App\Http\Controllers;

use App\Jobs\DeadLinkVideo;
use App\Models\Post;
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

    public function edit($id)
    {
        $data = Post::findOrFail($id);
        $data->genre = implode(', ', json_decode($data->genre));
        $data->actor = implode(', ', json_decode($data->actor));
        $data->country = implode(', ', json_decode($data->country));

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
        return redirect('/superadmin/post');
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        return back();
    }

    public function scrap(Request $req)
    {
        $html = file_get_contents($req->url);
        $html = preg_replace('/\s+/', ' ', trim($html));

        if (strpos($html, 'posting') !== false) {
            $param = muviproIndo($req->url);
        } else {
            $param = muviproEnglish($req->url);
        }



        $check = Post::where('slug', $param['slug'])->first();
        if ($check == null) {
            Post::create($param);
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
            $item->genre = implode(", ", json_decode($item->genre));
            $item->country = implode(", ", json_decode($item->country));
            $item->actor = implode(", ", json_decode($item->actor));
            return $item;
        });
        request()->flash();
        return view('superadmin.post.index', compact('data'));
    }
}
