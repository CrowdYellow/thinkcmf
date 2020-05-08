<?php


namespace api\hzj\controller;


use app\api\model\Resource;
use app\api\model\User;

class DropListController extends ApiController
{
    /**
     * @OA\Get(
     *     tags={"前台"},
     *     path="/api/hzj/dropList",
     *     operationId="api.dropList",
     *     summary="下拉菜单",
     *     description="下拉菜单",
     *     @OA\Parameter(name="value", required=true, in="query", description="方法", @OA\Schema(type="string")),
     *     @OA\Response(
     *          response="200",
     *          description="请求失败",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="code", type="integer", description="响应code"),
     *                  @OA\Property(property="msg", type="string", description="响应消息"),
     *                  @OA\Property(property="data", type="array", description="响应参数", @OA\Items()),
     *              ),
     *          ),
     *       )
     * )
     */
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
        $data['organizations'] = User::$organization;
        return $data;
    }

    public function resources()
    {
        $data = [];
        $data['resources'] = Resource::$types;
        return $data;
    }
}