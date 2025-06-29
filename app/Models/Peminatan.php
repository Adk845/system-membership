<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anggota;

class Peminatan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function anggota(){
        return $this->belongsToMany(Anggota::class);
        //yang dibawah mendefinisikan pivot
        //return $this->belongsToMany(Anggota::class, 'anggota_peminatan');
    }
    
}
