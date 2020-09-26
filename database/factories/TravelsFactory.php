<?php

/*
|--------------------------------------------------------------------------
| Apart Factory
|--------------------------------------------------------------------------
*/

$factory->define(
    \Locaravel\Models\Travels\Hotel::class, function (Faker\Generator $faker) {
        return [
        'code' => $faker->slug,
        ];
    }
);

$factory->define(
    \Locaravel\Models\Travels\Apart::class, function (Faker\Generator $faker) {
        return [
        'hotel_id' => function () {
            if ($return = \Locaravel\Models\Travels\Hotel::inRandomOrder()->first()) {
                return $return->id;
            }
            return factory(\Locaravel\Models\Travels\Hotel::class)->create()->id;
        },
        'code' => $faker->slug,
        ];
    }
);

$factory->define(
    \Locaravel\Models\Travels\Travel::class, function (Faker\Generator $faker) {
        return [
        'apart_id' => function () {
            if ($return = \Locaravel\Models\Travels\Apart::inRandomOrder()->first()) {
                return $return->id;
            }
            return factory(\Locaravel\Models\Travels\Apart::class)->create()->id;
        },
        'code' => $faker->slug,
        ];
    }
);