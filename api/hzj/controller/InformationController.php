<?php


namespace api\hzj\controller;


use app\api\model\Information;
use cmf\controller\RestBaseController;

class InformationController extends RestBaseController
{
    public function index()
    {
        $information = Information::where('type', input('type'))->paginate(input('page'));

        $this->success('请求成功！', $information);
    }
}