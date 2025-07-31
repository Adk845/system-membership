<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kota;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $domisili = Kota::pluck('nama_kota', 'id');        
        return view('auth.register', compact('domisili'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    public function store(Request $request)
    {
        
        $bioskops = explode(',', $request->bioskop);    
        // return $request->bioskop;
        // return 'berhasil';
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
        ]);

        //UPLOAD GAMBAR 
        if($request->file('foto')){
            $fotoPath =  $request->file('foto')->store('member_image', 'public');
        } else {
            $fotoPath = null;
        }

        $anggota = $user->anggota()->create([
            'nama' => $request->nama_anggota,
            'about_me' => $request->about_me,
            'email' => $request->email,
            'nomor' => $request->nomor,
            'domisili' => $request->domisili,
            'tanggal_lahir' => $request->tanggal_lahir,
            'genre' => $request->genre,
            'foto' => $fotoPath
        ]);

        // $anggota->peminatan()->attach([1,2,3]);
        // 1 = nonton, 2 = seminar berbayar, 3 seminar gratis
        if(isset($request->nonton)){
            $anggota->peminatan()->attach(1);
            if(isset($request->bioskop)){
                foreach($bioskops as $bioskop){
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



        

        // Menyebarkan event registered
        event(new Registered($user));

        // Melakukan login otomatis
        Auth::login($user);
        redirect()->route('dashboard');
        // Cek role pengguna setelah login dan arahkan ke dashboard yang sesuai
        // if ($user->role === 'admin') {
        //     return redirect()->route('admin.dashboard');  // Pengguna admin
        // } elseif ($user->role === 'member') {
        //     return redirect()->route('member.dashboard');  // Pengguna member
        // }

        // Default redirect jika role tidak ditemukan
        return redirect(RouteServiceProvider::HOME); 
    }
}
