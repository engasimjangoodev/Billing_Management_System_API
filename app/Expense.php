<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
protected $fillable =['expense_category_id','description','amount','date_time','add_by','is_recurring'];
    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class , 'expense_category_id' , 'id' );
    }

}
