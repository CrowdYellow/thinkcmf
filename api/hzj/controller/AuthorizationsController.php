<?php


namespace api\hzj\controller;

use api\hzj\resource\UserTransformer;
use api\hzj\validate\AuthorizationValidate;
use app\api\model\User;
use think\facade\Cache;
use Zewail\Api\Facades\JWT;

class AuthorizationsController extends ApiController
{
    /**
     * @OA\Post(
     *     tags={"用户相关"},
     *     path="/api/hzj/authorizations",
     *     operationId="api.user.login",
     *     summary="登录",
     *     description="登录接口",
     *     @OA\RequestBody(
     *      @OA\MediaType(mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *              type="object",
     *              required={"name", "phone", "user_ident", "organization", "password", "password_confirm", "key", "code"},
     *               @OA\Property(property="name", type="string", description="用户名"),
     *               @OA\Property(property="phone", type="string", description="手机号"),
     *               @OA\Property(property="user_ident", type="string", description="身份证"),
     *               @OA\Property(property="organization", type="int", description="党组织"),
     *               @OA\Property(property="password", type="string", description="密码"),
     *               @OA\Property(property="key", type="string", description="验证码的key"),
     *               @OA\Property(property="code", type="string", description="验证码"),
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
     *                          @OA\Property(property="user", type="array", @OA\Items(ref="#/components/schemas/Users")),
 *                              @OA\Property(property="token", type="string", description="token"),
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
        $validate = new AuthorizationValidate();
        if (!$validate->check(input())) {
            $this->error($validate->getError());
        }

        # 校验手机验证码
//        $this->checkPhoneCode(input());

        $user = User::where('name', input('name'))->find();

        # 检查用户信息
        $this->checkUserInfo($user, input());

        //1.验证通过返回token
        $token = JWT::fromUser($user);

        $this->success('请求成功', ['user' => UserTransformer::transfer($user), 'token' => $token]);
    }

    /**
     * 检查手机验证码
     * @param $data
     */
    public function checkPhoneCode($data)
    {
        # 获取缓存中key对应的手机号和验证码
        $verifyData = Cache::get($data['key']);

        if (!$verifyData) {
            $this->error('验证码已过期');
        }

        # 判断手机号和验证码是否正确
        if ($verifyData['code'] != $data['code'] && $data['phone'] != $verifyData['phone']) {
            $this->error('验证码错误');
        }

        # 清除缓存
        Cache::rm($data['key']);
    }

    /**
     * 检查用户信息
     * @param $user
     * @param $data
     */
    public function checkUserInfo($user, $data)
    {
        # 判断是否存在该用户
        if (!$user) {
            $this->error('用户名或密码错误');
        }
        # 校对密码
        if (!cmf_compare_password($data['password'], $user->password)) {
            $this->error('用户名或密码错误');
        }
        # 判断手机号
        if ($user->phone != $data['phone']) {
            $this->error('手机号错误');
        }
        # 判断党组织
        if ($user->organization != $data['organization']) {
            $this->error('党组织错误');
        }
    }

    /**
     * 获取设备信息
     * @return string
     */
    public function deviceType()
    {
        $deviceType = '';

        if (cmf_is_mobile()) {
            $deviceType = 'mobile';
        } else if (cmf_is_ipad()) {
            $deviceType = 'ipad';
        } else {
            $deviceType = 'web';
        }

        return $deviceType;
    }
}