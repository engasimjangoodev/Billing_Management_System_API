<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $fillable = [
        'user_id','photo','username','phone','address','cnic','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id' );
    }


}
