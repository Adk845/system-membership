<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailHistory extends Model
{
    use HasFactory;
    protected $table = 'email_histories';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'sent_by');
    }

}
