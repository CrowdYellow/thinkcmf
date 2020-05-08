<?php


namespace api\hzj\validate;


use app\api\model\Resource;
use think\Validate;

class ResourceValidate extends Validate
{
    protected $rule = [
        'title|标题'      => [
            'require', 'min:6', 'max:255'
        ],
        'content|内容'    => [
            'require', 'min:6'
        ],
        'name|姓名'       => [
            'require'
        ],
        'contact|联系方式' => [
            'require'
        ],
        'type|类型'       => [
            'require', 'checkType'
        ],
    ];

    protected function checkType($value, $rules, $data, $title = '', $msg = [])
    {
        if (in_array($value, transfer_array(Resource::$types))) {
            return true;
        }
        return false;
    }
}