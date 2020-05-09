<?php

namespace app\api\model;

use think\Model;

class Category extends Model
{
    protected $name = 'categories';

    public function information()
    {
        return $this->hasMany(Information::class);
    }
}
