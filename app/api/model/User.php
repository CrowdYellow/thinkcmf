<?php

namespace app\api\model;

use think\Model;

class User extends Model
{
    protected $hidden=['password'];

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
}
