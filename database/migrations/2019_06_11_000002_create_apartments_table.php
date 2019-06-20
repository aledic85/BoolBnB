<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('title');
            $table->string('description');
            $table->smallInteger('rooms')->unsigned();
            $table->smallInteger('beds')->unsigned();
            $table->smallInteger('bathrooms')->unsigned();
            $table->integer('mq')->unsigned();
            $table->string('address');
            $table->float('latitude', 9, 6);
            $table->float('longitude', 9, 6);
            $table->string('img_path');
            $table->boolean('wi_fi')->nullable();
            $table->boolean('parking_space')->nullable();
            $table->boolean('pool')->nullable();
            $table->boolean('sauna')->nullable();
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
