<?php


namespace api\hzj\controller;

use api\hzj\validate\AuthorizationValidate;
use app\api\model\User;
use cmf\controller\RestBaseController;

class AuthorizationsController extends RestBaseController
{
    public function save()
    {
        $validate = new AuthorizationValidate();
        if (!$validate->check(input())) {
            $this->error($validate->getError());
        }
        $user = User::where('name', input('name'))->find();
        # 判断是否存在该用户
        if (!$user) {
            $this->error('用户名或密码错误');
        }
        # 校对密码
        if (!cmf_compare_password(input('password'), $user->password)) {
            $this->error('用户名或密码错误');
        }
        # 判断手机号
        if ($user->phone != input('phone')) {
            $this->error('手机号错误');
        }
        # 判断党组织
        if ($user->organization != input('organization')) {
            $this->error('党组织错误');
        }
        $this->success('请求成功', $user);
    }
}