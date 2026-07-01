<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StringingOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_senar',
        'warna_senar',
        'harga_tambahan',
        'keterangan',
    ];
}
