<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Kota;
use App\Models\Anggota;
use App\Models\Bioskop;
use App\Models\Peminatan;

use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    //

    public function index(){
        $kota = Auth::user()->anggota->kota->first()->nama_kota;
        $member = Anggota::with('user')->where('domisili', $kota)->where('level', 'member')->get();   
        $user = auth()->user();
        // return $member;
        // return view('member.dashboard', compact(['member', 'user']));
        return view('koordinator.memberlist', compact('member'));
    }
    public function create(){
        $domisili = Kota::pluck('nama_kota', 'id');        
        return view('admin.create_member', compact('domisili'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
        ]);

        $anggota = $user->anggota()->create([
            'nama' => $request->nama_anggota,
            'domisili' => $request->domisili,           
        ]);

       
        if(isset($request->nonton)){
            $anggota->peminatan()->attach(1);
            if(isset($request->bioskop)){
                foreach($request->bioskop as $bioskop){
                    $anggota->bioskop()->attach($bioskop);
                }
            }
        }
        if(isset($request->seminar)){
            $anggota->peminatan()->attach(3);
        }
        if(isset($request->seminar_berbayar)){
            $anggota->peminatan()->attach(2);
        }

        return redirect()->route('memberlist');

    }

    public function edit(Request $request){
        
        $user = User::with('anggota')->where('id', $request->id_user)->first();
        $anggota =  $user->anggota;
        $peminatan = $anggota->peminatan;
        $bioskop = $anggota->bioskop;
        $domisili = Kota::pluck('nama_kota', 'id');   
                           
        return view('admin.edit_member', compact(['user', 'anggota', 'peminatan', 'bioskop', 'domisili']));
    }

    public function delete($id_user){
    
    $user = User::where('id', $id_user)->first();
    $anggota = $user->anggota;
    if($anggota->level == 'koordinator'){
        return 'koordinator';
    }else{
         if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
        
        if ($anggota) {
            $anggota->peminatan()->detach();
            $anggota->bioskop()->detach();
            $anggota->delete();
        }

        $user->delete();

        return redirect()->route('memberlist')->with('success', 'Member berhasil dihapus');
        }
    }
       
}
