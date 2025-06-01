<script setup lang="ts">
import { Head, Link, useForm, usePage } from "@inertiajs/vue3"
import { Input } from "@/components/ui/input";
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { computed, watch, onMounted, defineProps } from 'vue'
import { notify } from '@kyvg/vue3-notification';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Surat Ijin Kegiatan',
        href: '/surat-ijin-kegiatan-get',
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

type SuratIjinKegiatanUpdate = {
    nama: string,
    alamat: string,
    tempat_kegiatan: string,
    tanggal_kegiatan: string,
    no_hp: string,
    jenis_kelamin: string,
    tujuan_kegiatan: string
}

// data update
const formUpdate = useForm<SuratIjinKegiatanUpdate>({
    nama: '',
    alamat: '',
    tempat_kegiatan: '',
    tanggal_kegiatan: '',
    no_hp: '',
    jenis_kelamin: '',
    tujuan_kegiatan: ''
})

// handle data props
const props = defineProps<{
  SuratIjinKegiatanByIdUpdate: any
}>()

onMounted(() => {
    formUpdate.nama = props.SuratIjinKegiatanByIdUpdate.nama
  formUpdate.alamat = props.SuratIjinKegiatanByIdUpdate.alamat
  formUpdate.tempat_kegiatan = props.SuratIjinKegiatanByIdUpdate.tempat_kegiatan
  formUpdate.tanggal_kegiatan = props.SuratIjinKegiatanByIdUpdate.tanggal_kegiatan
  formUpdate.no_hp = props.SuratIjinKegiatanByIdUpdate.no_hp
  formUpdate.jenis_kelamin = props.SuratIjinKegiatanByIdUpdate.jenis_kelamin
  formUpdate.tujuan_kegiatan = props.SuratIjinKegiatanByIdUpdate.tujuan_kegiatan
})

watch(
  () => props.SuratIjinKegiatanByIdUpdate,
  (newVal: any) => {
    if (!formUpdate.isDirty) {
      formUpdate.nama = newVal.nama
      formUpdate.alamat = newVal.alamat
      formUpdate.tempat_kegiatan = newVal.tempat_kegiatan
      formUpdate.tanggal_kegiatan = newVal.tanggal_kegiatan
      formUpdate.no_hp = newVal.no_hp
      formUpdate.jenis_kelamin = newVal.jenis_kelamin
      formUpdate.tujuan_kegiatan = newVal.tujuan_kegiatan
    }
  },
  { deep: true }
)

// handle update
const handleUpdate = () => {
    try {
        formUpdate.put(route('surat-ijin-kegiatan.update', props.SuratIjinKegiatanByIdUpdate.id), {
            onSuccess: () => {
                console.log('Success')
            },
            onError: (err: any) => {
                console.log(err)
            }
        })
    } catch (error) {
        console.log(error)
    }
}
</script>

<template>
    <div>

        <Head title="Edit Surat Ijin Kegiatan" />
        <AppLayout :breadcrumbs="breadcrumbs">
            <Notifications/>
            <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <h1 class="text-2xl mb-4">Update Surat Ijin Kegiatan</h1>
                <form @submit.prevent="handleUpdate" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kolom Kiri -->
                        <div class="space-y-4">
                            <div>
                                <label for="nama" class="block mb-1 font-medium text-sm text-gray-700">Nama</label>
                                <Input id="nama" class="w-full" v-model="formUpdate.nama" />
                            </div>

                            <div>
                                <label for="alamat" class="block mb-1 font-medium text-sm text-gray-700">Alamat</label>
                                <Input id="alamat" class="w-full" v-model="formUpdate.alamat" />
                            </div>

                            <div>
                                <label for="tempat_kegiatan" class="block mb-1 font-medium text-sm text-gray-700">Tempat
                                    Kegiatan</label>
                                <Input id="tempat_kegiatan" class="w-full" v-model="formUpdate.tempat_kegiatan" />
                            </div>

                            <div>
                                <label for="no_hp" class="block mb-1 font-medium text-sm text-gray-700">No HP</label>
                                <Input id="no_hp" type="text" class="w-full" v-model="formUpdate.no_hp" />
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="space-y-4">
                            <div>
                                <label for="tanggal_kegiatan"
                                    class="block mb-1 font-medium text-sm text-gray-700">Tanggal Kegiatan</label>
                                <Input id="tanggal_kegiatan" type="date" class="w-full"
                                    v-model="formUpdate.tanggal_kegiatan" />
                            </div>

                            <div>
                                <label for="jenis_kelamin" class="block mb-1 font-medium text-sm text-gray-700">Jenis
                                    Kelamin</label>
                                <select id="jenis_kelamin" class="w-full rounded-md border p-2 border-gray-300"
                                    v-model="formUpdate.jenis_kelamin">
                                    <option value="" disabled>Pilih jenis kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label for="tujuan_kegiatan" class="block mb-1 font-medium text-sm text-gray-700">Tujuan
                                    Kegiatan</label>
                                <textarea  id="tujuan_kegiatan" v-model="formUpdate.tujuan_kegiatan" class="w-full rounded-md border p-2 border-gray-300"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 cursor-pointer py-2 bg-[#00bfa8] text-white rounded hover:bg-[#00bfa8]/80">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </AppLayout>

    </div>
</template>
