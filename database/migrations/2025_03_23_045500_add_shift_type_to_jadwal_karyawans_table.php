<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('jadwal_karyawans', function (Blueprint $table) {
        $table->tinyInteger('shift_type')->after('shift_id'); // Tambahkan kolom shift_type
    });
}

public function down()
{
    Schema::table('jadwal_karyawans', function (Blueprint $table) {
        $table->dropColumn('shift_type'); // Hapus kolom shift_type jika rollback
    });
}
};
