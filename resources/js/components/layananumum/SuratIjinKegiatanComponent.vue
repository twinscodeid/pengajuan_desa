<script setup lang="ts">
import { templateRef } from '@vueuse/core';
import { defineProps, ref } from 'vue';
import { formatDate } from '@/composables/useFormateDate';
import { SquarePen, Trash2, Eye, Mail } from 'lucide-vue-next';
import { Link, Head, router } from '@inertiajs/vue3';

const isDialogOpenRead = ref(false)
const handleDialogRead = () => {
    isDialogOpenRead.value = !isDialogOpenRead.value
}
// data
const props = defineProps({
    data: Object
})

const sendEmail = (id: any) => {
    router.post(route('surat-ijin-kegiatan.send-email', id), {}, {
        onSuccess: () => alert('Email terkirim!'),
        onError: () => alert('Gagal mengirim email.')
    })
}

</script>
<template>
    <div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 whitespace-nowrap">
                    <tr>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">
                            Nama
                        </th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">
                            Tempat Kegiatan
                        </th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">
                            Tanggal Kegiatan
                        </th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200 whitespace-nowrap">
                    <tr v-for="item in props?.data?.data" :key="item.id">
                        <td class="px-4 py-4 text-sm text-slate-900 font-medium">
                            {{ item.nama }}
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600 font-medium">
                            {{ item.tempat_kegiatan }}
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600 font-medium">
                            {{ formatDate(item.tanggal_kegiatan) }}
                        </td>
                        <td class="px-4 py-4 text-sm">
                            <button
                                class="cursor-pointer px-3 py-2 rounded-md text-white bg-orange-600 font-medium mr-4 hover:bg-orange-800">
                                <SquarePen class="w-4 h-4" />
                            </button>
                            <Link :href="route('surat-ijin-kegiatan.destroy', item.id)" method="delete" as="button"
                                class="cursor-pointer px-3 py-2 rounded-md text-white bg-red-600 font-medium mr-4 hover:bg-red-800">
                            <Trash2 class="w-4 h-4" />
                            </Link>

                            <button
                                class="cursor-pointer px-3 py-2 rounded-md text-white bg-green-600 font-medium mr-4 hover:bg-green-800">
                                <Link :href="route('surat-ijin-kegiatan.show', item.id)">
                                <Eye class="w-4 h-4" />
                                </Link>
                            </button>
                            <button @click="sendEmail(item.id)"
                                class="px-3 py-2 rounded-md text-white bg-yellow-600 font-medium hover:bg-yellow-800">
                                <Mail class="w-4 h-4" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



    </div>
</template>
