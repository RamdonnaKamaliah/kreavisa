<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absen_karyawan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->dateTime('tanggal_absensi');
            $table->time('jam_absensi')->nullable(); // Allow NULL values
            $table->string('foto');
            $table->string('lokasi');
            $table->string('status');
            $table->string('file_surat')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatan_karyawans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen_karyawan');
    }
};
