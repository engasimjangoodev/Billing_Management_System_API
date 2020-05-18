<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Expense;
use Faker\Generator as Faker;

$factory->define(Expense::class, function (Faker $faker) {
    return [
        'description'=>$faker->name,
        'amount'=>$faker->numberBetween(100,2000),
        'date_time'=>$faker->dateTime,
        'add_by'=>'admin',
        'expense_category_id' =>$faker->numberBetween(1,20),
        // $table->unsignedBigInteger('expense_category_id');
        //            $table->string('description')->nullable();
        //            $table->decimal('amount',8,2);
        //            $table->dateTime('date_time', 0)->nullable();
        //            $table->string('add_by')->nullable();
        //            $table->string('is_recurring')->nullable();
    ];
});
