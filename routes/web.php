<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/login', function () {
    return view('auth/login');
});

// Route::get('/dashboard', function () {
//     return view('member.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    // Route::get('/dashboard', [DashboardController::class, 'index'])
    //     ->middleware('role:admin') // Untuk Admin
    //     ->name('admin.dashboard');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')
    Route::get('/member-dashboard', [DashboardController::class, 'memberDashboard'])
        ->middleware('role:member') // Untuk Member
        ->name('member.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //anggota crud
    Route::get('member_list', [AnggotaController::class, 'index'])->name('memberlist');
    Route::get('member_create', [AnggotaController::class, 'create'])->name('member.create');
    Route::post('member_create', [AnggotaController::class, 'store'])->name('member.create');
    Route::get('member_edit/{id_user}', [AnggotaController::class, 'edit'])->name('member.edit');
    Route::post('member_update', [AnggotaController::class, 'update'])->name('member.update');
    Route::get('member_delete/{id_user}', [AnggotaController::class, 'delete'])->name('member.delete');

    //profile 
    Route::get('/profile', [AnggotaController::class, 'profile'])->name('member.profile');
    Route::post('/profile_update', [AnggotaController::class, 'profile_update'])->name('member.profile.update');

    //event
    Route::get('events', [EventsController::class, 'index'])->name('event.list');
    Route::get('/events_admin', [EventsController::class, 'index_admin'])->name('events.index.admin');
    Route::get('/events_create', [EventsController::class, 'create'])->name('events.create');    
    Route::post('/admin/events', [EventsController::class, 'store'])->name('events.store');    
    Route::get('/admin/events/{id}', [EventsController::class, 'show'])->name('events.show');
    Route::get('/admin/events/{id}/edit', [EventsController::class, 'edit'])->name('events.edit');
    Route::post('/admin/events/edit', [EventsController::class, 'update'])->name('events.update');
    Route::get('/admin/events/{id}/delete', [EventsController::class, 'delete'])->name('events.delete');

    //event register
    Route::get('/events/register/{id_event}', [EventsController::class, 'register'])->name('events.register');
    Route::get('/events/register/batalkan/{id_event}', [EventsController::class, 'batalkan'])->name('events.register.batalkan');

    //notifikasi 
    Route::get('mail/notification/{id_event}', [EmailController::class, 'send_notification'])->name('emails.notification');
    // Route::get('mail/notification/broadcast/{id_event}', [EmailController::class, 'broadcast'])->name('emails.notification.broadcast');
    Route::get('/broadcast/email/{id_event}', [EmailController::class, 'broadcast'])->name('broadcast.email');
    Route::post('/broadcast/email/send', [EmailController::class, 'broadcastSend'])->name('broadcast.send');

    //tampilin dashboard awal email 
    Route::get('mail', [EmailController::class, 'index'])->name('emails.index');    
    ///////////////////////
    //broadcast create//
    ////////////////////
    //nampilin form 
    Route::get('mail/create', [EmailController::class, 'create_email'])->name('emails.create');
    //menyimpan draft email sebelum dikirim
    Route::post('mail/create/store', [EmailController::class, 'store_email'])->name('emails.store');
    //nampilin halaman buat milih penerima
    Route::get('mail/create/penerima/{email_id}', [EmailController::class, 'list_penerima'])->name('emails.penerima');
    //nampilin form edit email, untuk edit email, untuk tombol back
    Route::get('mail/edit/{email_id}', [EmailController::class, 'edit_email'])->name('emails.edit');
    //simpan perubahan email
    Route::post('mail/update/', [EmailController::class, 'update_email'])->name('emails.update');
    //kirim email ke penerima 
    Route::post('mail/send', [EmailController::class, 'send_email'])->name('emails.send');


});
require __DIR__.'/auth.php';
