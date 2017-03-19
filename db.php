<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('logo')->nullable();
            $table->string('cover')->nullable();
            $table->integer('type')->nullable();
            $table->string('timings');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('studio_pricings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studio_id');
            $table->float('price');
            $table->string('day')->nullable();			// if monday then 400, if saturday then 600
            $table->date('date')->nullable();			// on a specific date, it will 1000
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('studio_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studio_id');
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('studio_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studio_id');
            $table->text('review');
            $table->float('rating');
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('studio_owners', function (Blueprint $table) {            
            $table->integer('studio_id');
            $table->integer('owner_id');
        });

        Schema::create('owners', function (Blueprint $table) {            
            $table->increments('id');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studio_id');
            $table->timestamp('from');
            $table->timestamp('to');
            $table->integer('customer_id');
            $table->boolean('confirmed');
            $table->float('price');            
            $table->softDeletes();
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
        Schema::drop('studios');
    }
}