<?php


namespace api\hzj\validate;

use app\api\model\User;
use think\Validate;

class UserValidate extends Validate
{
    protected $rule = [
        'name|用户名'         => [
            'require', 'regex:/^[a-zA-Z0-9]+$/', 'unique:users', 'min:4', 'max:16'
        ],
        'phone|手机号'        => [
            'require',
            'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
            'unique:users'
        ],
        'user_ident|身份证'   => 'require|min:18|unique:users',
        'organization|党组织' => 'require|checkOrganization',
        'password|密码'       => 'require|min:6|max:18|confirm',
    ];

    protected function checkOrganization($value, $rules, $data, $title = '', $msg = [])
    {
        if (in_array($value, transfer_array(User::$organization))) {
            return true;
        }
        return false;
    }
}