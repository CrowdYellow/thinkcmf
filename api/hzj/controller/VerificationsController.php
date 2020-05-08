<?php

namespace api\hzj\controller;

use think\facade\Cache;
use think\Validate;

class VerificationsController extends ApiController
{
    /**
     * @OA\Post(
     *     tags={"用户相关"},
     *     path="/api/hzj/phoneCode",
     *     operationId="api.send.phoneCode",
     *     summary="发送手机验证码",
     *     description="发送手机验证码接口",
     *     @OA\RequestBody(
     *      @OA\MediaType(mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *              type="object",
     *              required={"phone"},
     *               @OA\Property(property="phone", type="string", description="手机号"),
     *               @OA\Property(property="serve", type="string", description="用于测试，可不填"),
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
     *                          @OA\Property(property="key", type="string", description="验证码唯一key"),
     *                          @OA\Property(property="expired_at", type="integer", description="过期时间（秒）"),
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
        $phone = input('phone');

        $validate = new Validate();
        $validate->rule([
            'phone'  => [
                'require',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/'
            ]
        ]);
        if (!$validate->check(['phone' => $phone])) {
            $this->error($validate->getError());
        }

        # 生成随机四位数
        if (array_key_exists('serve', input()) && input('serve') == 'production') {
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
        } else {
            $code = 1234;
        }
        # 验证码唯一key
        $key = 'phone_code'.cmf_random_string(15);
        # 验证码过期时间 10分钟
        $expiredAt = 60*10;
        # 缓存
        Cache::set($key, ['phone' => $phone, 'code' => $code], $expiredAt);
        $this->success('发送成功', [
            'key' => $key,
            'expired_at' => $expiredAt,
        ]);
    }
}