<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;

class PostUserController extends Controller
{
    public function index()
    {
        $data = Post::where('username', Auth::user()->username)->orderBy('id', 'DESC')->paginate(10);
        $data->getCollection()->transform(function ($item) {
            $item->genre = implode(", ", json_decode($item->genre));
            $item->country = implode(", ", json_decode($item->country));
            $item->actor = implode(", ", json_decode($item->actor));
            return $item;
        });

        return view('user.post.index', compact('data'));
    }

    public function add()
    {
        return view('user.post.add');
    }

    public function edit($id)
    {
        $data = Post::findOrFail($id);
        $data->genre = implode(', ', json_decode($data->genre));
        $data->actor = implode(', ', json_decode($data->actor));
        $data->country = implode(', ', json_decode($data->country));

        return view('user.post.edit', compact('data'));
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

        $data = Post::findOrFail($id)->update($param);
        return redirect('/user/post');
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        return back();
    }

    public function scrap(Request $req)
    {
        $url = $req->url;
        $url = parse_url($url);
        $domain = $url['host'];
        if ($domain == 'senatorpeters.com') {
            $param = senatorPeters($req->url);
        }

        //save
        Post::create($param);

        return redirect('/user/post');
    }

    public function search()
    {
        $search = request()->search;
        $data = Post::where('username', Auth::user()->username)->where('title', 'like', '%' . $search . '%')->paginate(10)->withQueryString();
        $data->getCollection()->transform(function ($item) {
            $item->genre = implode(", ", json_decode($item->genre));
            $item->country = implode(", ", json_decode($item->country));
            $item->actor = implode(", ", json_decode($item->actor));
            return $item;
        });
        request()->flash();
        return view('user.post.index', compact('data'));
    }
}
