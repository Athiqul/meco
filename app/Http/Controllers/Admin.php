<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    //Admin Dashboard render
    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    //View Admin Profile
    public function adminProfile()
    {

        return view('admin.admin_profile');
    }
}
