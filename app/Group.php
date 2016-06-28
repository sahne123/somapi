<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function characters()
    {
      return $this->belongsToMany('App\Character');
    }
}
