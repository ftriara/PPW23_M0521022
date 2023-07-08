<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'cover'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function borrower()
    {
        return $this->belongsToMany(Borrower::class);
    }
    
}
