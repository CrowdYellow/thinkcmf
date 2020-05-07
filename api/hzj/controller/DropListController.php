<?php


namespace api\hzj\controller;


use app\api\model\User;
use cmf\controller\RestBaseController;

class DropListController extends RestBaseController
{
    public function index($value)
    {
        if (method_exists($this, $value)) {
            return $this->success('请求成功！', ['dropList' => $this->$value()]);
        }
        return $this->success('请求成功！', []);
    }

    public function users()
    {
        $data                 = [];
        $data['organization'] = User::$organization;
        return $data;
    }
}