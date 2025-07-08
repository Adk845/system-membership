<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Admin Dashboard
    }
    public function memberlist(){
        $kota = Auth::user()->anggota->kota->first()->nama_kota;
        $member = Anggota::with('user')->where('domisili', $kota)->where('level', 'member')->get();   
        return view('koordinator.memberlist', compact('member'));
    }
    

    public function memberDashboard()
{
    $user = auth()->user();

    return view('member.dashboard', [
        'user' => $user,
        'memberId' => '8630 - 082', // Gantilah sesuai logika ID kamu
        'ranking' => 696,
        'points' => 30,
        'coins' => 30,
    ]);
}

}

