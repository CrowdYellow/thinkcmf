<?php

namespace app\api\model;

use think\Model;

class Information extends Model
{
    protected $name = 'information';

    public $autoWriteTimestamp = true;

    const TYPE_TREND     = 1;
    const TYPE_MARKETING = 2;
    const TYPE_EVENT     = 3;

    public static $types = [
        self::TYPE_TREND     => '党建动态',
        self::TYPE_MARKETING => '市场信息',
        self::TYPE_EVENT     => '活动预告',
    ];
}
