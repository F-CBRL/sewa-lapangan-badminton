<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Lapangan::all();
        return view('user.home', compact('data'));
    }
}
