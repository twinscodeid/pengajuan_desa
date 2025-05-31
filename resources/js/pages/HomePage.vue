<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome"></Head>

    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="flex items-center justify-between bg-white p-6 shadow-md">
            <div class="text-xl font-bold">Logo</div>
            <img src="#" alt="" class="" />
            <div v-if="$page.props.auth.user?.role === 'user'">
                <Link :href="route('dashboard.index.user')" class="text-blue-600 hover:underline">Dashboard</Link>
            </div>
            <div v-else-if="$page.props.auth.user?.role === 'admin'">
                <Link :href="route('dashboard.index.admin')" class="text-blue-600 hover:underline">Dashboard</Link>
            </div>
            <div v-else>
                <Link href="/register" class="mr-5 text-blue-600 hover:underline">Register</Link>
                <Link href="/login" class="text-blue-600 hover:underline">Login</Link>
            </div>
        </header>

        <!-- Main Content -->
        <!-- Container Utama -->
        <div class="flex flex-col items-center justify-center gap-16 px-6 py-20 md:flex-row">
            <!-- Section Teks -->
            <section class="max-w-lg space-y-6 text-center text-black md:w-1/2 md:translate-x-[90px] md:text-left">
                <h1 class="text-3xl font-bold">Selamat Datang di Forum Pengajuan Dan Pengaduan Masyarakat Desa Cepogo</h1>
                <button
                    class="rounded px-6 py-3 text-white transition duration-300"
                    style="background-color: #00bfa8"
                    onmouseover="this.style.backgroundColor='#009e93'"
                    onmouseout="this.style.backgroundColor='#00bfa8'"
                >
                    Mulai
                </button>
            </section>

            <!-- Section Gambar -->
            <section class="flex justify-center md:w-1/2">
                <div class="bg-white-300 flex items-center justify-center rounded">
                    <img src="../asset/img/FORM__2.png" alt="" class="h-auto w-full max-w-[600px]" />
                </div>
            </section>
        </div>
    </div>
</template>
