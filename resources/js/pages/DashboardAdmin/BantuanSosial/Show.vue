<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Bantuan Sosial',
        href: '/admin/layanan-umum',
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
        <div class="flex flex-col gap-6 p-4 bg-white dark:bg-gray-900">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Detail Bantuan Sosial</h2>

            <!-- Data Utama -->
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow dark:shadow-lg grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Nama</p>
                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ data?.nama }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">NIK</p>
                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ data?.nik }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Lahir</p>
                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ data?.tanggal_lahir }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Jenis Kelamin</p>
                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ data?.jenis_kelamin }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Status Perkawinan</p>
                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ data?.status_perkawinan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Agama</p>
                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ data?.agama }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Kewarganegaraan</p>
                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ data?.kewarganegaraan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Alamat</p>
                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ data?.alamat }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Pekerjaan</p>
                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ data?.pekerjaan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">No HP</p>
                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ data?.no_hp }}</p>
                </div>
            </div>

            <!-- Data User Pengaju -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow dark:shadow-lg">
                <h3 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Data Pengaju</h3>
                <p><span class="text-gray-500 dark:text-gray-400">Nama:</span> <span
                        class="text-gray-900 dark:text-gray-100">{{ data?.user.name }}</span></p>
            </div>

            <!-- Gambar Surat Pengantar -->
            <div v-if="data?.image_surat_pengantar_r_t_r_w.length"
                class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow dark:shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Surat Pengantar RT/RW</h3>
                <div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" v-viewer>
                        <img v-for="img in data?.image_surat_pengantar_r_t_r_w" :key="img.id"
                            :src="`/admin/private-image/${img.image_path.split('/').pop()}`" alt="Surat Pengantar"
                            class="rounded shadow border object-cover w-full h-60 cursor-zoom-in" />
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
