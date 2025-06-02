<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratIjinKegiatan extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'tanggal_kegiatan',
        'tempat_kegiatan',
        'no_hp',
        'jenis_kelamin',
        'tujuan_kegiatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function suratPengantarRTRW()
    {
        return $this->hasMany(ImageSuratPengantarRTRW::class);
    }
    public static function getTotalSuratIjinKegiatan()
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
