<template>
    <div class="page-wrapper">
        <div class="container">
            <div class="profile">🔵 Profil</div>
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
                        <input type="text" name="nama" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full rounded border border-gray-300 px-3 py-2" rows="3" required></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Tempat Kegiatan</label>
                        <textarea name="tempat_kegiatan" class="w-full rounded border border-gray-300 px-3 py-2" rows="2" required></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">No HP</label>
                        <input type="text" name="no_hp" class="w-full rounded border border-gray-300 px-3 py-2" required />
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
                        <label class="mb-1 block font-semibold">Tujuan Kegiatan</label>
                        <textarea name="tujuan_kegiatan" class="w-full rounded border border-gray-300 px-3 py-2" rows="4" required></textarea>
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

<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const form = reactive({
    selectedOption: '',
    formText: '', // untuk v-model di bantuan sosial
});

// Method submit
const submitForm = () => {
    router.post('/pengajuan', form);
};
</script>
