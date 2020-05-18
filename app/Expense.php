<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class , 'expense_category_id' , 'id' );
    }

}
