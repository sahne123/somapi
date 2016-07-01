<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function groups()
    {
      return $this->belongsToMany('App\Group');
    }

    public function delete()
    {
      $this->groups()->detach($this->groups->pluck('id'));
      parent::delete();
    }
}
