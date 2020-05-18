<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_category_id');
            $table->string('description')->nullable();
            $table->decimal('amount',8,2);
            $table->dateTime('date_time', 0)->nullable();
            $table->string('add_by')->nullable();
            $table->string('is_recurring')->nullable();

            $table->foreign('expense_category_id')->references('id')->on('expense_categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
