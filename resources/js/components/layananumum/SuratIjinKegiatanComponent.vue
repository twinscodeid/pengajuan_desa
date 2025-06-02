<script setup lang="ts">
import { templateRef } from '@vueuse/core';
import { defineProps, ref } from 'vue';
import { formatDate } from '@/composables/useFormateDate';
import { SquarePen, Trash2, Eye, Mail } from 'lucide-vue-next';
import { Link, Head, router } from '@inertiajs/vue3';


// handle paginate
const goToPage = (page: number) => {
    router.get(route('layanan.admin'), { page }, {
        preserveState: true,
        preserveScroll: true,
    })
}




// data
const props = defineProps({
    dataIjin: Object
})

const sendEmail = (id: any) => {
    router.post(route('surat-ijin-kegiatan.send-email-kegiatan', id), {}, {
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
                    <tr v-for="item in props?.dataIjin?.data" :key="item.id">
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
                            <div class="flex flex-wrap gap-2">
                                <!-- Edit -->
                                <Link :href="route('surat-ijin-kegiatan.edit', item.id)"
                                    class="flex items-center px-3 py-2 rounded-md text-white bg-orange-600 font-medium hover:bg-orange-800">
                                <SquarePen class="w-4 h-4" />
                                </Link>

                                <!-- Delete -->
                                <Link :href="route('surat-ijin-kegiatan.destroy', item.id)" method="delete" as="button"
                                    class="flex items-center cursor-pointer px-3 py-2 rounded-md text-white bg-red-600 font-medium hover:bg-red-800">
                                <Trash2 class="w-4 h-4" />
                                </Link>

                                <!-- View -->
                                <Link :href="route('surat-ijin-kegiatan.show', item.id)"
                                    class="flex items-center px-3 py-2 rounded-md text-white bg-green-600 font-medium hover:bg-green-800">
                                <Eye class="w-4 h-4" />
                                </Link>

                                <!-- Send Email -->
                                <button @click="sendEmail(item.id)"
                                    class="flex items-center px-3 py-2 cursor-pointer rounded-md text-white bg-yellow-600 font-medium hover:bg-yellow-800">
                                    <Mail class="w-4 h-4" />
                                </button>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
            <!-- handle paginate -->
            <div class="flex justify-end items-center gap-2 mt-4">
                <Button variant="outline" size="sm" class="py-1 px-3 bg-[#bbe5e1] rounded-md cursor-pointer"
                    @click="goToPage(props?.dataIjin?.current_page - 1)" :disabled="!props?.dataIjin?.prev_page_url">
                    &laquo;
                </Button>

                <span class="text-sm">
                    Halaman {{ props?.dataIjin?.current_page }} dari {{ props?.dataIjin?.last_page }}
                </span>

                <Button variant="outline" size="sm" class="py-1 px-3 bg-[#bbe5e1] rounded-md cursor-pointer"
                    @click="goToPage(props?.dataIjin?.current_page + 1)" :disabled="!props?.dataIjin?.next_page_url">
                    &raquo;
                </Button>
            </div>
        </div>
    </div>
</template>
