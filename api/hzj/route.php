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
# 资源列，需求，心愿列表
Route::get('hzj/resources', 'hzj/Resources/index');
# 分类
Route::get('hzj/categories', 'hzj/Categories/index');
# 新闻
Route::get('hzj/information', 'hzj/Information/index');
# 党课
Route::get('hzj/lessons', 'hzj/Lessons/index');
# 需要登录才能访问的接口
Route::get('hzj/users', 'hzj/Users/me')->middleware(\api\hzj\http\middleware\HeaderToken::class);
# 发布心愿，需求，资源
Route::post('hzj/resources', 'hzj/Resources/store')->middleware(\api\hzj\http\middleware\HeaderToken::class);
# 认领心愿
Route::get('hzj/claim/:id', 'hzj/Resources/claimWish')->middleware(\api\hzj\http\middleware\HeaderToken::class);
# 兑现心愿
Route::get('hzj/realize/:id', 'hzj/Resources/realizeWish')->middleware(\api\hzj\http\middleware\HeaderToken::class);
# 浏览加积分
Route::get('hzj/read/:id/information', 'hzj/Information/read')->middleware(\api\hzj\http\middleware\HeaderToken::class);
# 上微党课加积分
Route::get('hzj/read/:id/lesson', 'hzj/Lessons/read')->middleware(\api\hzj\http\middleware\HeaderToken::class);