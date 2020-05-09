<?php


namespace api\hzj\controller;


use app\api\model\Category;
use cmf\controller\RestBaseController;

class CategoriesController extends RestBaseController
{
    /**
     * @OA\Get(
     *     tags={"新闻"},
     *     path="/api/hzj/categories",
     *     operationId="api.categories",
     *     summary="分类列表",
     *     description="分类列表",
     *     @OA\Response(
     *          response="200",
     *          description="请求失败",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="code", type="integer", description="响应code"),
     *                  @OA\Property(property="msg", type="string", description="响应消息"),
     *                  @OA\Property(property="data", type="array", description="响应参数", @OA\Items()
     *                  ),
     *              ),
     *          ),
     *       )
     * )
     */
    public function index()
    {
        $categories = Category::all();

        $this->success('请求成功！', $categories);
    }
}