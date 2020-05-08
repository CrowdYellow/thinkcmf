<?php


namespace api\hzj\controller;

use cmf\controller\RestBaseController;
use Zewail\Api\Facades\JWT;

/**
 * @OA\Info(title="HZJ接口文档", version="0.1")
 */
class ApiController extends RestBaseController
{
    public function user()
    {
        return JWT::authenticate();
    }
}