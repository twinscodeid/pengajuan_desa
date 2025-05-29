<?php

namespace App\Services;

use App\Models\SuratIjinKegiatan;
use App\Models\ImageSuratPengantarRTRW;
use App\Repositories\Interfaces\SuratIjinKegiatanRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratIjinKegiatanService
{
    protected $suratIjinKegiatanRepository;

    public function __construct(SuratIjinKegiatanRepositoryInterface $suratIjinKegiatanRepository)
    {
        $this->suratIjinKegiatanRepository = $suratIjinKegiatanRepository;
    }

    public function getAllSuratIjinKegiatan()
    {
        return $this->suratIjinKegiatanRepository->getAllSuratIjinKegiatan();
    }

    public function createSuratIjinKegiatan(array $data)
    {
        $createdSuratIjinKegiatan = $this->suratIjinKegiatanRepository->createSuratIjinKegiatan([
            'user_id' => $data['user_id'],
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'tanggal_kegiatan' => $data['tanggal_kegiatan'],
            'tempat_kegiatan' => $data['tempat_kegiatan'],
            'no_hp' => $data['no_hp'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tujuan_kegiatan' => $data['tujuan_kegiatan'],
        ]);

        // add image pengantar rt rw
        if (isset($data['image_pengantar_rt_rw']) && is_array($data['image_pengantar_rt_rw'])) {
            if (count($data['image_pengantar_rt_rw']) > 2) {
                throw new \Exception('Jumlah gambar tidak boleh lebih dari 2');
            }
            if (count($data['image_pengantar_rt_rw']) < 1) {
                throw new \Exception('harus surat pengantar dari RT dan RW');
            }
            foreach ($data['image_pengantar_rt_rw'] as $image) {
                ImageSuratPengantarRTRW::create([
                    'surat_ijin_kegiatan_id' => $createdSuratIjinKegiatan->id,
                    'image_path' => Storage::disk('local')->putFile('surat_pengantar_rt_rw', $image),
                ]);
            }
        }
        return $createdSuratIjinKegiatan;
    }

    // show
    public function getSuratIjinKegiatanById($id)
    {
        return $this->suratIjinKegiatanRepository->getSuratIjinKegiatanById($id);
    }

    public function updateSuratIjinKegiatan(string $id, array $data)
    {

        $suratIjinKegiatan = $this->suratIjinKegiatanRepository->updateSuratIjinKegiatan($id, [
            'user_id' => $data['user_id'],
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'tanggal_kegiatan' => $data['tanggal_kegiatan'],
            'tempat_kegiatan' => $data['tempat_kegiatan'],
            'no_hp' => $data['no_hp'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tujuan_kegiatan' => $data['tujuan_kegiatan'],
        ]);

        // update image pengantar rt rw
        if (isset($data['image_pengantar_rt_rw']) && is_array($data['image_pengantar_rt_rw']) && count($data['image_pengantar_rt_rw']) > 0) {
            if (count($data['image_pengantar_rt_rw']) > 2) {
                throw new \Exception('Jumlah gambar tidak boleh lebih dari 2');
            }
            if (count($data['image_pengantar_rt_rw']) < 1) {
                throw new \Exception('harus surat pengantar dari RT dan RW');
            }
            // hapus gambar lama
            $pengantar = ImageSuratPengantarRTRW::where('surat_ijin_kegiatan_id', $id)->get();
            if ($pengantar) {
                foreach ($pengantar->image_path as $imagePath) {
                    Storage::disk('local')->delete($imagePath->image_path);
                    $imagePath->delete();
                }
            }
            // simpan gambar baru
            foreach ($data['image_pengantar_rt_rw'] as $image) {
                ImageSuratPengantarRTRW::create([
                    'surat_ijin_kegiatan_id' => $suratIjinKegiatan->id,
                    'image_path' => Storage::disk('local')->putFile('surat_pengantar_rt_rw', $image),
                ]);
            }
        }
        return $suratIjinKegiatan;
    }

    // bagian destroy
    public function destroySuratIjinKegiatan($id)
    {
        $imagePengantar = ImageSuratPengantarRTRW::where('surat_ijin_kegiatan_id', $id)->get();
        if ($imagePengantar) {
            foreach ($imagePengantar as $image) {
                Storage::disk('local')->delete($image->image_path);
                $image->delete();
            }
        }
        return $this->suratIjinKegiatanRepository->deleteSuratIjinKegiatan($id);
    }

    public function generataPdfSuratIjinKegiatan($data)
    {
        // $pdf = PDF::loadView('surat_ijin_kegiatan.pdf', $data);
        // return $pdf->download('surat_ijin_kegiatan.pdf');
    }

    public function sendEmailSuratIjinKegiatan($data)
    {
        $pdf = PDF::loadView('surat_ijin_kegiatan.pdf', $data);
        return $pdf->download('surat_ijin_kegiatan.pdf');
    }
}
