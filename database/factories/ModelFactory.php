<?php

use LaraCourse\Models\Album;
use LaraCourse\Models\Photo;
use LaraCourse\User;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$cats=
    ['abstract',
        'animals',
        'business',
        'cats',
        'city',
        'food',
        'nightlife',
        'fashion',
        'people',
        'nature',
        'sports',
        'technics',
        'transport'
    ];
$factory->define(LaraCourse\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(LaraCourse\Models\Album::class, function (Faker\Generator $faker)use($cats) {

    return [
        'album_name' => $faker->name,
        'description' => $faker->text(128),
        'user_id' => User::inRandomOrder()->first()->id,
        'album_thumb' => $faker->imageUrl($width=640,$height=480, $faker->randomElement($cats))
    ];
});

$factory->define(LaraCourse\Models\Photo::class, function (Faker\Generator $faker)use($cats){
    $width=640;
    $height=480;


    return [
        'album_id' =>Album::inRandomOrder()->first()->id,
        'name' => $faker->text(64),
        'description' => $faker->text(128),
        'img_path'=>$faker->imageUrl($width, $height, $faker->
        randomElement($cats))
    ];
});

