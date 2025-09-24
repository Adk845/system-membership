<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kota;
use App\Models\Event;
use App\Models\Anggota;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Mail\DaftarDanRegister;
use Illuminate\Support\Facades\Mail;

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
        if(isset($request->traning_development)){
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


    public function create2(): View
    {
        $domisili = Kota::pluck('nama_kota', 'id');        
        return view('auth.register2', compact('domisili'));
    }

    public function register2(Request $request){
        // return $request;
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            ],
            [
                'email.unique' => 'Email ini sudah terdaftar, silahkan login untuk mendaftar jika sudah punya akun',
                'email.email'    => 'Format email harus benar, contoh: nama@mail.com.',
            ]
    
        );
        $event = Event::findOrFail($request->event_id);
        // return $event;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('123456789'),
            'role' => 'member',
        ]);

         $anggota = $user->anggota()->create([
            'nama' => $request->name,            
            'email' => $request->email,
            'nomor' => $request->nomor,            
        ]);

        $anggota->eventsJoined()->syncWithoutDetaching([$request->event_id]);
        Mail::to($anggota->email)->queue(new daftarDanRegister($anggota, $event));
        return redirect()->back()->with('success', 'anda telah berhasil mendaftar event ini, silahkan cek email untuk informasi lebih lanjut');
    }

    public function test2(){
        $event = Event::findOrFail(2);
        $anggota = Anggota::findOrFail(3);

        return view('emails.email_template.registerdandaftar', compact('event', 'anggota'));
    }

}
