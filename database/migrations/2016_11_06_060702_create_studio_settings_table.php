<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudioSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studio_settings', function (Blueprint $table) {
            $table->integer('studio_id')->unsigned()->unique();
            $table->time('on_weekdays_opens_at')->nullable();
            $table->time('on_weekdays_closes_at')->nullable();
            $table->time('on_weekend_opens_at')->nullable();
            $table->time('on_weekend_closes_at')->nullable();
            $table->enum('closing_day', [
                'sunday',
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday'
            ])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('studio_settings');
    }
}
