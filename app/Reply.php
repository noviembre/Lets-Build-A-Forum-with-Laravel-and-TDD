<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $guarded = [];


    # this function name is in stead of user
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
