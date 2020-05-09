<?php

namespace api\hzj\controller;

use app\api\model\Information;
use cmf\controller\RestBaseController;

class InformationController extends RestBaseController
{
    /**
     * @OA\Get(
     *     tags={"新闻"},
     *     path="/api/hzj/information",
     *     operationId="api.information",
     *     summary="新闻",
     *     description="新闻",
     *     @OA\Parameter(name="type", required=true, in="query", description="类型", @OA\Schema(type="string")),
     *     @OA\Response(
     *          response="200",
     *          description="请求失败",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="code", type="integer", description="响应code"),
     *                  @OA\Property(property="msg", type="string", description="响应消息"),
     *                  @OA\Property(property="data", type="array", description="响应参数", @OA\Items(
     *                          @OA\Property(property="id", type="integer", description="ID"),
     *                          @OA\Property(property="title", type="string", description="标题"),
     *                          @OA\Property(property="body", type="string", description="内容"),
     *                          @OA\Property(property="type", type="integer", description="类型:1->党建动态, 2->市场信息， 3->活动预告"),
     *                          @OA\Property(property="cover_pic", type="string", description="封面图"),
     *                          @OA\Property(property="create_time", type="string", description="创建时间"),
     *                          @OA\Property(property="update_time", type="string", description="修改时间"),
     *
     *                      )
     *                  ),
     *              ),
     *          ),
     *       )
     * )
     */
    public function index()
    {
        $information = Information::where('type', input('type'))->paginate(input('page'));

        $this->success('请求成功！', $information);
    }
}