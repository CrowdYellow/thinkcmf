<?php

namespace app\api\model;

use think\Model;

class Resource extends Model
{
    protected $name = 'resources';

    const TYPE_WISH     = 1;
    const TYPE_RESOURCE = 2;
    const TYPE_DEMAND   = 3;

    public static $types = [
        self::TYPE_WISH     => '心愿',
        self::TYPE_RESOURCE => '资源',
        self::TYPE_DEMAND   => '需求',
    ];
}
