<?php

use think\facade\Route;

# 用户注册
Route::post('hzj/users', 'hzj/Users/store');
# 用户登录
Route::post('hzj/authorizations', 'hzj/Authorizations/store');
# 下拉菜单
Route::get('hzj/dropList/dropList', 'hzj/DropList');
# 获取手机验证码
Route::post('hzj/phoneCode', 'hzj/Verifications/store');
# 需要登录才能访问的接口
Route::get('hzj/users', 'hzj/Users/me')->middleware(\api\hzj\http\middleware\HeaderToken::class);