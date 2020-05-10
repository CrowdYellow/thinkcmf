<?php


namespace api\hzj\controller;


use app\api\model\Lessons;
use app\api\model\UserIntegral;

class LessonsController extends ApiController
{
    /**
     * @OA\Get(
     *     tags={"党员管理"},
     *     path="/api/hzj/lessons",
     *     operationId="api.lessons",
     *     summary="党员微课",
     *     description="党员微课",
     *     @OA\Response(
     *          response="200",
     *          description="请求成功",
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
        $lessons = Lessons::paginate(input('page'));

        $this->success('请求成功！', $lessons);
    }

    /**
     * @OA\Get(
     *     tags={"党员管理"},
     *     path="/api/hzj/read/{id}/lesson",
     *     operationId="api.read.lesson",
     *     summary="上微党课加积分",
     *     @OA\Parameter(name="Authorization", required=true, in="header", description="token, ex.:Bear+' '+token", @OA\Schema(type="string")),
     *     @OA\Parameter(name="id", required=true, in="path", description="党课ID", @OA\Schema(type="int")),
     *      @OA\Response(
     *          response="200",
     *          description="请求成功",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="code", type="integer", description="响应code"),
     *                  @OA\Property(property="msg", type="string", description="响应消息"),
     *                  @OA\Property(property="data", type="array", description="响应参数", @OA\Items()),
     *              ),
     *          ),
     *       ),
     *      @OA\Response(
     *          response="403",
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
    public function read($id)
    {
        $user = $this->user();

        $record = UserIntegral::where('type', UserIntegral::TYPE_LESSON)
                              ->where('user_id', $user->id)
                              ->where('model_id', $id)
                              ->find();

        if ($record) {
            $this->error('您已经浏览过！');
        }

        $log           = new UserIntegral();
        $log->user_id  = $user->id;
        $log->type     = UserIntegral::TYPE_LESSON;
        $log->model_id = $id;
        $log->integral = UserIntegral::INTEGRAL_LESSON;
        $log->save();

        $user->addIntegral(UserIntegral::INTEGRAL_LESSON);

        $this->success('积分+5！');
    }
}