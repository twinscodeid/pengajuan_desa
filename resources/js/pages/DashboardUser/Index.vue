<script setup lang="ts">
import gambarForm from '@/asset/img/FORM1.png';
import { SuratIjinKegiatan, LaporanMasyarakat } from '@/types/general';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { reactive, watch, computed } from 'vue';
import { UserCircleIcon } from '@heroicons/vue/24/solid';
import { notify } from '@kyvg/vue3-notification';


// handle notifiation
const flash = computed(() => usePage().props.flash);
const errors = computed(() => usePage().props.errors);

watch(flash, (value: any) => {
  if (value?.success) {
    notify({
      title: "Sukses!",
      text: value.success,
      type: "success",
      duration: 3000,
    });
  }
}, { immediate: true });



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
    image_pengantar_rt_rw: [],
});

const dataLaporanMasyarakat = useForm<LaporanMasyarakat>({
    nama: '',
    jenis_kelamin: '',
    alamat: '',
    laporan: '',
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
    if (form.selectedOption === 'izin') {
        dataIjinKegiatan.post(route('surat-ijin-kegiatan.store'), {
            forceFormData: true,
            onSuccess: () => {
                form.selectedOption = '';
                dataIjinKegiatan.reset();
            },
            onError: (errors: any) => {
                console.log(errors.value);
            },
        });
    } else if (form.selectedOption === 'laporan_masyarakat') {
        dataLaporanMasyarakat.post(route('laporan-masyarakat.store'), {
            onSuccess: () => {
                form.selectedOption = '';
                dataLaporanMasyarakat.reset();
            },
            onError: (errors: any) => {
                console.log(errors.value);
            },
        });
    }
};
</script>

<template>
    <div class="page-wrapper relative min-h-screen">
        <!-- notifikasi -->
        <Notifications/>
        <!-- Navbar Mengambang -->
        <nav class="fixed top-0 left-0 z-50 flex w-full items-center justify-between bg-white px-6 py-4 shadow-md">
            <div class="flex items-center gap-4">
                <Link href="/profile" class="flex items-center gap-1 text-gray-700 hover:underline">
                    <UserCircleIcon class="h-6 w-6 text-[#00bfa8]" />
                    <span class="hidden sm:inline">Profil</span>
                </Link>
            </div>
        </nav>
        <!-- Tempat Gambar -->
        <div class="pt-0 md:pt-10 lg:pt-20">
            <div class="flex items-center justify-center bg-white">
                <div class="w-full overflow-hidden rounded-lg shadow-md md:w-[500px]">
                    <img :src="gambarForm" alt="Form Gambar" class="h-auto w-full object-cover" />
                </div>
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
                        <label class="mb-1 block font-semibold text-black">Nama Lengkap</label>
                        <input type="text" name="nama" class="w-full rounded border border-gray-300 px-3 py-2" required />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold text-black">NIK</label>
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
                        <div v-if="errors.nama" class="text-red-500 text-sm">{{ errors.nama }}</div>
                        <input
                            type="text"
                            name="nama"
                            class="w-full rounded border border-gray-300 px-3 py-2"
                            v-model="dataIjinKegiatan.nama"
                        />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Alamat</label>
                        <div v-if="errors.alamat" class="text-red-500 text-sm">{{ errors.alamat }}</div>
                        <textarea
                            name="alamat"
                            class="w-full rounded border border-gray-300 px-3 py-2"
                            rows="3"
                            v-model="dataIjinKegiatan.alamat"
                        ></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Tanggal Kegiatan</label>
                        <div v-if="errors.tanggal_kegiatan" class="text-red-500 text-sm">{{ errors.tanggal_kegiatan }}</div>
                        <input
                            type="date"
                            name="tanggal_kegiatan"
                            class="w-full rounded border border-gray-300 px-3 py-2"
                            v-model="dataIjinKegiatan.tanggal_kegiatan"
                        />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Tempat Kegiatan</label>
                        <div v-if="errors.tempat_kegiatan" class="text-red-500 text-sm">{{ errors.tempat_kegiatan }}</div>
                        <textarea
                            name="tempat_kegiatan"
                            class="w-full rounded border border-gray-300 px-3 py-2"
                            rows="2"
                            v-model="dataIjinKegiatan.tempat_kegiatan"
                        ></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">No HP</label>
                        <div v-if="errors.no_hp" class="text-red-500 text-sm">{{ errors.no_hp }}</div>
                        <input
                            type="text"
                            name="no_hp"
                            class="w-full rounded border border-gray-300 px-3 py-2"
                            v-model="dataIjinKegiatan.no_hp"
                        />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Jenis Kelamin</label>
                        <div v-if="errors.jenis_kelamin" class="text-red-500 text-sm">{{ errors.jenis_kelamin }}</div>
                        <select
                            name="jenis_kelamin"
                            class="w-full rounded border border-gray-300 px-3 py-2"
                            v-model="dataIjinKegiatan.jenis_kelamin"
                        >
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Tujuan Kegiatan</label>
                        <div v-if="errors.tujuan_kegiatan" class="text-red-500 text-sm">{{ errors.tujuan_kegiatan }}</div>
                        <textarea
                            name="tujuan_kegiatan"
                            class="w-full rounded border border-gray-300 px-3 py-2"
                            rows="4"
                            v-model="dataIjinKegiatan.tujuan_kegiatan"
                        ></textarea>
                    </div>
                    <div>
                        <label class="mb-1 block font-semibold">Upload Dokumen (Surat Keterangan RT/RW)</label>
                        <span>type file : jpg, jpeg, png | max 2mb | min-max 2 file</span>
                        <div v-if="errors.image_pengantar_rt_rw" class="text-red-500 text-sm">{{ errors.image_pengantar_rt_rw }}</div>
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
                        <input type="text" name="nama" class="w-full rounded border border-gray-300 px-3 py-2" required v-model="dataLaporanMasyarakat.nama" />
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full rounded border border-gray-300 px-3 py-2" required v-model="dataLaporanMasyarakat.jenis_kelamin">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Alamat</label>
                        <textarea name="alamat" class="w-full rounded border border-gray-300 px-3 py-2" rows="3" required v-model="dataLaporanMasyarakat.alamat"></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block font-semibold">Isi Laporan</label>
                        <textarea
                            name="laporan"
                            class="w-full rounded border border-gray-300 px-3 py-2"
                            rows="5"
                            placeholder="Tuliskan laporan masyarakat..."
                            required
                            v-model="dataLaporanMasyarakat.laporan"
                        ></textarea>
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-lg py-2 font-semibold text-white transition duration-300"
                    style="background-color: #00bfa8"
                    onmouseover="this.style.backgroundColor='#009e93'"
                    onmouseout="this.style.backgroundColor='#00bfa8'"
                >
                    Kirim Pengajuan
                </button>

                <div class="info" v-if="flash?.success">Mohon ditunggu, Admin akan segera menghubungi anda melalui Email</div>
            </form>
        </div>
    </div>
</template>

<style scoped>
.page-wrapper {
    background-color: #f9f9f9;
    color: #000;
}

.container {
    max-width: 1024px;
    margin: 0 auto;
    padding: 1rem;
}
/* Untuk semua label, input, select, textarea, dan tombol */
form label,
form input,
form textarea,
form select {
    color: #000 !important;
}
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
    color: rgb(0, 0, 0);
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
