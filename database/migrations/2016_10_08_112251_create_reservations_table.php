<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studio_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studio_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('from');
            $table->timestamp('to');
            $table->boolean('confirmed')->default(0);
            $table->integer('confirmed_by')->unsigned()->nullable();
            $table->timestamp('confirmed_at')->nullable();

            $table->timestamps();

            $table->foreign('studio_id')->references('id')->on('studios');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('confirmed_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('studio_reservations');
    }
}
