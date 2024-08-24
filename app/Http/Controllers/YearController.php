<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function index()
    {
        $data = Year::get();
        return view('superadmin.year.index', compact('data'));
    }
}
