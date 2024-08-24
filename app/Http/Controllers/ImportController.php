<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends Controller
{
    public function index()
    {
        return view('superadmin.import.index');
    }
    public function store(Request $req)
    {
        if ($req->jenis == 'matakuliah') {
            $spreadsheet = IOFactory::load($req->file);
            foreach ($spreadsheet->getActiveSheet()->toArray() as $key => $item) {
                if ($key == 0) {
                } else {
                    $check = MataKuliah::where('kode', $item[0])->first();
                    if ($check == null) {
                        $new = new MataKuliah();
                        $new->kode = $item[0];
                        $new->nama = $item[1];
                        $new->sks = $item[2];
                        $new->semester = $item[5];
                        $new->save();
                    } else {
                    }
                }
            }
            Session::flash('success', 'Di Import');
            return redirect('/superadmin/setting/import');
        }

        if ($req->jenis == 'mahasiswa') {
            $spreadsheet = IOFactory::load($req->file);
            foreach ($spreadsheet->getActiveSheet()->toArray() as $key => $item) {
                if ($key == 0) {
                } else {
                    $check = Mahasiswa::where('nim', $item[1])->first();
                    if ($check == null) {
                        $new = new Mahasiswa();
                        $new->nim = $item[1];
                        $new->nama = $item[3];
                        $new->angkatan = $item[11];
                        $new->jurusan = $item[12];
                        $new->jkel = $item[14];
                        $new->status = $item[18];
                        $new->save();
                    } else {
                    }
                }
            }
            Session::flash('success', 'Di Import');
            return redirect('/superadmin/setting/import');
        }
    }
}
