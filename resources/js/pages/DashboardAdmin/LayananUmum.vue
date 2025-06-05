<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage, router } from '@inertiajs/vue3';
import { defineProps, ref, computed, watch } from 'vue';
import PlaceholderPattern from "@/components/PlaceholderPattern.vue";
import SuratIjinKegiatan from "@/components/layananumum/SuratIjinKegiatanComponent.vue";
import PelaporanMasyarakat from "@/components/layananumum/PelaporanMasyarakatComponent.vue";
import BantuanSosial from "@/components/layananumum/BantuanSosialComponent.vue";
import { notify } from '@kyvg/vue3-notification';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Layanan Umum',
        href: '/admin/layanan-umum',
    },
];


// handle notifiation
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

// select layanan umum
const selectedLayananUmum = ref('surat_ijin_kegiatan');

watch(selectedLayananUmum, (value: any) => {
  router.get('/admin/layanan-umum', { layanan: value }, {
    preserveScroll: true,
    preserveState: true,
    replace: true,
  });
});


// data props
const props = defineProps({
    dataSuratIjinKegiatan: Object,
    dataPelaporanMasyarakat: Object,
    dataBantuanSosial: Object
})
const dataSuratIjinKegiatan = computed(() => props?.dataSuratIjinKegiatan);
const dataPelaporanMasyarakat = computed(() => props?.dataPelaporanMasyarakat);
const dataBantuanSosial = computed(() => props?.dataBantuanSosial);
</script>

<template>

    <Head title="Layanan Umum" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
             <!-- notifikasi -->
        <Notifications/>
            <!-- option layanan umum -->
             <select v-model="selectedLayananUmum" class="border border-gray-300 dark:bg-gray-800 rounded-md p-2">
                <option value="surat_ijin_kegiatan">Surat Ijin Kegiatan</option>
                <option value="bantuan_sosial">Bantuan Sosial</option>
                <option value="pelaporan_masyarakat">Pelaporan Masyarakat</option>
             </select>
            <!-- bagian data layanan umum surat ijin kegiatan -->
             <SuratIjinKegiatan :dataIjin="dataSuratIjinKegiatan" v-if="selectedLayananUmum === 'surat_ijin_kegiatan'"/>

             <!-- bagian data layanan umum pelaporan masyarakat -->
              <PelaporanMasyarakat :datalapor="dataPelaporanMasyarakat" v-if="selectedLayananUmum === 'pelaporan_masyarakat'"/>

              <!-- bagian data layanan umum bantuan sosial -->
               <BantuanSosial :dataBantuan="dataBantuanSosial" v-if="selectedLayananUmum === 'bantuan_sosial'"/>
        </div>
    </AppLayout>
</template>
