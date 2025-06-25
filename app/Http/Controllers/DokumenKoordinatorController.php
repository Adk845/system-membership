<?php

namespace App\Http\Controllers;

use App\Models\DokumenKoordinator;
use Illuminate\Http\Request;

class DokumenKoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = DokumenKoordinator::get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DokumenKoordinator $dokumenKoordinator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DokumenKoordinator $dokumenKoordinator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DokumenKoordinator $dokumenKoordinator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DokumenKoordinator $dokumenKoordinator)
    {
        //
    }
}
