<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BantuanSosial extends Model
{
    protected $table = 'bantuan_sosials';

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_perkawinan',
        'agama',
        'kewarganegaraan',
        'alamat',
        'pekerjaan',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function imageSuratPengantarRTRW()
    {
        return $this->hasMany(ImageSuratPengantarRTRW::class);
    }

    public static function getTotalBantuanSosial()
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
