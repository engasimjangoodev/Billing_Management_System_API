<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = ['description', 'title'];

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
}
