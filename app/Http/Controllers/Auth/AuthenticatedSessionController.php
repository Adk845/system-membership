<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\Anggota;
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
   public function store(LoginRequest $request)
{
    $request->authenticate();
    $request->session()->regenerate();

    // $user = Auth::user();
    $kota = Auth::user()->anggota->kota->first()->nama_kota;
    $member = Anggota::with('user')->where('domisili', $kota)->where('level', 'member')->get();   
    $user = auth()->user();
    $data = [$kota, $member, $user];
    return redirect()->route('dashboard');
    // if ($user->role === 'admin') {
    //     return redirect()->route('member.dashboard');
    //     return view('member.dashboard', compact(['member', 'user', 'data', 'kota']));
    // } elseif ($user->role === 'member') {
    //     return redirect()->route('member.dashboard');
    // }

    // Default redirect jika role tidak ditemukan
    // return redirect()->intended(RouteServiceProvider::HOME);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login'); 
    }
}
