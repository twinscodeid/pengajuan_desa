<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageSuratPengantarRTRW extends Model
{

    protected $table = 'image_surat_pengantar_r_t_r_w';
    protected $fillable = [
        'surat_ijin_kegiatan_id',
        'bantuan_sosial_id',
        'image_path',
    ];

    public function suratIjinKegiatan()
    {
        return $this->belongsTo(SuratIjinKegiatan::class);
    }
    public function bantuanSosial()
    {
        return $this->belongsTo(BantuanSosial::class);
    }
}
