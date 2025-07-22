<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLama extends Model
{
    use HasFactory;
    protected $connection = 'mysql_old';
    protected $table = 'users'; // tabel lama
    protected $guarded = [];
}
