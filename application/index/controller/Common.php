<?php

namespace app\index\controller;

use think\Controller;
use think\Session;

class Common extends Controller
{
    /**
     * 登陆检测
     */
    public function _initialize(){
        //判断用户是否已经登录
        $user = Session::get('user');
        if (!$user)  {
//             $this->redirect('/index/login');
        }
    }
}
