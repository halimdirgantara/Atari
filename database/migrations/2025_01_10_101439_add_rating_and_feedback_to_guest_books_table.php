<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatingAndFeedbackToGuestBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_books', function (Blueprint $table) {
            $table->integer('rating')->nullable(); // Kolom rating (1-5)
            $table->text('feedback')->nullable(); // Kolom feedback
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_books', function (Blueprint $table) {
            $table->dropColumn(['rating', 'feedback']); // Hapus kolom jika rollback
        });
    }
}
