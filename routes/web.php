<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
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
    Route::post('member_edit', [AnggotaController::class, 'edit'])->name('member.edit');
    Route::post('member_update', [AnggotaController::class, 'update'])->name('member.update');
    Route::get('member_delete/{id_user}', [AnggotaController::class, 'delete'])->name('member.delete');

    //event
    Route::get('events', [EventsController::class, 'index'])->name('event.list');
});

require __DIR__.'/auth.php';
