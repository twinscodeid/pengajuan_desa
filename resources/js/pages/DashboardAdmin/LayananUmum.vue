<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { defineProps, computed } from 'vue';
import PlaceholderPattern from "@/components/PlaceholderPattern.vue";
import SuratIjinKegiatan from "@/components/layananumum/SuratIjinKegiatanComponent.vue";
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Layanan Umum',
        href: '/layanan-umum',
    },
];

// data props
const props = defineProps({
    dataSuratIjinKegiatan: Object
})
const data = computed(() => props?.dataSuratIjinKegiatan);
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- bagian data layanan umum surat ijin kegiatan -->
             <SuratIjinKegiatan :data="data" />
        </div>
    </AppLayout>
</template>
