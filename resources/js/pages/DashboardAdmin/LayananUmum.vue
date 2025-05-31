<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { defineProps, ref, computed } from 'vue';
import PlaceholderPattern from "@/components/PlaceholderPattern.vue";
import SuratIjinKegiatan from "@/components/layananumum/SuratIjinKegiatanComponent.vue";
import PelaporanMasyarakat from "@/components/layananumum/PelaporanMasyarakatComponent.vue";
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Layanan Umum',
        href: '/layanan-umum',
    },
];

// select layanan umum
const selectedLayananUmum = ref('surat_ijin_kegiatan');

// data props
const props = defineProps({
    dataSuratIjinKegiatan: Object,
    dataPelaporanMasyarakat: Object
})
const dataSuratIjinKegiatan = computed(() => props?.dataSuratIjinKegiatan);
const dataPelaporanMasyarakat = computed(() => props?.dataPelaporanMasyarakat);
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- option layanan umum -->
             <select v-model="selectedLayananUmum" class="border border-gray-300 rounded-md p-2">
                <option value="surat_ijin_kegiatan">Surat Ijin Kegiatan</option>
                <option value="bantuan_sosial">Bantuan Sosial</option>
                <option value="pelaporan_masyarakat">Pelaporan Masyarakat</option>
             </select>
            <!-- bagian data layanan umum surat ijin kegiatan -->
             <SuratIjinKegiatan :dataIjin="dataSuratIjinKegiatan" v-if="selectedLayananUmum === 'surat_ijin_kegiatan'"/>

             <!-- bagian data layanan umum pelaporan masyarakat -->
              <PelaporanMasyarakat :datalapor="dataPelaporanMasyarakat" v-if="selectedLayananUmum === 'pelaporan_masyarakat'"/>
        </div>
    </AppLayout>
</template>
