<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $data = Country::get();
        return view('superadmin.country.index', compact('data'));
    }
}
