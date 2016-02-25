<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    /**
     * Owned by which user
     * @return User
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
