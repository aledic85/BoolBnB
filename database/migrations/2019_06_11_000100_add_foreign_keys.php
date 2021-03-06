<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('apartments', function(Blueprint $table) {
        $table->foreign('user_id', 'user')->references('id')->on('users')->onDelete('cascade');
      });

      Schema::table('messages', function(Blueprint $table) {
        $table->foreign('user_id', 'owner')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('apartment_id', 'apt_id')->references('id')->on('apartments')->onDelete('cascade');
      });

      Schema::table('views', function(Blueprint $table) {
        $table->foreign('apartment_id', 'aptView')->references('id')->on('apartments')->onDelete('cascade');
      });

      Schema::table('apartment_sponsored', function(Blueprint $table) {
          $table->foreign('apartment_id', 'apartment')->references('id')->on('apartments')->onDelete('cascade');
          $table->foreign('sponsored_id', 'sponsored')->references('id')->on('sponsoreds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('apartments', function(Blueprint $table) {
      $table->dropForeign('user');
      });

      Schema::table('messages', function(Blueprint $table) {
      $table->dropForeign('owner');
      $table->dropForeign('apt_id');
      });

      Schema::table('views', function(Blueprint $table) {
      $table->dropForeign('aptView');
      });

      Schema::table('apartment_sponsored', function(Blueprint $table) {
        $table->dropForeign('apartment');
        $table->dropForeign('sponsored');
      });

    }
}
