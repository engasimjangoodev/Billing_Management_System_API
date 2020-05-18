<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserDetails;
use Faker\Generator as Faker;

$factory->define(UserDetails::class, function (Faker $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'user_id'=>$faker->numberBetween(1,20),
        'username'=> $faker->userName,
        'address'=> $faker->address,
        'cnic'=> $faker->creditCardNumber,
        'status'=> $faker->numberBetween(1,3),

    ];
});
