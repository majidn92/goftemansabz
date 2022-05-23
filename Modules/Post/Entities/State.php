<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [];

    public function posts()
    {
        return $this->hasMany('Modules\Post\Entities\Post');
    }
}