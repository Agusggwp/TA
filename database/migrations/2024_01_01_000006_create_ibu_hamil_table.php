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
        Schema::create('ibu_hamil', function (Blueprint $table) {
            $table->id();

            // Foreign Key ke Kepala Keluarga
            $table->foreignId('kepala_keluarga_id')->constrained('kepala_keluarga')->onDelete('cascade');

            // Data Identitas
            $table->string('nik', 50)->nullable();
            $table->string('nama_ibu', 100);
            $table->date('tanggal_lahir');
            $table->string('umur', 50)->nullable();
            $table->string('nama_suami', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();

            // Data Kehamilan
            $table->string('l_ibu_hamil', 50)->nullable();
            $table->integer('kehamilan_ke')->nullable();
            $table->string('jarak_anak_sebelumnya', 50)->nullable();

            // Data Fisik
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('lingkar_lengan', 5, 2)->nullable();

            // Data Pemeriksaan
            $table->string('tekanan_darah', 20)->nullable();
            $table->string('denyut_jantung', 20)->nullable();
            $table->text('kondisi_ibu')->nullable();
            $table->text('keluhan')->nullable();

            // Data Posyandu
            $table->date('tanggal_kunjungan')->nullable();
            $table->string('waktu_ke_posyandu', 100)->nullable();
            $table->string('petugas', 100)->nullable();

            // Catatan
            $table->text('catatan')->nullable();

            $table->timestamps();

            // Index
            $table->index('kepala_keluarga_id');
            $table->index('tanggal_kunjungan');
            $table->index('nama_ibu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibu_hamil');
    }
};
