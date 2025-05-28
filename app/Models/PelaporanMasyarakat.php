<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelaporanMasyarakat extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'alamat',
        'laporan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
