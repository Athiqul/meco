<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        //dd($request);
        $request->authenticate();

        $request->session()->regenerate();
        $url='';
       // dd($request->user());
        switch($request->user()->roles)
        {
            case 'admin':
               $url='/admin-dashboard';
               break;
            case 'vendor':
                $url='/vendor-dashboard';
               break;
            case 'user':
                $url='/user-dashboard';
               break;
            default:
                $url='/login';
        }
         //dd($url);
        return redirect()->intended($url)->with(['alert-type'=>'success','message'=> Auth::user()->name.' Sir Welcome you are logged in!']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
