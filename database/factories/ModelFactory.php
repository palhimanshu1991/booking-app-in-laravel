<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Studio::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->sentence,
        'logo'        => $faker->imageUrl(),
        'cover'       => $faker->imageUrl(),
    ];
});

$factory->define(App\StudioSetting::class, function (Faker\Generator $faker) {
    return [
        'closing_day' => $faker->randomElement(['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday']),
    ];
});

$factory->define(App\Reservation::class, function (Faker\Generator $faker) {
    return [
        'studio_id' => function () {
            return factory(App\Studio::class)->create()->id;
        },
        'user_id'   => function () {
            return factory(App\User::class)->create()->id;
        },
        'from'      => \Carbon\Carbon::now(),
        'to'        => \Carbon\Carbon::now()->addMinutes(60)
    ];
});
