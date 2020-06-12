<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Packages;
use Faker\Generator as Faker;

$factory->define(Packages::class, function (Faker $faker) {
     return [
        'name'=>$faker->name,
        'volume'=>'3MB',
        'amount'=>$faker->numberBetween(1000,3000),
        'description'=>$faker->paragraph,
        'package_id'=>$faker->numberBetween(1,5),
    ];
});
