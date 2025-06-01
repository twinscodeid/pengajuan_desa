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
            $table->unsignedBigInteger('bantuan_sosial_id')->nullable()->after('surat_ijin_kegiatan_id');
            $table->foreign('bantuan_sosial_id')->references('id')->on('bantuan_sosials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('image_surat_pengantar_r_t_r_w', function (Blueprint $table) {
            Schema::table('image_surat_pengantar_r_t_r_w', function (Blueprint $table) {
                $table->dropForeign(['bantuan_sosial_id']);
                $table->dropColumn('bantuan_sosial_id');
            });
        });
    }
};
