<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $akses = Auth::user()->role;
        if($akses == 'admin'){
            $member = Anggota::get();   
            $user = auth()->user();
            $anggota = Anggota::where('user_id', $user->id)->first();
            $data = [$anggota, $member, $user];           
            return view('member.dashboard', compact(['member', 'user', 'data', 'anggota', 'akses']));

        } elseif($akses == 'koordinator') {
            $kota = Auth::user()->anggota->kota->first()->nama_kota;
            $member = Anggota::with('user')->where('domisili', $kota)->where('level', 'member')->get();   
            $user = auth()->user();
            $anggota = Anggota::where('user_id', $user->id)->first();
            $genre = explode(',', $anggota->genre);            
            $data = [$anggota, $kota, $member, $user];           
            return view('member.dashboard', compact(['member', 'user', 'data', 'kota', 'anggota', 'akses', 'genre']));            

        } else{
            $kota = Auth::user()->anggota->domisili;            
            $user = auth()->user();
            $anggota = Anggota::where('user_id', $user->id)->first();
            $data = [$anggota, $kota, $user];        
            return view('member.dashboard', compact(['user', 'data', 'kota', 'anggota', 'akses', 'genre']));        
        }
        
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

