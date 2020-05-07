<?php

use think\facade\Route;

# 用户注册
Route::resource('hzj/users', 'hzj/Users');
# 用户登录
Route::resource('hzj/authorizations', 'hzj/Authorizations');
# 下拉菜单
Route::get('hzj/dropList/dropList', 'hzj/DropList');
