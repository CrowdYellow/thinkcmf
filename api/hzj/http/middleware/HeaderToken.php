<?php

namespace api\hzj\http\middleware;

use Zewail\Api\Exceptions\JWTException;
use Zewail\Api\Exceptions\TokenExpiredException;
use Zewail\Api\Exceptions\TokenInvalidException;
use Zewail\Api\Facades\JWT;

class HeaderToken
{
    public function handle($request, \Closure $next)
    {
        try {
            if (!$user = JWT::authenticate()) {
                return response([
                    'errcode' => 1004,
                    'errmsg'  => '无此用户',

                ], 404, [], 'json');
            }
            return $next($request);
        } catch (TokenExpiredException $e) {
            return response([
                'errcode' => 1003,
                'errmsg'  => 'token 过期',
            ], 401, [], 'json');
        } catch (TokenInvalidException $e) {
            return response([
                'errcode' => 1002,
                'errmsg'  => 'token 无效',
            ], 401, [], 'json');
        } catch (JWTException $e) {
            return response([
                'errcode' => 1001,
                'errmsg'  => '缺少token',
            ], 401, [], 'json');
        }
    }
}
