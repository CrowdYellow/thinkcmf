<?php

namespace api\hzj\controller;

use app\api\model\User;
use api\hzj\validate\UserValidate;
use Zewail\Api\Facades\JWT;

class UsersController extends ApiController
{
    /**
     * @OA\Post(
     *     tags={"前台"},
     *     path="/api/hzj/users",
     *     operationId="api.user.register",
     *     summary="注册",
     *     description="注册接口",
     *     @OA\RequestBody(
     *      @OA\MediaType(mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *              type="object",
     *              required={"name", "phone", "user_ident", "organization", "password", "password_confirm"},
     *               @OA\Property(property="name", type="string", description="用户名"),
     *               @OA\Property(property="phone", type="string", description="手机号"),
     *               @OA\Property(property="user_ident", type="string", description="身份证"),
     *               @OA\Property(property="organization", type="int", description="党组织"),
     *               @OA\Property(property="password", type="string", description="密码"),
     *               @OA\Property(property="password_confirm", type="string", description="确认密码"),
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
     *                          @OA\Property(property="name", type="string", description="用户名"),
     *                          @OA\Property(property="phone", type="string", description="手机号"),
     *                          @OA\Property(property="user_ident", type="string", description="身份证"),
     *                          @OA\Property(property="organization", type="integer", description="党组织"),
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
        $validate = new UserValidate();
        if (!$validate->check(input())) {
            $this->error($validate->getError());
        }
        $user               = new User();
        $user->name         = input('name');
        $user->phone        = input('phone');
        $user->user_ident   = input('user_ident');
        $user->organization = input('organization');
        $user->password     = cmf_password(input('password'));
        $user->save();
        $this->success('请求成功!', $user);
    }

    public function me()
    {
        if ($user =  JWT::authenticate()) {
            $this->success('请求成功!', $user);
        }

        $this->error('请求失败!');
    }
}