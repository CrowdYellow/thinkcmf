<?php

namespace app\api\model;

use think\Model;

class Resource extends Model
{
    protected $name = 'resources';

    public $autoWriteTimestamp = true;

    # 资源，需求，心愿状态
    const STATUS_1 = 1;
    const STATUS_2 = 2;
    const STATUS_3 = 3;

    public static $status = [
        self::STATUS_1 => '待审核',
        self::STATUS_2 => '已通过',
        self::STATUS_3 => '未通过',
    ];

    # 类型
    const TYPE_WISH     = 1;
    const TYPE_RESOURCE = 2;
    const TYPE_DEMAND   = 3;

    public static $types = [
        self::TYPE_WISH     => '心愿',
        self::TYPE_RESOURCE => '资源',
        self::TYPE_DEMAND   => '需求',
    ];

    # 心愿认领状态
    const WISH_STATUS_0 = 0;
    const WISH_STATUS_1 = 1;
    const WISH_STATUS_2 = 2;
    const WISH_STATUS_3 = 3;

    public static $wishStatus = [
        self::WISH_STATUS_0 => '待领取',
        self::WISH_STATUS_1 => '待兑现',
        self::WISH_STATUS_2 => '待审核',
        self::WISH_STATUS_3 => '已兑现',
    ];

    # 模型关联 start
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    # 模型关联 end
}
