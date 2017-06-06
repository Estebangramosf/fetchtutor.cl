<?php

//Aca definimos como crearemos los datos, aca se define la forma como se crean
/*
//Se comenta este que viene por defecto
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

//Se definen los 4 métodos para crear el factory de información fake:falsa que permita visualizar algo mas real el sitio

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
      'name' => $faker->name,
      'email' => $faker->email,
      'password' => bcrypt('secret'),
      'remember_token' => str_random(10),
      'role' => $faker->randomElement(['user', 'editor']),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
      'title' => $faker->sentence(),
      'body' => $faker->paragraph(),
    ];
});

$factory->define(App\Multimedia::class, function (Faker\Generator $faker) {
    return [
      'title' => $faker->sentence(),
      'body' => $faker->paragraph(),
      'user_id' => rand(1,49),
      'youtube_link' => $faker->url(),
    ];
});

$factory->define(App\PostComment::class, function (Faker\Generator $faker) {
    return [
      'title' => $faker->sentence(),
      'body' => $faker->paragraph(),
      'user_id' => rand(1,49),
    ];
});
$factory->define(App\MultimediaComment::class, function (Faker\Generator $faker) {
    return [
      'title' => $faker->sentence(),
      'body' => $faker->paragraph(),
      'user_id' => rand(1,49),
    ];
});