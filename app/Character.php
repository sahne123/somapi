<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;
    
    public function groups()
    {
      return $this->belongsToMany('App\Group');
    }
}
