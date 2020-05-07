<?php

use think\facade\Route;

Route::resource('hzj/users', 'hzj/Users');
Route::get('hzj/dropList/dropList', 'hzj/DropList');
