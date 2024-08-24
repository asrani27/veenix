<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class UriController extends Controller
{
    public function index()
    {
        $data = Domain::get();
        return view('superadmin.domain.index', compact('data'));
    }
}
