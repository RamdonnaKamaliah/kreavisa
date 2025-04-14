<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::table('users')
            ->where('usertype', 'gudang')
            ->update(['usertype' => 'karyawan']);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Jika perlu rollback
        DB::table('users')
            ->whereIn('jabatan_id', function($query) {
                $query->select('id')
                      ->from('jabatan_karyawans')
                      ->where('nama_jabatan', 'like', '%gudang%');
            })
            ->update(['usertype' => 'gudang']);
    }
};