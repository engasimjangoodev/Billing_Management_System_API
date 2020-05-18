<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    protected $fillable = ['description','user_id','number','amount','due_date','balance','month','bill_type','received_by'];
    protected $hidden =['user_id'];
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id' );
    }
}
