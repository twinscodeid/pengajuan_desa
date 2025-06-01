<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('image_surat_pengantar_r_t_r_w', function (Blueprint $table) {
            $table->dropForeign(['surat_ijin_kegiatan_id']);
            $table->unsignedBigInteger('surat_ijin_kegiatan_id')->nullable()->change();
            $table->foreign('surat_ijin_kegiatan_id')->references('id')->on('surat_ijin_kegiatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('image_surat_pengantar_r_t_r_w', function (Blueprint $table) {
            $table->dropForeign(['surat_ijin_kegiatan_id']);
            $table->unsignedBigInteger('surat_ijin_kegiatan_id')->nullable(false)->change();
            $table->foreign('surat_ijin_kegiatan_id')->references('id')->on('surat_ijin_kegiatans')->onDelete('cascade');
        });
    }
};
