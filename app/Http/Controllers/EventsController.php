<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;

class EventsController extends Controller
{
    //
    public function index(){
        $events = Event::orderBy('created_at', 'desc')->paginate(10);
        return view('events.event', compact('events'));
    }
    
    public function index_admin(Request $request){
         $query = Event::query();
            // Search
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            }
            // Per page pagination
            $perPage = $request->get('per_page', 10);
            if ($perPage === 'all') {
                $events = $query->orderBy('created_at', 'desc')->get(); // all data
            } else {
                $events = $query->orderBy('created_at', 'desc')->paginate((int)$perPage)->appends($request->all());
            }
            return view('events.event_list', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function show(Request $request){
        $event = Event::where('id', $request->id)->first();        
        return view('events.show', compact('event'));
    }    

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPath = $request->file('gambar')->store('event_images', 'public');

        Event::create([
            'anggota_id' => Auth::user()->anggota->id,
            'createdBy' => Auth::user()->name,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'narasumber' => $request->narasumber,
            'jenis_peminatan' => $request->jenis_peminatan,
            'Lokasi' => $request->Lokasi,
            'link' => $request->link,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'wilayah_koordinator' => $request->wilayah_koordinator,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('events.index.admin')->with('success', 'Event berhasil dibuat!');
    }

    public function delete($id){
        try{
            $event = Event::findOrFail($id);

            // Hapus gambar jika ada
            if ($event->gambar && Storage::disk('public')->exists($event->gambar)) {
                Storage::disk('public')->delete($event->gambar);
            }

            // Hapus data event
            $event->delete();

            return redirect()->back()->with('success', 'Event berhasil dihapus.');
            } catch(\Exception) {
                return redirect()->back()->with('error', 'Event gagal dihapus.');
            }
    }


    public function edit($id)
        {
            $event = Event::findOrFail($id);
            return view('events.edit', compact('event'));
        }

    public function update(Request $request)
        {            
            try{
                $event = Event::findOrFail($request->id);

            // $request->validate([
            //     'nama' => 'required|string|max:255',
            //     'deskripsi' => 'required|string',
            //     'jenis_peminatan' => 'required|string',
            //     'gambar' => 'nullable|image|max:2048',
            // ]);

            $event->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'narasumber' => $request->narasumber,
                'jenis_peminatan' => $request->jenis_peminatan,
                'Lokasi' => $request->Lokasi,
                'link' => $request->link,
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'wilayah_koordinator' => $request->wilayah_koordinator,
            ]);

         

            // Lalu di dalam method:
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($event->gambar && Storage::disk('public')->exists($event->gambar)) {
                    Storage::disk('public')->delete($event->gambar);
                }

                // Simpan gambar baru
                $path = $request->file('gambar')->store('event_images', 'public');

                // Update kolom gambar
                $event->update(['gambar' => $path]);
            }



                return redirect()->route('events.index.admin')->with('success', 'Event berhasil diperbarui.');
                } catch(\Exception){
                return redirect()->route('events.index.admin')->with('error', 'Event berhasil diperbarui.');
            }
        } 

}
