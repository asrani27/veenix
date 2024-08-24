<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $data = Genre::get();
        return view('superadmin.genre.index', compact('data'));
    }
}
