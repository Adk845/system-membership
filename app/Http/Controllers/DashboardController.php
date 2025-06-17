<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Admin Dashboard
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

