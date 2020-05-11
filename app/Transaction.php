<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
protected $fillable = ['title' , 'description' ,'amount','due_date','payed_at'];
    public function creator()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id' );
    }
}
