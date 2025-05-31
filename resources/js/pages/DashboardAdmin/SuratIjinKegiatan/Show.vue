<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import 'dayjs/locale/id';
import { defineProps } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';


dayjs.locale('id');

const props = defineProps({
    dataSuratIjinKegiatanById: Object
});
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Detail Surat Ijin Kegiatan',
        href: '/pelaporan-masyarakat',
    },
];
const data = props?.dataSuratIjinKegiatanById;
</script>

<template>

    <Head title="Detail Surat Ijin Kegiatan" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="p-6 sm:p-8 rounded-lg space-y-6">
                <h2 class="text-2xl font-bold text-slate-800">Detail Surat Ijin Kegiatan</h2>

                <div class="grid md:grid-cols-2 gap-6 text-sm text-slate-700">
                    <div>
                        <p><span class="font-semibold">Nama:</span> {{ data?.nama }}</p>
                        <p><span class="font-semibold">Alamat:</span> {{ data?.alamat }}</p>
                        <p><span class="font-semibold">Tempat Kegiatan:</span> {{ data?.tempat_kegiatan }}</p>
                        <p><span class="font-semibold">Tanggal Kegiatan:</span> {{
                            dayjs(data?.tanggal_kegiatan).format('D MMMM YYYY') }}</p>
                    </div>

                    <div>
                        <p><span class="font-semibold">No HP:</span> {{ data?.no_hp }}</p>
                        <p><span class="font-semibold">Jenis Kelamin:</span> {{ data?.jenis_kelamin }}</p>
                        <p><span class="font-semibold">Tujuan Kegiatan:</span> {{ data?.tujuan_kegiatan }}</p>
                        <p><span class="font-semibold">Diajukan oleh:</span> {{ data?.user?.name }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-2 text-slate-800">Surat Pengantar RT/RW</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" v-viewer>
                        <img v-for="img in data?.surat_pengantar_r_t_r_w" :key="img.id"
                            :src="`/private-image/${img.image_path.split('/').pop()}`" alt="Surat Pengantar"
                            class="rounded shadow border object-cover w-full h-60 cursor-zoom-in" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>


</template>
