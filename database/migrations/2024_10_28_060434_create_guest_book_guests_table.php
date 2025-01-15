<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() : void
    {
        Schema::create('guest_book_guest', function (Blueprint $table) {
            $table->foreignId('guest_id');
            $table->foreignId('guest_book_id');

        });
    }

    public function down() : void
    {
        Schema::dropIfExists('guest_book_guest');
    }
};
