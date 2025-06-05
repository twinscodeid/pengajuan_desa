<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pelaporan Masyarakat',
        href: '/admin/layanan-umum',
    },
];

type User = {
    name: string;
    email: string;
};

const props = defineProps<{
    dataPelaporanMasyarakat: {
        id: number;
        nama: string;
        jenis_kelamin: string;
        alamat: string;
        laporan: string;
        created_at: string;
        user: User;
    };
}>();
</script>

<template>

    <Head title="Detail Pelaporan Masyarakat" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 p-4 bg-white dark:bg-gray-900">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Detail Pelaporan Masyarakat</h1>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-lg">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold text-gray-600 dark:text-gray-400">Nama</label>
                        <p class="text-gray-900 dark:text-gray-100">{{ props?.dataPelaporanMasyarakat?.nama }}</p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600 dark:text-gray-400">Jenis Kelamin</label>
                        <p class="text-gray-900 dark:text-gray-100">{{ props?.dataPelaporanMasyarakat?.jenis_kelamin }}
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600 dark:text-gray-400">Diajukan Oleh</label>
                        <p class="text-gray-900 dark:text-gray-100">{{ props?.dataPelaporanMasyarakat?.user?.name }}</p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600 dark:text-gray-400">Alamat</label>
                        <p class="text-gray-900 dark:text-gray-100">{{ props?.dataPelaporanMasyarakat?.alamat }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="font-semibold text-gray-600 dark:text-gray-400">Isi Laporan</label>
                        <div
                            class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded text-gray-800 dark:text-gray-100">
                            {{ props?.dataPelaporanMasyarakat?.laporan }}
                        </div>
                    </div>

                    <div class="md:col-span-2 text-right mt-4">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Dibuat pada: {{ new Date(props?.dataPelaporanMasyarakat?.created_at).toLocaleString() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>

</template>
