<?php


namespace api\hzj\controller;


use app\api\model\User;
use cmf\controller\RestBaseController;

class DropListController extends RestBaseController
{
    public function index($value)
    {
        # 根据参数获取对应的下拉菜单，没有匹配的返回空
        if (method_exists($this, $value)) {
            $this->success('请求成功！', ['dropList' => $this->$value()]);
        }
        $this->error('暂无数据！');
    }

    public function users()
    {
        $data                 = [];
        $data['organization'] = User::$organization;
        return $data;
    }
}