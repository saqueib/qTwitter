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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->word . rand(1,73),
        'password' => $password ?: $password = bcrypt('secret'),
        'avatar' => 'https://randomuser.me/api/portraits/' . $faker->randomElement(['men', 'women']) . '/' . rand(1,99) . '.jpg',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tweet::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->realText(rand(20, 200)),
        'user_id' => function() {
            return App\User::inRandomOrder()->first()->id;
        },
        'created_at' => $date = $faker->dateTimeThisMonth,
        'updated_at' => $date,
    ];
});

$factory->define(App\Profile::class, function (Faker\Generator $faker) {
    return [
        'bio' => $faker->realText(rand(100, 200)),
        'designation' => $faker->jobTitle,
        'company' => $faker->company,
        'city' => $faker->city,
        'country' => $faker->country,
        'dob' => $faker->date(),
        'user_id' => function() {
            return App\User::inRandomOrder()->first()->id;
        }
    ];
});

$factory->define(App\Reply::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->sentence,
        'user_id' => function() {
            return App\User::inRandomOrder()->first()->id;
        },
        'tweet_id' => function() {
            return App\Tweet::inRandomOrder()->first()->id;
        },
        'created_at' => $date = $faker->dateTimeThisMonth,
        'updated_at' => $date,
    ];
});

$factory->define(App\Like::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function() {
            return App\User::inRandomOrder()->first()->id;
        },
        'tweet_id' => function() {
            return App\Tweet::inRandomOrder()->first()->id;
        },
    ];
});

//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    return [
//
//    ];
//});
