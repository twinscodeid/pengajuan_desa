<script setup lang="ts">
import { router, Link, Head, useForm } from '@inertiajs/vue3';
import { reactive } from 'vue';
import {SuratIjinKegiatan} from "@/types/general";

const form = reactive({
    selectedOption: '',
});

// data
const dataIjinKegiatan = useForm<SuratIjinKegiatan>({
    nama: '',
    alamat: '',
    tanggal_kegiatan: '',
    tempat_kegiatan: '',
    no_hp: '',
    jenis_kelamin: '',
    tujuan_kegiatan: '',
    image_pengantar_rt_rw: []
})

// method hanlde image
const handleFiles = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const files = target.files ? Array.from(target.files) : [];

    if (files.length > 2) {
        alert('Jumlah file tidak boleh lebih dari 2');
        target.value = ''; // reset input file
        dataIjinKegiatan.image_pengantar_rt_rw = [];
        return;
    }

    dataIjinKegiatan.image_pengantar_rt_rw = files;
};

// Method submit
const submitForm = () => {

    if(form.selectedOption === 'izin') {

    dataIjinKegiatan.post(route('surat-ijin-kegiatan.store'), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            form.selectedOption = '';
            dataIjinKegiatan.reset();
        },
        onError: (errors: any) => {
            console.log(errors);
        }
    });
    }
};
</script>

