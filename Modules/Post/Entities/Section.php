<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [];
    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany('Modules\Post\Entities\Post');
    }

    public function side_ads()
    {
        return $this->hasMany('Modules\Ads\Entities\SideAd');
    }

    public function center_ads()
    {
        return $this->hasMany('Modules\Ads\Entities\CenterAd');
    }
}
