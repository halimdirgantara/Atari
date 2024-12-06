<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrganizationIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom organization_id yang terhubung ke id pada tabel organizations
            $table->unsignedBigInteger('organization_id')->nullable()->after('nik');

            // Membuat foreign key untuk menghubungkan dengan tabel organizations
            $table->foreign('organization_id')
                  ->references('id')->on('organizations')
                  ->onDelete('set null');  // Ketika organisasi dihapus, set kolom organization_id menjadi null
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus foreign key dan kolom organization_id jika migrasi dibatalkan
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');
        });
    }
}
