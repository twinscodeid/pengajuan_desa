<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageSuratPengantarRTRW extends Model
{

    protected $fillable = [
        'surat_ijin_kegiatan_id',
        'image_path',
    ];

    public function suratIjinKegiatan()
    {
        return $this->belongsTo(SuratIjinKegiatan::class);
    }
}
