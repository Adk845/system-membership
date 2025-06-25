<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
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

        $user->anggota()->create([
            'nama' => $request->nama_anggota,
            'domisili' => $request->domisili,           
        ]);
        

        // Menyebarkan event registered
        event(new Registered($user));

        // Melakukan login otomatis
        Auth::login($user);

        // Cek role pengguna setelah login dan arahkan ke dashboard yang sesuai
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');  // Pengguna admin
        } elseif ($user->role === 'member') {
            return redirect()->route('member.dashboard');  // Pengguna member
        }

        // Default redirect jika role tidak ditemukan
        return redirect(RouteServiceProvider::HOME); 
    }
}
