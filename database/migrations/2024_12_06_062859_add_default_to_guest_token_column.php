<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultToGuestTokenColumn extends Migration
{
    public function up()
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->string('guest_token')->default(Str::random(8))->change();
        });
    }

    public function down()
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->string('guest_token')->nullable(false)->change();
        });
    }
}
