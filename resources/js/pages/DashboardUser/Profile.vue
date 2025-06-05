<script setup lang="ts">
import { Head, Link, usePage, router, useForm } from '@inertiajs/vue3';
import { ref, onMounted, watch, computed, defineProps } from 'vue';
import { LogOut } from 'lucide-vue-next';
import { notify } from '@kyvg/vue3-notification';


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

const user = usePage().props.auth.user;
const props = defineProps({
    dataUser: Object
})
type User = {
    name: string,
    email: string,
}
const role = ref(props?.dataUser?.role.name);
const form = useForm<User>({
    name: '',
    email: '',
});

onMounted(() => {
    form.name = user.name;
    form.email = user.email;
})

watch(() => user, (newVal: any) => {
    form.name = newVal.name;
    form.email = newVal.email;
})

const handleLogout = () => {
    router.flushAll();
};

const handleUpdateUser = () => {
    form.patch(route('profile-user.update'), {
        preserveScroll: true,
    });
};


</script>
<template>

    <Head title="Profile user" />
    <div class="min-h-screen bg-white text-black">
        <!-- notifikasi -->
        <Notifications/>
        <!-- Navbar -->
        <nav class="sticky top-0 z-50 flex items-center justify-between bg-white px-6 py-3 shadow-md">
            <div class="flex items-center gap-2">
                <Link :href="route('dashboard.index.user')" class="flex items-center hover:underline">
                <span class="text-xl">←</span>
                <span class="ml-1 font-medium">Kembali</span>
                </Link>
            </div>
            <div></div>
        </nav>

        <!-- FORM dibungkus dan dibatasi -->
        <div class="mx-auto max-w-3xl px-4 py-10">
            <div class="mt-1 text-center text-lg font-semibold">Profil Pengguna</div>
            <form @submit.prevent="handleUpdateUser" class="space-y-6">
                <div>
                    <label for="name" class="mb-1 block font-medium">Nama Lengkap</label>
                    <input id="name" type="text" v-model="form.name" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>

                <div>
                    <label for="email" class="mb-1 block font-medium">Email</label>
                    <input id="email" type="email" v-model="form.email" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>

                <div>
                    <label for="role" class="mb-1 block font-medium">Role Pengguna</label>
                    <input id="role" type="text" v-model="role" disabled
                        class="w-full cursor-not-allowed rounded-lg border border-gray-300 bg-gray-100 px-4 py-2 text-black" />
                </div>

                <button :disabled="form.processing" type="submit" class="w-full rounded-lg py-2 font-semibold text-white cursor-pointer transition duration-300"
                    style="background-color: #00bfa8" onmouseover="this.style.backgroundColor='#009e93'"
                    onmouseout="this.style.backgroundColor='#00bfa8'">
                    Simpan Profil
                </button>
            </form>
            <div class="mt-2">
                <Link class="flex items-center justify-center rounded-lg py-2 transition duration-300 cursor-pointer text-white font-semibold w-full bg-[#00bfa8] hover:bg-[#009e93]" method="post" :href="route('logout')" @click="handleLogout"
                    as="button">
                <LogOut class="mr-2 h-4 w-4" />
                Log out
                </Link>
            </div>
        </div>
    </div>
</template>

<style>
.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input,
textarea {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}

.message {
    margin-top: 15px;
    padding: 10px;
    background-color: #e0ffe0;
    border: 1px solid #0f0;
    color: #060;
}
</style>
