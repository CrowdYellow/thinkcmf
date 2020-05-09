<?php

namespace app\api\model;

use think\Model;

class UserIntegral extends Model
{
    protected $name = 'user_integral';

    public $autoWriteTimestamp = true;

    # Integral
    const INTEGRAL_INFORMATION = 1;  # 浏览一篇新闻+1
    const INTEGRAL_LESSON      = 5;  # 上微党课+5
    const INTEGRAL_RELEASE     = 2;  # 成功发布一个合理心愿+2
    const INTEGRAL_REALIZE     = 10; # 成功兑现一个心愿+10

    # Types
    const TYPE_INFORMATION = 1;

    public static $types = [
        self::TYPE_INFORMATION => 'information',
    ];

    # 模型关联 start
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function information()
    {
        return $this->belongsTo(Information::class, 'id', 'model_id');
    }
    # 模型关联 end
}
