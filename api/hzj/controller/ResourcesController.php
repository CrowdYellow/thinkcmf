<?php


namespace api\hzj\controller;


use api\hzj\validate\ResourceValidate;
use app\api\model\Resource;

class ResourcesController extends ApiController
{
    /**
     * @OA\Get(
     *     tags={"资源-心愿-需求"},
     *     path="/api/hzj/resources",
     *     operationId="api.user.resources",
     *     summary="获取资源，需求，心愿列表",
     *     @OA\Parameter(name="type", required=true, in="query", description="类型:1->心愿, 2->资源， 3->需求", @OA\Schema(type="string")),
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
     *                          @OA\Property(property="content", type="string", description="内容"),
     *                          @OA\Property(property="name", type="string", description="姓名"),
     *                          @OA\Property(property="contact", type="string", description="联系方式"),
     *                          @OA\Property(property="type", type="integer", description="类型:1->心愿, 2->资源， 3->需求"),
     *                          @OA\Property(property="user_id", type="integer", description="发布者ID"),
     *                          @OA\Property(property="create_time", type="string", description="创建时间"),
     *                          @OA\Property(property="update_time", type="string", description="修改时间"),
     *                      )
     *                  ),
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
    public function index()
    {
        $resources = Resource::where('type', input('type'))->all();

        $this->success('发布成功！', ['resources' => $resources]);
    }

    /**
     * @OA\Post(
     *     tags={"资源-心愿-需求"},
     *     path="/api/hzj/resources",
     *     operationId="api.user.resources.store",
     *     summary="发布",
     *     @OA\Parameter(name="Authorization", required=true, in="header", description="token, ex.:Bear+' '+token", @OA\Schema(type="string")),
     *     @OA\RequestBody(
     *      @OA\MediaType(mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *              type="object",
     *              required={"title", "content", "type", "name", "contact"},
     *               @OA\Property(property="title", type="string", description="标题"),
     *               @OA\Property(property="content", type="string", description="内容"),
     *               @OA\Property(property="type", type="int", description="类型:1->心愿, 2->资源， 3->需求"),
     *               @OA\Property(property="name", type="int", description="姓名"),
     *               @OA\Property(property="contact", type="string", description="联系方式"),
     *          )
     *      )),
     *      @OA\Response(
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
     *                          @OA\Property(property="content", type="string", description="内容"),
     *                          @OA\Property(property="name", type="string", description="姓名"),
     *                          @OA\Property(property="contact", type="string", description="联系方式"),
     *                          @OA\Property(property="type", type="integer", description="类型:1->心愿, 2->资源， 3->需求"),
     *                          @OA\Property(property="user_id", type="integer", description="发布者ID"),
     *                          @OA\Property(property="create_time", type="string", description="创建时间"),
     *                          @OA\Property(property="update_time", type="string", description="修改时间"),
     *                      )
     *                  ),
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
    public function store()
    {
        $validate = new ResourceValidate();

        if (!$validate->check(input())) {
            $this->error($validate->getError());
        }

        $user = $this->user();

        $resource           = new Resource();
        $resource->title    = input('title');
        $resource->content  = input('content');
        $resource->name     = input('name');
        $resource->contact  = input('contact');
        $resource->type     = input('type');
        $resource->user_id  = $user->id;
        $resource->save();
        $this->success('发布成功！', $resource);
    }

    /**
     * @OA\Patch(
     *     tags={"资源-心愿-需求"},
     *     path="/api/hzj/resources",
     *     operationId="api.user.resources.claim",
     *     summary="认领心愿",
     *     @OA\Parameter(name="Authorization", required=true, in="header", description="token, ex.:Bear+' '+token", @OA\Schema(type="string")),
     *     @OA\RequestBody(
     *      @OA\MediaType(mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *              type="object",
     *              required={"resource_id"},
     *               @OA\Property(property="resource_id", type="int", description="心愿ID"),
     *          )
     *      )),
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
    public function claimWish()
    {
        $resource = Resource::where([
            ['is_claim', 0],
            ['type', Resource::TYPE_WISH],
        ])->find(input('resource_id'));

        if (!$resource) {
            $this->error('该心愿已被领取！');
        }

        $user = $this->user();

        if ($resource->user_id == $user->id) {
            $this->error('无法领取自己的心愿！');
        }

        $resource->claim_user_id = $user->id;
        $resource->is_claim = 1;
        $resource->save();
        $this->success('认领成功！');
    }
}