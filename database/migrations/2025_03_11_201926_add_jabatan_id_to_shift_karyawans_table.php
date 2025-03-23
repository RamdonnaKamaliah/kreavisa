<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('shift_karyawans', function (Blueprint $table) {
            if (!Schema::hasColumn('shift_karyawans', 'jabatan_id')) {
                $table->unsignedBigInteger('jabatan_id')->nullable()->after('user_id');
                $table->foreign('jabatan_id')->references('id')->on('jabatan_karyawans')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('shift_karyawans', function (Blueprint $table) {
            if (Schema::hasColumn('shift_karyawans', 'jabatan_id')) {
                $table->dropForeign(['jabatan_id']);
                $table->dropColumn('jabatan_id');
            }
        });
    }
};
