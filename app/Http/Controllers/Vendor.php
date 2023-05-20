<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Vendor extends Controller
{
    public function dashboard()
    {
        return view('vendors.vendor_dashboard');
    }
}
