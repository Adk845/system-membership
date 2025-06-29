<?php

namespace App\Http\Controllers;
use App\Models\Kota;
use App\Models\Bioskop;
use Illuminate\Http\Request;

class BioskopController extends Controller
{
    // public function search(Request $request){
    //     $namaKota = $request->kota; // atau pakai $request->wilayah
    //     $wilayah = Kota::where('nama_kota', $namaKota)->first();
    //     $bioskop = $wilayah->load('bioskop');
    //     return $bioskop;
    //     if (!$wilayah) {
    //         return response()->json([]);
    //     }

    //     $bioskop = Bioskop::where('wilayah_bioskop_id', $wilayah->id)->get();
    //     return response()->json($bioskop);
    // }

     public function search($kota)
        {
            $wilayah = Kota::with('bioskop')->where('nama_kota', $kota)->first();

            if (!$wilayah) {
                return response()->json([]);
            }

            return response()->json($wilayah->bioskop);
        }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Bioskop $bioskop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bioskop $bioskop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bioskop $bioskop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bioskop $bioskop)
    {
        //
    }
}
