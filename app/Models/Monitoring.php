<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    public $timestamps = false; 
    protected $table = "monitoring"; 
    protected $fillable =[
        'seksi',
        'kegiatan',
        'status',
    ];
    protected $guarded = ['id']; 
}