<template>
    <div class="page-wrapper">
        <div class="container">
            <div class="profile flex gap-2 items-center">
                <p>🔵</p>
                <Link href="/dashboard-user" class="cursor-pointer hover:underline">Profil</Link>
            </div>
            <h2>Form Pengajuan</h2>
            <img src="#" alt="" class="" />

            <div class="lorem-box">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis nunc a purus interdum, in sollicitudin eros blandit.
                    Morbi vitae turpis in libero sodales gravida. Fusce porttitor urna a felis imperdiet efficitur. Proin sit amet rutrum metus.
                    Suspendisse at semper tellus. Integer euismod justo nec libero accumsan, ut mattis turpis pharetra.
                </p>
            </div>

            <form @submit.prevent="submitForm">
                <label for="pengajuan">Pilih Pengajuan</label>
                <select id="pengajuan" v-model="form.selectedOption">
                    <option value="">-- Pilih Pengajuan --</option>
                    <option disabled value="surat">Surat Pengantar SKCK</option>
                    <option value="izin">Surat Izin Kegiatan</option>
                    <option value="bantuan_sosial">Pengajuan Bantuan Sosial</option>
                    <option value="laporan_masyarakat">Laporan Masyarakat</option>
                    <option value="lainnya">Lainnya</option>
                </select>

                <!-- ====================== SURAT PENGANTAR SKCK ====================== -->
                <div class="mt-4" v-if="form.selectedOption === 'surat'">
                    <label for="form">Form Surat</label>

                    <div>
                        <label class="mb-1 block font-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">NIK</label>
                        <input type="text" name="nik" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Tempat Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full rounded border border-gray-300 px-3 py-2" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Status Perkawinan</label>
                        <select name="status_perkawinan" class="w-full rounded border border-gray-300 px-3 py-2" required>
                            <option value="">-- Pilih --</option>
                            <option value="Belum-Menikah">Belum Kawin</option>
                            <option value="Menikah">Kawin</option>
                            <option value="Cerai Hidup">Cerai Hidup</option>
                            <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Agama</label>
                        <select name="agama" class="w-full rounded border border-gray-300 px-3 py-2" required>
                            <option value="">-- Pilih --</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="hindu">Hindu</option>
                            <option value="budha">Budha</option>
                            <option value="katholik">Katholik</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full rounded border border-gray-300 px-3 py-2" rows="3" required></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">No HP</label>
                        <input type="text" name="no_hp" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>
                </div>

                <!-- ====================== SURAT IZIN KEGIATAN ====================== -->
                <div class="mt-4" v-if="form.selectedOption === 'izin'">
                    <label for="form">Form Surat</label>

                    <div>
                        <label class="mb-1 block font-semibold">Nama</label>
                        <input type="text" name="nama" class="w-full rounded border border-gray-300 px-3 py-2" v-model="dataIjinKegiatan.nama" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full rounded border border-gray-300 px-3 py-2" rows="3" v-model="dataIjinKegiatan.alamat" required></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" class="w-full rounded border border-gray-300 px-3 py-2" v-model="dataIjinKegiatan.tanggal_kegiatan" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Tempat Kegiatan</label>
                        <textarea name="tempat_kegiatan" class="w-full rounded border border-gray-300 px-3 py-2" rows="2" v-model="dataIjinKegiatan.tempat_kegiatan" required></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">No HP</label>
                        <input type="text" name="no_hp" class="w-full rounded border border-gray-300 px-3 py-2" v-model="dataIjinKegiatan.no_hp" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full rounded border border-gray-300 px-3 py-2" v-model="dataIjinKegiatan.jenis_kelamin" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Tujuan Kegiatan</label>
                        <textarea name="tujuan_kegiatan" class="w-full rounded border border-gray-300 px-3 py-2" rows="4" v-model="dataIjinKegiatan.tujuan_kegiatan" required></textarea>
                    </div>
                    <div>
                    <label class="mb-1 block font-semibold">Upload Dokumen (Surat Keterangan RT/RW)</label>

                    <div class="flex items-center space-x-4">
                        <!-- Tombol custom Telusuri -->
                        <label
                            for="dokumen"
                            class="cursor-pointer rounded bg-gray-400 px-4 py-2 font-semibold text-white transition hover:bg-gray-500"
                        >
                            Telusuri
                        </label>

                        <!-- Nama file jika sudah dipilih -->
                        <!-- <span v-if="fileName" class="max-w-xs truncate text-sm text-gray-600">{{ fileName }}</span> -->
                    </div>

                    <!-- Input file disembunyikan -->
                    <input
                    id="dokumen"
                    class="hidden"
      type="file"
      multiple
      accept="image/*"
      name="image_pengantar_rt_rw[]"
      @change="handleFiles"
    />

    <div v-if="dataIjinKegiatan.image_pengantar_rt_rw.length">
      <p v-for="(image, index) in dataIjinKegiatan.image_pengantar_rt_rw" :key="index">
        {{ image.name }}
      </p>
    </div>

    <progress v-if="dataIjinKegiatan.progress" :value="dataIjinKegiatan.progress.percentage" max="100">
      {{ dataIjinKegiatan.progress.percentage }}%
    </progress>

                    <!-- Preview gambar -->
                    <!-- <div v-if="previewUrl" class="mt-2">
                        <label class="mb-1 block font-medium">Preview:</label>
                        <img :src="previewUrl" alt="Preview Gambar" class="max-h-48 rounded border" />
                    </div> -->
                </div>
                </div>

                <!-- ====================== BANTUAN SOSIAL ====================== -->
                <div class="mt-4" v-if="form.selectedOption === 'bantuan_sosial'">
                    <label for="form">Form Surat</label>

                    <div>
                        <label class="mb-1 block font-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">NIK</label>
                        <input type="text" name="nik" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Tempat Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full rounded border border-gray-300 px-3 py-2" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Status Perkawinan</label>
                        <select name="status_perkawinan" class="w-full rounded border border-gray-300 px-3 py-2" required>
                            <option value="">-- Pilih --</option>
                            <option value="Belum-Menikah">Belum Kawin</option>
                            <option value="Menikah">Kawin</option>
                            <option value="Cerai Hidup">Cerai Hidup</option>
                            <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Agama</label>
                        <select name="agama" class="w-full rounded border border-gray-300 px-3 py-2" required>
                            <option value="">-- Pilih --</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="hindu">Hindu</option>
                            <option value="budha">Budha</option>
                            <option value="katholik">Katholik</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full rounded border border-gray-300 px-3 py-2" rows="3" required></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">No HP</label>
                        <input type="text" name="no_hp" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>
                    <!-- Surat Keterangan Rt/Rw -->

                    <label class="mb-1 block font-semibold">Upload Dokumen (Surat Keterangan RT/RW)</label>

                    <div class="flex items-center space-x-4">
                        <!-- Tombol custom Telusuri -->
                        <label
                            for="dokumen"
                            class="cursor-pointer rounded bg-gray-400 px-4 py-2 font-semibold text-white transition hover:bg-gray-500"
                        >
                            Telusuri
                        </label>

                        <!-- Nama file jika sudah dipilih -->
                        <span v-if="fileName" class="max-w-xs truncate text-sm text-gray-600">{{ fileName }}</span>
                    </div>

                    <!-- Input file disembunyikan -->
                    <input type="file" id="dokumen" name="dokumen" accept="image/*,.pdf" class="hidden" @change="previewGambar" required />

                    <!-- Preview gambar -->
                    <div v-if="previewUrl" class="mt-2">
                        <label class="mb-1 block font-medium">Preview:</label>
                        <img :src="previewUrl" alt="Preview Gambar" class="max-h-48 rounded border" />
                    </div>
                </div>

                <!-- ====================== LAPORAN MASYARAKAT ====================== -->
                <div class="mt-4" v-if="form.selectedOption === 'laporan_masyarakat'">
                    <label for="form">Form Surat</label>

                    <div>
                        <label class="mb-1 block font-semibold">Nama</label>
                        <input type="text" name="nama" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full rounded border border-gray-300 px-3 py-2" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full rounded border border-gray-300 px-3 py-2" rows="3" required></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Isi Laporan</label>
                        <textarea
                            name="laporan"
                            class="w-full rounded border border-gray-300 px-3 py-2"
                            rows="5"
                            placeholder="Tuliskan laporan masyarakat..."
                            required
                        ></textarea>
                    </div>
                </div>

                <button type="submit">Kirim Pengajuan</button>
                <div class="info">Mohon ditunggu, admin akan segera menghubungi Anda Melalui WA/email</div>
            </form>
        </div>
    </div>
</template>



<style scoped>
body {
    color: #000000;
    margin: 0;
    padding: 0;
    height: 100%;
    background-color: #fff; /* Latar belakang putih */
  }
  .lorem-box {
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    max-width: 700px;
    margin: 30px auto;
    text-align: justify;
    color: #000;
    font-size: 1rem;
    line-height: 1.6;
  }

  .page-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #fff; /* Putih penuh */
    padding: 20px;
    box-sizing: border-box;
  }



  .profile {
    font-weight: bold;
    color: #1e90ff;
    margin-bottom: 15px;
    font-size: 1.1rem;
  }

  h2 {
    color: rgb(0, 0, 0);
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    font-size: large;
  }

  label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #333;
  }

  select,
  textarea {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    cursor: pointer;
  }

  button:hover {
    background-color: #007bff;
  }

  .info {
    margin-top: 20px;
    text-align: center;
    color: #000000;
  }

  .forum-img {
    width: 100%;
    height: auto;
    margin: 15px 0;
    border-radius: 8px;
    object-fit: cover;
  }
</style>


