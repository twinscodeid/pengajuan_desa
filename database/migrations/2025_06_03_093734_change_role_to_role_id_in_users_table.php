<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom enum role
            $table->dropColumn('role');

            // Tambahkan kolom foreign key role_id
            $table->foreignId('role_id')
                ->after('password')
                ->nullable()
                ->constrained('roles')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom role_id
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');

            // Tambahkan kembali kolom enum role
            $table->enum('role', ['user', 'admin'])->default('user')->after('password');
        });
    }
};
