<script setup lang="ts">
import { Link, head, router } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import { formatDate } from '@/composables/useFormateDate';
import { SquarePen, Trash2, Eye, Mail } from 'lucide-vue-next';

const goToPage = (page: number) => {
    router.get(route('layanan.admin'), { page }, {
        preserveState: true,
        preserveScroll: true,
    })
}

const props = defineProps({
    datalapor: Object
})

const sendEmail = (id: any) => {
    router.post(route('pelaporan-masyarakat.send-email-pelaporan', id), {}, {
        onSuccess: () => alert('Email terkirim!'),
        onError: () => alert('Gagal mengirim email.')
    })
}

</script>

<template>
    <div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 whitespace-nowrap">
                    <tr>
                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-slate-900 dark:text-white uppercase tracking-wider">
                            Nama
                        </th>
                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-slate-900 dark:text-white uppercase tracking-wider">
                            Alamat
                        </th>
                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-slate-900 dark:text-white uppercase tracking-wider">
                            Tanggal Dibuat
                        </th>
                        <th
                            class="px-4 py-4 text-left text-xs font-semibold text-slate-900 dark:text-white uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody
                    class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700 whitespace-nowrap">
                    <tr v-for="item in props?.datalapor?.data" :key="item.id">
                        <td class="px-4 py-4 text-sm text-slate-900 dark:text-white font-medium">
                            {{ item.nama }}
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600 dark:text-gray-300 font-medium">
                            {{ item.alamat }}
                        </td>
                        <td class="px-4 py-4 text-sm text-slate-600 dark:text-gray-300 font-medium">
                            {{ formatDate(item.created_at) }}
                        </td>
                        <td class="px-4 py-4 text-sm">
                            <div class="flex flex-wrap gap-2">
                                <Link :href="route('pelaporan-masyarakat.destroy', item.id)" method="delete" as="button"
                                    class="flex items-center px-3 py-2 rounded-md text-white bg-red-600 font-medium hover:bg-red-800 cursor-pointer">
                                <Trash2 class="w-4 h-4" />
                                </Link>

                                <Link :href="route('pelaporan-masyarakat.show', item.id)"
                                    class="flex items-center px-3 py-2 rounded-md text-white bg-green-600 font-medium hover:bg-green-800">
                                <Eye class="w-4 h-4" />
                                </Link>

                                <button @click="sendEmail(item.id)"
                                    class="flex cursor-pointer items-center px-3 py-2 rounded-md text-white bg-yellow-600 font-medium hover:bg-yellow-800">
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
                    @click="goToPage(props?.datalapor?.current_page - 1)" :disabled="!props?.datalapor?.prev_page_url">
                    &laquo;
                </Button>

                <span class="text-sm">
                    Halaman {{ props?.datalapor?.current_page }} dari {{ props?.datalapor?.last_page }}
                </span>

                <Button variant="outline" size="sm" class="py-1 px-3 bg-[#bbe5e1] rounded-md cursor-pointer"
                    @click="goToPage(props?.datalapor?.current_page + 1)" :disabled="!props?.datalapor?.next_page_url">
                    &raquo;
                </Button>
            </div>
        </div>
    </div>
</template>
