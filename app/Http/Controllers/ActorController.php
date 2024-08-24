<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        $data = Actor::get();
        return view('superadmin.actor.index', compact('data'));
    }
}
