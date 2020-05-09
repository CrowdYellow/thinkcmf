<?php


namespace api\hzj\controller;


use app\api\model\Category;
use cmf\controller\RestBaseController;

class CategoriesController extends RestBaseController
{
    public function index()
    {
        $categories = Category::all();

        $this->success('请求成功！', $categories);
    }
}