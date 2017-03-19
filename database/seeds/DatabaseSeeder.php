<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class, 10)->create();
        //factory(App\Studio::class, 10)->create();
        factory(App\Reservation::class, 10)->create();

        $studios = \App\Studio::get();

        foreach ($studios as $studio) {
            factory(App\StudioSetting::class)->create([
                'studio_id' => $studio->id
            ]);
        }
    }
}
