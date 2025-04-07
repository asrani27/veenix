<?php

namespace App\Http\Controllers;

use App\Models\Tv;
use DOMXPath as Xpath;
use App\Models\Episode;
use DOMDocument as DOM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;

class TvController extends Controller
{
    public function index()
    {
        $data = Tv::orderBy('id', 'DESC')->paginate(10);

        return view('superadmin.tv.index', compact('data'));
    }

    public function add()
    {
        return view('superadmin.tv.add');
    }

    public function scrap(Request $req)
    {
        $html = file_get_contents($req->url);
        $html = preg_replace('/\s+/', ' ', trim($html));

        if (strpos($html, 'posting') !== false) {
            $param = muviproIndoTv($req->url);
        }



        $check = Tv::where('slug', $param['slug'])->first();
        if ($check == null) {
            Tv::create($param);
            return redirect('/superadmin/tv');
        } else {
            Session::flash('error', 'Tv series ini sudah di input');
            request()->flash();
            return back();
        }
    }

    public function edit($id)
    {
        $data = Tv::findOrFail($id);
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

        return view('superadmin.tv.edit', compact('data'));
    }

    public function editEpisode($id)
    {
        $data = Episode::findOrFail($id);
        if ($data->link_download == null) {
        } else {
            $data->link_download = implode(', ', json_decode($data->link_download));
        }

        return view('superadmin.tv.editepisode', compact('data'));
    }
    public function updateEpisode(Request $req, $id)
    {
        $param = $req->all();
        if ($req->link_download == null) {
            $param['link_download'] = null;
        } else {
            $param['link_download'] = json_encode(array_map('trim', (explode(',', $req->link_download))));
        }

        $data = Episode::findOrFail($id)->update($param);

        $tv_id = Episode::findOrFail($id)->tvseries->id;

        Session::flash('success', 'Diupdate');
        return redirect('/superadmin/tv/episode/' . $tv_id);
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
            $namafile = Tv::findOrFail($id)->image;
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

        $data = Tv::findOrFail($id)->update($param);
        Session::flash('success', 'Diupdate');
        return redirect('/superadmin/tv');
    }

    public function storeEpisode(Request $req, $id)
    {
        $check = Episode::where('tv_id', $id)->where('season', $req->season)->where('episode', $req->episode)->first();
        if ($check != null) {
            Session::flash('error', 'Season dan Episode sudah ada');
            $req->flash();
            return back();
        } else {

            $html = file_get_contents($req->url);
            $html = preg_replace('/\s+/', ' ', trim($html));

            fixAmps($html, 0);
            $dom = new DOM();
            @$dom->loadHTML($html);
            $xpath = new Xpath($dom);

            if ($xpath->query('//div[@class="entry-content entry-content-single"]//p')->length == 0) {
                $data['description'] = null;
            } else {
                $data['description'] = $xpath->query('//div[@class="entry-content entry-content-single"]//p')->item(0)->nodeValue;
            }
            if ($xpath->query('//div[@class="gmr-embed-responsive"]//iframe/@src')->length == 0) {
                $data['link_video'] = null;
            } else {
                $data['link_video'] = trim($xpath->query('//div[@class="gmr-embed-responsive"]//iframe/@src')->item(0)->nodeValue);
            }

            $quality = null;
            $episode_name = null;


            $detail = $xpath->query('//div[@class="gmr-moviedata"]');

            foreach ($detail as $key => $d) {
                // Get Quality
                if (strpos($d->nodeValue, 'Kualitas') !== false) {
                    $quality = str_replace("Kualitas: ", "", $d->nodeValue);
                }
                // Get Name Episode
                if (strpos($d->nodeValue, 'Nama Episode') !== false) {
                    $episode_name = str_replace("Nama Episode:", "", $d->nodeValue);
                }
            }

            $data['quality'] = $quality;
            $data['title'] = $episode_name;
            $data['season'] = $req->season;
            $data['episode'] = $req->episode;
            $data['tv_id'] = $id;

            Episode::create($data);

            Session::flash('success', 'Berhasil Di Tambahkan');
            return back();
        }
    }
    public function episode($id)
    {
        $data = Tv::findOrFail($id);
        $episode = Episode::where('tv_id', $id)->orderBy('season', 'ASC')->get()->map(function ($item) {
            if ($item->link_download == null) {
                $item->link_download = null;
            } else {
                $item->link_download = json_decode($item->link_download);
            }
            return $item;
        });

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
        return view('superadmin.tv.episode', compact('data', 'episode'));
    }

    public function delete($id)
    {
        Tv::find($id)->episode->map->delete();
        Tv::find($id)->delete();
        Session::flash('success', 'Dihapus');
        return back();
    }
    public function deleteEpisode($id)
    {
        Episode::find($id)->delete();
        Session::flash('success', 'Dihapus');
        return back();
    }

    public function search()
    {
        $search = request()->search;
        $data = Tv::where('username', Auth::user()->username)->where('title', 'like', '%' . $search . '%')->paginate(10)->withQueryString();
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
        request()->flash();
        return view('superadmin.tv.index', compact('data'));
    }
}
