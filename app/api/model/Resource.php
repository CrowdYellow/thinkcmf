<?php

namespace app\api\model;

use think\Model;

class Resource extends Model
{
    protected $name = 'resources';

    public $autoWriteTimestamp = true;

    const TYPE_WISH     = 1;
    const TYPE_RESOURCE = 2;
    const TYPE_DEMAND   = 3;

    public static $types = [
        self::TYPE_WISH     => '心愿',
        self::TYPE_RESOURCE => '资源',
        self::TYPE_DEMAND   => '需求',
    ];

    # 模型关联 start
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    # 模型关联 end
}
