<?php


namespace api\hzj\controller;


use api\hzj\validate\ResourceValidate;
use app\api\model\Resource;

class ResourcesController extends ApiController
{
    public function index()
    {
        $resources = Resource::all();

        $this->success('发布成功！', ['resources' => $resources]);
    }

    public function store()
    {
        $validate = new ResourceValidate();

        if (!$validate->check(input())) {
            $this->error($validate->getError());
        }

        $user = $this->user();

        $resource          = new Resource();
        $resource->title   = input('title');
        $resource->content = input('content');
        $resource->name    = input('name');
        $resource->contact = input('contact');
        $resource->type    = input('type');
        $resource->user_id = $user->id;
        $resource->save();
        $this->success('发布成功！', $resource);
    }
}