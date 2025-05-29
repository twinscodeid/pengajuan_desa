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
            <div>
                <Link href="/register" class="mr-5 text-blue-600 hover:underline">Register</Link>
                <Link href="/login" class="text-blue-600 hover:underline">Login</Link>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex flex-col items-center justify-center gap-16 px-6 py-20 md:flex-row">
            <!-- Teks -->
            <div class="max-w-lg space-y-6 text-center text-black md:text-left">
                <h1 class="text-3xl font-bold">Selamat Datang di Forum Pengajuan Dan Pengaduan Masyarakat Desa Cepogo</h1>
                <button class="rounded bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">Mulai</button>
            </div>

            <!-- Gambar Placeholder -->
            <div class="ml-10">
                <div class="bg-white-300 flex h-85 w-85 items-center justify-center rounded">
                    <img src="../asset/img/kartini.png" alt="" class="" />
                </div>
            </div>
        </main>
    </div>
</template>
