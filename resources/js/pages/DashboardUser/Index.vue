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
                    <option value="surat">Surat Pengantar SKCK</option>
                    <option value="izin">Surat Izin Kegiatan</option>
                    <option value="bantuan_sosial">Pengajuan Bantuan Sosial</option>
                    <option value="laporan_masyarakat">Laporan Masyarakat</option>
                    <option value="lainnya">Lainnya</option>
                </select>

                <!-- form input surat pengantar skck -->
                <div class="mt-4" v-if="form.selectedOption === 'surat'">
                    <label for="form">Form Surat</label>
                    <textarea id="form" rows="5" v-model="formText" placeholder="Isi form pengajuan di sini..."></textarea>
                </div>

                <!-- form input surat ijin kegiatan -->
                <div class="mt-4" v-if="form.selectedOption === 'izin'">
                    <label for="form">Form Surat</label>
                    <!-- Nama -->
                    <div>
                        <label class="mb-1 block font-semibold">Nama</label>
                        <input type="text" name="nama" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="mb-1 block font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full rounded border border-gray-300 px-3 py-2" rows="3" required></textarea>
                    </div>

                    <!-- Tanggal Kegiatan -->
                    <div>
                        <label class="mb-1 block font-semibold">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <!-- Tempat Kegiatan -->
                    <div>
                        <label class="mb-1 block font-semibold">Tempat Kegiatan</label>
                        <textarea name="tempat_kegiatan" class="w-full rounded border border-gray-300 px-3 py-2" rows="2" required></textarea>
                    </div>

                    <!-- No HP -->
                    <div>
                        <label class="mb-1 block font-semibold">No HP</label>
                        <input type="text" name="no_hp" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="mb-1 block font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full rounded border border-gray-300 px-3 py-2" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Tujuan Kegiatan -->
                    <div>
                        <label class="mb-1 block font-semibold">Tujuan Kegiatan</label>
                        <textarea name="tujuan_kegiatan" class="w-full rounded border border-gray-300 px-3 py-2" rows="4" required></textarea>
                    </div>
                </div>

                <!-- form input surat pengjuan bantuan sosial -->
                <div class="mt-4" v-if="form.selectedOption === 'bntuan_sosial'">
                    <label for="form">Form Surat</label>
                    <textarea id="form" rows="5" v-model="formText" placeholder="Isi form pengajuan di sini..."></textarea>
                </div>
                <!-- form input laporan masyarakat -->
                <div class="mt-4" v-if="form.selectedOption === 'laporan_masyarakat'">
                    <label for="form">Form Surat</label>

                    <!-- Nama -->
                    <div>
                        <label class="mb-1 block font-semibold">Nama</label>
                        <input type="text" name="nama" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="mb-1 block font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full rounded border border-gray-300 px-3 py-2" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="mb-1 block font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full rounded border border-gray-300 px-3 py-2" rows="3" required></textarea>
                    </div>

                    <!-- Laporan -->
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
});

console.log(form.selectedOption);

// method
const submitForm = () => {
    router.post('/pengajuan', form);
};
</script>
