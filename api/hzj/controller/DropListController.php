<?php


namespace api\hzj\controller;


use app\api\model\User;
use cmf\controller\RestBaseController;

class DropListController extends RestBaseController
{
    /**
     * @OA\Post(
     *     tags={"前台"},
     *     path="/api/hzj/dropList/{value}",
     *     summary="下拉菜单",
     *     description="下拉菜单",
     *     @OA\Parameter(name="value", in="path", description="下拉", @OA\Schema(type="string")),
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
        $data['organization'] = User::$organization;
        return $data;
    }
}