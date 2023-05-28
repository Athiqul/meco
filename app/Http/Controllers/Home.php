<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    //Front end customer view
    public function index()
    {
        return view('frontend.index');
    }
}
