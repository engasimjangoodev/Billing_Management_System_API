<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bills;
use Faker\Generator as Faker;

$factory->define(Bills::class, function (Faker $faker) {
    return [

        'description'=>$faker->paragraph,
        'ref_number'=>$faker->numberBetween(1,50),
        'amount' =>$faker->numberBetween(1,4000),
        'balance'=>0,
        'month'=>$faker->dateTimeThisMonth(),
        'status'=>$faker->numberBetween(1,3),
        'received_by'=>'admin',
        'user_id'=>$faker->numberBetween(1,20),

        //  $table->id();
        //            $table->unsignedBigInteger('user_id');
        //            $table->string('description')->nullable();
        //            $table->string('number')->nullable();
        //            $table->decimal('amount',8,2);
        //            $table->decimal('balance',9,2)->nullable();
        //            $table->date('month')->nullable();
        //            $table->string('bill_type')->nullable();
        //            $table->string('received_by')->nullable();
        //            $table->foreign('user_id')->references('id')->on('users');
        //            $table->timestamps();
    ];
});
