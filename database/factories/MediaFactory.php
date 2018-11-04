<?php

use Faker\Generator as Faker;

$factory->define(App\NetflixFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\NetflixSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});


$factory->define(App\AmazonFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\AmazonSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\BbcFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\BbcSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\CFourFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\CFourSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\GoogleFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\GoogleSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\iTunesFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\iTunesSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\RakutenFilm::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});

$factory->define(App\RakutenSeries::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'year' => $faker->year($max = 'now'),
        'synopsis' => $faker->realText($maxNbChars = 250, $indexSize = 2),
    ];
});
