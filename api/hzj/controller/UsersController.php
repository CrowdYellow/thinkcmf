<?php

namespace api\hzj\controller;

use api\hzj\validate\UserValidate;
use app\api\model\User;
use cmf\controller\RestBaseController;

class UsersController extends RestBaseController
{
    public function save()
    {
        $validate = new UserValidate();
        if (!$validate->check(input())) {
            $this->error($validate->getError());
        }
        $user               = new User();
        $user->name         = input('name');
        $user->phone        = input('phone');
        $user->user_ident   = input('user_ident');
        $user->organization = input('organization');
        $user->password     = md5(input('password'));
        $user->save();
        $this->success('请求成功!', $user);
    }
}