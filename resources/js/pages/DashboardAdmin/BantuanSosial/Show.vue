<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Bantuan Sosial',
        href: '/layanan-umum',
    },
];

const props = defineProps({
    bantuanSosialById: Object
})

const data = props?.bantuanSosialById
</script>

<template>

    <Head title="Detail Bantuan Sosial" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 p-4">
            <h2 class="text-2xl font-bold text-gray-800">Detail Bantuan Sosial</h2>

            <!-- Data Utama -->
            <div class="bg-white p-6 rounded-xl shadow grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="font-medium">{{ data?.nama }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">NIK</p>
                    <p class="font-medium">{{ data?.nik }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Lahir</p>
                    <p class="font-medium">{{ data?.tanggal_lahir }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jenis Kelamin</p>
                    <p class="font-medium">{{ data?.jenis_kelamin }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status Perkawinan</p>
                    <p class="font-medium">{{ data?.status_perkawinan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Agama</p>
                    <p class="font-medium">{{ data?.agama }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kewarganegaraan</p>
                    <p class="font-medium">{{ data?.kewarganegaraan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Alamat</p>
                    <p class="font-medium">{{ data?.alamat }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pekerjaan</p>
                    <p class="font-medium">{{ data?.pekerjaan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">No HP</p>
                    <p class="font-medium">{{ data?.no_hp }}</p>
                </div>
            </div>

            <!-- Data User Pengaju -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-2 text-gray-700">Data Pengaju</h3>
                <p><span class="text-gray-500">Nama:</span> {{ data?.user.name }}</p>
            </div>

            <!-- Gambar Surat Pengantar -->
            <div v-if="data?.image_surat_pengantar_r_t_r_w.length" class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Surat Pengantar RT/RW</h3>
                <div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" v-viewer>
                        <img v-for="img in data?.image_surat_pengantar_r_t_r_w" :key="img.id"
                            :src="`/private-image/${img.image_path.split('/').pop()}`" alt="Surat Pengantar"
                            class="rounded shadow border object-cover w-full h-60 cursor-zoom-in" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
