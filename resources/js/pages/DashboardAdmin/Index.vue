<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { defineProps, watch, ref, onMounted } from 'vue';
import { Chart } from "chart.js/auto";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard Admin',
        href: '/dashboard-admin',
    },
];

const props = defineProps({
    totalSuratIjinKegiatan: Number,
    totalPelaporanMasyarakat: Number,
    totalBantuanSosial: Number,
    totalRoleUser: Number,
    labels: Array,
    suratData: Array,
    pelaporanData: Array,
    bantuanData: Array,
})

const chartRef = ref(null);
let chart = null;

watch(props, () => {
    if (props.suratData && props.pelaporanData && props.bantuanData && chart) {
        chart.data.dataset[0].data = [
            ...props.suratData,
            ...props.pelaporanData,
            ...props.bantuanData
        ];
        chart.update()
    }
}, {
    deep: true,
})


onMounted(() => {
    chart = new Chart(chartRef.value, {
        type: 'line',
        data: {
            labels: props.labels,
            datasets: [
                {
                    label: 'Surat Ijin Kegiatan',
                    fill: true,
                    data: props.suratData,
                    backgroundColor: 'rgba(33, 150, 243, 0.15)', // soft blue
                    borderColor: 'rgba(33, 150, 243, 1)',        // primary blue
                    pointBackgroundColor: 'rgba(33, 150, 243, 0.9)',
                    borderWidth: 2,
                    tension: 0.1,
                },
                {
                    label: 'Pelaporan Masyarakat',
                    fill: true,
                    data: props.pelaporanData,
                    backgroundColor: 'rgba(76, 175, 80, 0.15)',  // soft green
                    borderColor: 'rgba(76, 175, 80, 1)',         // fresh green
                    pointBackgroundColor: 'rgba(76, 175, 80, 0.9)',
                    borderWidth: 2,
                    tension: 0.1,
                },
                {
                    label: 'Bantuan Sosial',
                    fill: true,
                    data: props.bantuanData,
                    backgroundColor: 'rgba(255, 193, 7, 0.15)',  // soft yellow
                    borderColor: 'rgba(255, 193, 7, 1)',         // warm yellow
                    pointBackgroundColor: 'rgba(255, 193, 7, 0.9)',
                    borderWidth: 2,
                    tension: 0.1,
                },
            ]
        },
    });
})

</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex flex-wrap -mx-3">
                <!-- card1 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row items-center justify-between -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans font-semibold leading-normal text-sm">Surat Ijin
                                            Kegiatan</p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                        <h5 class="mb-0 font-bold text-white">
                                            {{ props.totalSuratIjinKegiatan }}
                                            <!-- <span
                                                class="leading-normal text-sm font-weight-bolder text-lime-500">+55%</span> -->
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row items-center justify-between -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans font-semibold leading-normal text-sm">Pelaporan
                                            Masyarakat</p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-orange-700 to-yellow-500">
                                        <h5 class="mb-0 font-bold text-white">
                                            {{ props.totalPelaporanMasyarakat }}
                                            <!-- <span class="leading-normal text-sm font-weight-bolder text-lime-500">+3%</span> -->
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card3 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row items-center justify-between -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans font-semibold leading-normal text-sm">Bantuan Sosial
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-cyan-700 to-green-500">
                                        <h5 class="mb-0 font-bold text-white">
                                            {{ props.totalBantuanSosial }}
                                            <!-- <span class="leading-normal text-red-600 text-sm font-weight-bolder">-2%</span> -->
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card4 -->
                <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row items-center justify-between -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans font-semibold leading-normal text-sm">Masyarakat</p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-700 to-yellow-500">
                                        <h5 class="mb-0 font-bold text-white">
                                            {{ props.totalRoleUser }}
                                            <!-- <span class="leading-normal text-sm font-weight-bolder text-lime-500">+5%</span> -->
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-10/12 flex flex-col mt-4">
                <div>
                    <canvas ref="chartRef" id="statusChart" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
