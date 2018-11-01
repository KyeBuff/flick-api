<?php

use Faker\Generator as Faker;

$factory->define(App\NetflixFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\NetflixSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});


$factory->define(App\AmazonFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\AmazonSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\BbcFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\BbcSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\CFourFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\CFourSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\GoogleFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\GoogleSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\iTunesFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\iTunesSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\RakutenFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});

$factory->define(App\RakutenSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
        'img_url' => $faker->imageUrl(200, 200, 'cats', true, 'Faker'),
    ];
});
