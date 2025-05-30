                <script setup lang="ts">
                import { Head, Link } from '@inertiajs/vue3';
                import { ref } from 'vue';

                const form = ref({
                    name: '',
                })
                </script>
<template>
    <div class="page-wrapper">
        <div class="container">
            <div class="flex gap-2 items-center text-blue-500">
                <p>🔵</p>
                <Link :href="route('dashboard.index.user')" class="cursor-pointer hover:underline">Kembali</Link>
            </div>

            <h2 class="title">Profil Pengguna</h2>

            <form @submit.prevent="">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input id="name" type="text" class="border" v-model="form.name" required />
                </div>
                <button type="submit">Simpan Profil</button>
            </form>
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
