<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import {defineProps, onMounted, watch, computed} from 'vue';
import { notify } from '@kyvg/vue3-notification';
import {Input} from '@/components/ui/input';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Bantuan Sosial',
        href: '/layanan-umum',
    },
];

const flash = computed(() => usePage().props.flash);

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

type BantuanSosialUpdate = {
    nama: string,
    nik: string,
    tanggal_lahir: string,
    jenis_kelamin: string,
    status_perkawinan: string,
    agama: string,
    kewarganegaraan: string,
    alamat: string,
    pekerjaan: string,
    no_hp: string,
}

const props = defineProps({
    BantuanSosialByIdUpdate: Object
})

const formUpdate = useForm<BantuanSosialUpdate>({
    nama: '',
    nik: '',
    tanggal_lahir: '',
    jenis_kelamin: '',
    status_perkawinan: '',
    agama: '',
    kewarganegaraan: '',
    alamat: '',
    pekerjaan: '',
    no_hp: '',
})

onMounted(() => {
    formUpdate.nama = props?.BantuanSosialByIdUpdate?.nama
    formUpdate.nik = props?.BantuanSosialByIdUpdate?.nik
    formUpdate.tanggal_lahir = props?.BantuanSosialByIdUpdate?.tanggal_lahir
    formUpdate.jenis_kelamin = props?.BantuanSosialByIdUpdate?.jenis_kelamin
    formUpdate.status_perkawinan = props?.BantuanSosialByIdUpdate?.status_perkawinan
    formUpdate.agama = props?.BantuanSosialByIdUpdate?.agama
    formUpdate.kewarganegaraan = props?.BantuanSosialByIdUpdate?.kewarganegaraan
    formUpdate.alamat = props?.BantuanSosialByIdUpdate?.alamat
    formUpdate.pekerjaan = props?.BantuanSosialByIdUpdate?.pekerjaan
    formUpdate.no_hp = props?.BantuanSosialByIdUpdate?.no_hp
})

watch(
  () => props?.BantuanSosialByIdUpdate,
  (newVal: any) => {
    formUpdate.nama = newVal?.nama
    formUpdate.nik = newVal?.nik
    formUpdate.tanggal_lahir = newVal?.tanggal_lahir
    formUpdate.jenis_kelamin = newVal?.jenis_kelamin
    formUpdate.status_perkawinan = newVal?.status_perkawinan
    formUpdate.agama = newVal?.agama
    formUpdate.kewarganegaraan = newVal?.kewarganegaraan
    formUpdate.alamat = newVal?.alamat
    formUpdate.pekerjaan = newVal?.pekerjaan
    formUpdate.no_hp = newVal?.no_hp
  }
)

// handle update
const handleUpdate = () => {
    formUpdate.put(route('bantuan-sosial.update', props?.BantuanSosialByIdUpdate?.id), {
        onSuccess: () => {
            console.log('Success')
        },
        onError: (err: any) => {
            console.log(err)
        }
    })
}
</script>

<template>
    <Head title="Bantuan Sosial" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <Notifications/>
    <div class="p-4 space-y-6 bg-white rounded-lg">
      <h2 class="text-xl font-bold">Edit Data Bantuan Sosial</h2>

      <form @submit.prevent="handleUpdate" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label>Nama</label>
          <Input v-model="formUpdate.nama" type="text" class="form-input w-full" />
          <!-- <span v-if="form.errors.nama" class="text-red-500 text-sm">{{ form.errors.nama }}</span> -->
        </div>

        <div>
          <label>NIK</label>
          <Input v-model="formUpdate.nik" type="text" class="form-input w-full" />
          <!-- <span v-if="form.errors.nik" class="text-red-500 text-sm">{{ form.errors.nik }}</span> -->
        </div>

        <div>
          <label>Tanggal Lahir</label>
          <Input v-model="formUpdate.tanggal_lahir" type="date" class="form-input w-full" />
        </div>

        <div>
          <label>Jenis Kelamin</label>
          <select v-model="formUpdate.jenis_kelamin" class="form-select w-full  border border-gray-200 rounded-md p-2">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>

        <div>
          <label>Status Perkawinan</label>
          <select v-model="formUpdate.status_perkawinan" class="form-select w-full  border border-gray-200 rounded-md p-2">
            <option value="Belum kawin">Belum Kawin</option>
            <option value="Kawin">Kawin</option>
            <option value="Cerai Hidup">Cerai Hidup</option>
            <option value="Cerai Mati">Cerai Mati</option>
          </select>
        </div>

        <div>
          <label>Agama</label>
          <select v-model="formUpdate.agama" class="form-select w-full border border-gray-200 rounded-md p-2">
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Hindu">Hindu</option>
            <option value="Katholik">Katholik</option>
            <option value="Budha">Budha</option>
            <option value="Konghucu">Konghucu</option>
          </select>
        </div>

        <div>
          <label>Kewarganegaraan</label>
          <Input v-model="formUpdate.kewarganegaraan" type="text" class="form-input w-full" />
        </div>

        <div>
          <label>Pekerjaan</label>
          <Input v-model="formUpdate.pekerjaan" type="text" class="form-input w-full" />
        </div>


        <div>
            <label>No HP</label>
            <Input v-model="formUpdate.no_hp" type="text" class="form-input w-full" />
        </div>
        <div>
          <label>Alamat</label>
          <textarea v-model="formUpdate.alamat" class="form-textarea w-full  border border-gray-200 rounded-md p-2"></textarea>
        </div>

        <div class="md:col-span-2 text-right">
          <button type="submit" class="px-4 cursor-pointer py-2 bg-[#00bfa8] text-white rounded hover:bg-[#00bfa8]/80">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
