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
        Schema::table('tasks', function (Blueprint $table) {
            // Untuk Prioritas: Kolom 'priority' dengan nilai default 'Normal'
            // Akan ditambahkan setelah kolom 'name'
            $table->string('priority')->default('Normal')->after('name');

            // Untuk Kategori: Kolom 'category' yang boleh kosong (nullable)
            // Akan ditambahkan setelah kolom 'priority'
            $table->string('category')->nullable()->after('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Saat rollback, hapus kolom 'priority' dan 'category'
            $table->dropColumn('priority');
            $table->dropColumn('category');
        });
    }
};