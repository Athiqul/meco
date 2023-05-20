<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function dashboard()
    {
        return view('user.user_dashboard');
    }
}
