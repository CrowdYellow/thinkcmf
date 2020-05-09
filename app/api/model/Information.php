<?php

namespace app\api\model;

use think\Model;

class Information extends Model
{
    protected $name = 'information';

    public $autoWriteTimestamp = true;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
