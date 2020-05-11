<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [

        'title'=>$faker->title,
        'description' =>$faker->company,
        'amount' =>$faker->numberBetween(0,5000),
        'user_id'=>$faker->numberBetween(1,10),
        'due_date' =>$faker->dateTime,
    ];
});
