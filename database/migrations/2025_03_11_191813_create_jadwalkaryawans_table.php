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
        Schema::create('jadwal_karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('jabatan_id')->constrained('jabatan_karyawans')->onDelete('cascade');
            $table->foreignId('shift_id')->constrained('shift_karyawans')->onDelete('cascade');

            // Menambahkan kolom untuk setiap hari dalam sebulan
            for ($i = 1; $i <= 31; $i++) {
                $table->integer("day_$i")->nullable();
            }

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_karyawans');
    }
};
