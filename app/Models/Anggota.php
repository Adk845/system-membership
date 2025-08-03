<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;
use App\Models\Peminatan;

class Anggota extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function peminatan(){
        return $this->belongsToMany(Peminatan::class);
        //yang dibawah mendefinisikan pivot table secara explisit
        // return $this->belongsToMany(Peminatan::class, 'anggota_peminatan');
    }

    public function kota(){
        return $this->belongsToMany(Kota::class);
    }
    public function bioskop(){
        return $this->belongsToMany(Bioskop::class);
    }    
    public function eventsCreated(){
        return $this->hasMany(Event::class);
    }
    public function eventsJoined(){
         return $this->belongsToMany(Event::class, 'anggota_events', 'anggota_id', 'events_id');
    }
}
