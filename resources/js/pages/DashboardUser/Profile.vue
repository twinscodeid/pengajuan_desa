<template>
    <div class="page-wrapper">
        <div class="container">
            <h2 class="title">Profil Pengguna</h2>

            <form @submit.prevent="saveProfile">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input id="name" type="text"class="border" v-model="user.name" required />
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" type="email" class="border" v-model="user.email" required />
                </div>

                <div class="form-group">
                    <label for="address">Alamat:</label>
                    <textarea id="address" class="border" v-model="user.address" required></textarea>
                </div>

                <button type="submit">Simpan Profil</button>
            </form>

            <div v-if="message" class="message">
                {{ message }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                name: '',
                email: '',
                address: '',
            },
            message: '',
        };
    },
    methods: {
        saveProfile() {
            // Contoh: hanya menampilkan pesan dan reset form
            if (!this.user.name || !this.user.email || !this.user.address) {
                this.message = 'Semua field harus diisi!';
                return;
            }

            this.message = `Profil berhasil disimpan! Nama: ${this.user.name}, Email: ${this.user.email}, Alamat: ${this.user.address}`;

            // Reset form
            this.user.name = '';
            this.user.email = '';
            this.user.address = '';
        },
    },
};
</script>

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
