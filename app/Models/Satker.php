<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    use HasFactory;

    public $timestamps = false; 
    protected $table = "satker"; 
    protected $fillable = [
        'nama satker', 
        'kode satker',
    ];
}
