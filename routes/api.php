<?php

use App\Http\Controllers\DokumenKoordinatorController;
use App\Models\DokumenKoordinator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BioskopController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('dokumen_koordinator', DokumenKoordinatorController::class);
Route::get('/bioskop/search/{kota}', [BioskopController::class, 'search']);
Route::get('/bioskop/test', [DashboardController::class, 'memberlist']);
