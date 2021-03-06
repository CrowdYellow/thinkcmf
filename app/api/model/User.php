<?php

namespace app\api\model;

use think\Model;

class User extends Model
{
    public $jwtSub = 'phone';

    protected $autoWriteTimestamp = true;

    protected $hidden = ['password'];

    protected $name = 'users';
    const ORGANIZATION_1 = 1;
    const ORGANIZATION_2 = 2;
    const ORGANIZATION_3 = 3;

    # Organization
    public static $organization = [
        self::ORGANIZATION_1 => '组织一',
        self::ORGANIZATION_2 => '组织二',
        self::ORGANIZATION_3 => '组织三',
    ];

    # 模型关联 start
    # 资源 心愿 需求
    public function resources()
    {
        return $this->hasMany(Resource::class, 'user_id');
    }

    # 认领心愿
    public function myClaimWishes()
    {
        return $this->hasMany(Resource::class, 'claim_user_id');
    }
    # 模型关联 end

    public function addIntegral($value)
    {
        $this->integral += $value;
        $this->save();
    }
}
