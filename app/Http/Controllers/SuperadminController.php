<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Setting;
use App\Jobs\DeadLinkVideo;
use Illuminate\Http\Request;
use App\Models\KurikulumDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;

class SuperadminController extends Controller
{
    public function deadlinkvideo()
    {
        foreach (Post::get() as $uri) {
            DeadLinkVideo::dispatch($uri);
        }
        Session::flash('success', 'Diproses');
        return back();
    }
    public function topmovie(Request $req)
    {
        if (topmovie()->count() == 8) {
            Session::flash('info', 'Top Movie Maks 8, Hapus dulu jika ingin menambahkan');
            return back();
        } else {
            $data = Post::find($req->movie_id);
            $data->top = 'Y';
            $data->save();
            return back();
        }
    }

    public function deletetopmovie($id)
    {
        Post::find($id)->delete();
        Session::flash('success', 'dihapus');
        return back();
    }
    public function deadlinkvideo_list()
    {
        $data = Post::where('dead_link_video', 1)->get();
        return view('superadmin.beranda.deadlink', compact('data'));
    }

    public function deadlinkvideo_update(Request $req, $id)
    {
        $data = Post::find($id)->update([
            'dead_link_video' => 0,
            'link_video' => $req->link_video
        ]);
        return back();
    }
    public function gantipass()
    {
        return view('superadmin.gantipass');
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

    public function portal()
    {
        Session::flash('info', 'dalam pengembangan');
        return redirect('/superadmin/beranda');
    }
    public function beranda()
    {
        return view('superadmin.beranda.index');
    }

    public function user()
    {
        $data = User::where('name', '!=', 'superadmin')->paginate(10);
        return view('superadmin.user.index', compact('data'));
    }
    public function user_add()
    {
        return view('superadmin.user.add');
    }

    public function user_delete($id)
    {
        User::find($id)->delete();
        return back();
    }

    public function user_store(Request $req)
    {
        $check = User::where('username', $req->username)->first();
        if ($check == null) {
            $n = new User;
            $n->name = $req->name;
            $n->username = $req->username;
            $n->password = Hash::make($req->password);
            $n->roles = 'anggota';
            $n->save();
        } else {
            Session::flash('error', 'username sudah ada, silahkan ganti yang lain');
            return back();
        }
        return redirect('/superadmin/user');
    }
    public function logo()
    {
        $data = Setting::first();
        return view('superadmin.setting.logo', compact('data'));
    }
    public function logo_update(Request $req)
    {
        if ($req->logo != null) {
            $validator = Validator::make($req->all(), [
                'logo' => 'mimes:png,jpg,jpeg|max:1024',
            ]);

            if ($validator->fails()) {
                Session::flash('error', 'Format Harus PNG/JPG max 1024');
                return back();
            }

            $image = Image::read($req->file('logo'));
            $filename = time() . '-' . str_replace(" ", "", $req->file('logo')->getClientOriginalName());

            $destinationPathThumbnail = public_path('storage/poster/');

            $image->resize(275, 50);
            $image->save($destinationPathThumbnail . $filename);
            if (config('app.env') == 'local') {
                $namafile = config('app.url') . ':8000/storage/poster/' . $filename;
            } else {
                $namafile = config('app.url') . '/storage/poster/' . $filename;
            }
        } else {
            $namafile = Setting::first()->logo;
        }

        if (Setting::first() == null) {
            $n = new Setting();
            $n->logo = $namafile;
            $n->save();
        } else {
            Setting::first()->update([
                'logo' => $namafile
            ]);
        }
        Session::flash('success', 'diupdate');
        return back();
    }

    public function histats()
    {
        $data = Setting::first();
        return view('superadmin.setting.histats', compact('data'));
    }
    public function histats_update(Request $req)
    {
        if (Setting::first() == null) {
            $n = new Setting();
            $n->histats = $req->histats;
            $n->save();
        } else {
            Setting::first()->update([
                'histats' => $req->histats
            ]);
        }
        Session::flash('success', 'diupdate');
        return back();
    }
    public function disquss()
    {
        $data = Setting::first();
        return view('superadmin.setting.disquss', compact('data'));
    }
    public function disquss_update(Request $req)
    {
        Setting::first()->update([
            'disquss' => $req->disquss
        ]);
        Session::flash('success', 'diupdate');
        return back();
    }


    public function periode()
    {
        $data = Periode::get();
        return view('superadmin.periode.index', compact('data'));
    }
    public function periode_add()
    {
        return view('superadmin.periode.add');
    }
    public function periode_store(Request $req)
    {
        $check = Periode::where('tahun', $req->tahun)->where('semester', $req->semester)->first();
        if ($check == null) {
            Periode::create($req->all());
            Session::flash('success', 'Di simpan');
            return redirect('/superadmin/data/periode');
        } else {
            Session::flash('error', 'Periode Sudah ada');
            return redirect('/superadmin/data/periode');
        }
    }
    public function periode_edit($id)
    {
        $data = Periode::findOrFail($id);
        return view('superadmin.periode.edit', compact('data'));
    }
    public function periode_update(Request $req, $id)
    {
        Periode::find($id)->update($req->all());
        Session::flash('success', 'Di Update');
        return redirect('/superadmin/data/periode');
    }
    public function periode_delete(Request $req)
    {
        Periode::findOrFail($req->id)->delete();
        Session::flash('success', 'Di Hapus');
        return back();
    }

    public function jurusan()
    {
        $data = Jurusan::get();
        return view('superadmin.jurusan.index', compact('data'));
    }
    public function jurusan_add()
    {
        return view('superadmin.jurusan.add');
    }
    public function jurusan_store(Request $req)
    {
        Jurusan::create($req->all());
        Session::flash('success', 'Di simpan');
        return redirect('/superadmin/data/jurusan');
    }
    public function jurusan_edit($id)
    {
        $data = Jurusan::findOrFail($id);
        return view('superadmin.jurusan.edit', compact('data'));
    }
    public function jurusan_update(Request $req, $id)
    {
        Jurusan::find($id)->update($req->all());
        Session::flash('success', 'Di Update');
        return redirect('/superadmin/data/jurusan');
    }
    public function jurusan_delete(Request $req)
    {
        Jurusan::findOrFail($req->id)->delete();
        Session::flash('success', 'Di Hapus');
        return back();
    }

    public function role()
    {
        $data = Role::get();
        return view('superadmin.role.index', compact('data'));
    }
    public function role_add()
    {
        return view('superadmin.role.add');
    }
    public function role_store(Request $req)
    {
        $check = Role::where('name', $req->name)->first();
        if ($check == null) {
            Role::create($req->all());
            Session::flash('success', 'Di simpan');
            return redirect('/superadmin/setting/role');
        } else {
            Session::flash('info', 'role sudah ada');
            return back();
        }
    }
    public function role_edit($id)
    {
        $data = Role::findOrFail($id);
        return view('superadmin.role.edit', compact('data'));
    }
    public function role_update(Request $req, $id)
    {
        Role::find($id)->update($req->all());
        Session::flash('success', 'Di Update');
        return redirect('/superadmin/setting/role');
    }
    public function role_delete(Request $req)
    {
        Role::findOrFail($req->id)->delete();
        Session::flash('success', 'Di Hapus');
        return back();
    }

    public function matakuliah()
    {
        $data = MataKuliah::orderBy('id', 'DESC')->get();
        return view('superadmin.matkul.index', compact('data'));
    }

    public function matakuliah_add()
    {
        return view('superadmin.matkul.add');
    }
    public function matakuliah_store(Request $req)
    {
        if (Matakuliah::where('kode', $req->kode)->first() == null) {
            MataKuliah::create($req->all());
            Session::flash('success', 'Di simpan');
            return redirect('/superadmin/data/matakuliah');
        } else {
            Session::flash('error', 'Kode sudah ada');
            return redirect('/superadmin/data/matakuliah');
        }
    }
    public function matakuliah_edit($id)
    {
        $data = MataKuliah::findOrFail($id);
        return view('superadmin.matkul.edit', compact('data'));
    }
    public function matakuliah_update(Request $req, $id)
    {
        MataKuliah::find($id)->update($req->all());
        Session::flash('success', 'Di Update');
        return redirect('/superadmin/data/matakuliah');
    }
    public function matakuliah_delete(Request $req)
    {
        MataKuliah::findOrFail($req->id)->delete();
        Session::flash('success', 'Di Hapus');
        return back();
    }

    public function kurikulum()
    {
        $data = Kurikulum::orderBy('id', 'DESC')->get();
        return view('superadmin.kurikulum.index', compact('data'));
    }

    public function kurikulum_add()
    {
        $jurusan = Jurusan::get();
        return view('superadmin.kurikulum.add', compact('jurusan'));
    }
    public function kurikulum_store(Request $req)
    {

        if (Kurikulum::where('tahun', $req->tahun)->where('kode_jurusan', $req->kode)->first() == null) {
            Kurikulum::create($req->all());
            Session::flash('success', 'Di simpan');
            return redirect('/superadmin/data/kurikulum');
        } else {
            Session::flash('error', 'Kode sudah ada pada tahun ini');
            return redirect('/superadmin/data/kurikulum');
        }
    }
    public function kurikulum_edit($id)
    {
        $data = Kurikulum::findOrFail($id);
        $jurusan = Jurusan::get();
        return view('superadmin.kurikulum.edit', compact('data', 'jurusan'));
    }
    public function kurikulum_detail($id)
    {
        $data = Kurikulum::findOrFail($id);

        $matakuliah = MataKuliah::get();
        return view('superadmin.kurikulum.detail', compact('data', 'matakuliah'));
    }
    public function kurikulum_detail_store(Request $req, $id)
    {
        if (checkGenapGanjil($req->semester, MataKuliah::where('kode', $req->kode_mata_kuliah)->first()->semester) == true) {
            //simpan
            $check = KurikulumDetail::where('kurikulum_id', $id)->where('kode_mata_kuliah', $req->kode_mata_kuliah)->first();
            if ($check == null) {
                $n = new KurikulumDetail();
                $n->kurikulum_id = $id;
                $n->kode_mata_kuliah = $req->kode_mata_kuliah;
                $n->semester = $req->semester;
                $n->save();

                Session::flash('success', 'Success');
                $req->flash();
                return back();
            } else {
                Session::flash('error', 'Kode Mata Kuliah Sudah Ada Pada Jurusan Ini');
                $req->flash();
                return back();
            }
        } else {
            Session::flash('error', 'Tidak Bisa Memasukkan Mata Kuliah Genap Ke Semester Ganjil Dan Sebaliknya');
            $req->flash();
            return back();
        }
    }

    public function kurikulum_detail_delete(Request $req)
    {
        KurikulumDetail::findOrFail($req->id)->delete();
        $req->flash();
        Session::flash('success', 'success');
        return back();
    }
    public function kurikulum_update(Request $req, $id)
    {
        Kurikulum::find($id)->update($req->all());
        Session::flash('success', 'Di Update');
        return redirect('/superadmin/data/kurikulum');
    }
    public function kurikulum_delete(Request $req)
    {
        Kurikulum::findOrFail($req->id)->delete();
        Session::flash('success', 'Di Hapus');
        return back();
    }


    public function mahasiswa()
    {
        $data = Mahasiswa::orderBy('id', 'DESC')->get();
        return view('superadmin.mahasiswa.index', compact('data'));
    }
    public function mahasiswa_create_user($id)
    {
        $mhs = Mahasiswa::find($id);
        $n = new User;
        $n->name = $mhs->nama;
        $n->username = $mhs->nim;
        $n->password = Hash::make($mhs->nim);
        $n->roles = 'mahasiswa';
        $n->save();

        $mhs->update([
            'user_id' => $n->id
        ]);
        Session::flash('success', 'User dan Password : ' . $mhs->nim);
        return back();
    }
    public function mahasiswa_add()
    {
        $jurusan = Jurusan::get();
        $angkatan = Periode::where('semester', 'GANJIL')->get();
        return view('superadmin.mahasiswa.add', compact('jurusan', 'angkatan'));
    }
    public function mahasiswa_store(Request $req)
    {
        if (Mahasiswa::where('nim', $req->nim)->first() == null) {
            $param = $req->all();
            $param['nama'] = strtoupper($req->nama);
            Mahasiswa::create($param);
            Session::flash('success', 'Di simpan');
            return redirect('/superadmin/data/mahasiswa');
        } else {
            Session::flash('error', 'Kode sudah ada');
            return redirect('/superadmin/data/mahasiswa');
        }
    }
    public function mahasiswa_edit($id)
    {
        $data = Mahasiswa::findOrFail($id);
        $jurusan = Jurusan::get();
        $angkatan = Periode::where('semester', 'GANJIL')->get();
        return view('superadmin.mahasiswa.edit', compact('data', 'jurusan', 'angkatan'));
    }
    public function mahasiswa_update(Request $req, $id)
    {
        Mahasiswa::find($id)->update($req->all());
        Session::flash('success', 'Di Update');
        return redirect('/superadmin/data/mahasiswa');
    }
    public function mahasiswa_delete(Request $req)
    {
        Mahasiswa::findOrFail($req->id)->delete();
        Session::flash('success', 'Di Hapus');
        return back();
    }
}
