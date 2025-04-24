<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kinerja_karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('jabatan_id')->constrained('jabatan_karyawans')->onDelete('cascade');
            $table->date('tanggal_penilaian');
            $table->string('periode'); // Contoh: "February-April"

            // Aspek penilaian, skala 0-5
            $table->integer('tanggung_jawab')->default(0)->comment('Skala 0-5');
            $table->integer('kehadiran_ketepatan_waktu')->default(0)->comment('Skala 0-5');
            $table->integer('produktivitas')->default(0)->comment('Skala 0-5');
            $table->integer('kerja_sama_tim')->default(0)->comment('Skala 0-5');
            $table->integer('kemampuan_komunikasi')->default(0)->comment('Skala 0-5');

            // Total skor = jumlah semua aspek x 4
            $table->integer('total_skor')->default(0)->comment('Total skor (jumlah aspek x 4), max 100');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kinerja_karyawans');
    }
};
