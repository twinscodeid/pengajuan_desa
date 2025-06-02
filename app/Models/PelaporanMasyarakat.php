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

    public static function getTotalPelaporanMasyarakat()
    {
        return self::count();
    }

    public static function getDailyCountsThisMonth()
    {
        return self::selectRaw('DAY(created_at) as day, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->groupBy('day')
            ->pluck('total', 'day');
    }
}
