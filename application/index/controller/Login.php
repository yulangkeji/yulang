<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Validate;

class Login extends Controller
{
    /**
     * 显示登陆页面
     */
    public function index(){
        return view();
    }

    /**
     * 登陆提交
     */
    public function post(Request $request){
        $post = $request->post();
        // 验证数据
        $validate = Validate::make([
            '账号' => 'require',
            '密码' => 'require'
        ]);
        $status = $validate->check($post);
        if(! $status){
            return $this->error($validate->getError());
        }
        $user = Db::table('yl_users')->where('username', $post['账号'])->where('password', md5($post['密码']))->find();
        if(empty($user)){
            $this->error('登陆失败，请检查账号和密码');
        }

        // 保存账号信息到session
        unset($user["password"]);
        session("user", $user);

        $this->redirect('/public/index/home');
    }

    /**
     * 退出登陆
     */
    public function logout(){
        Session::delete('user');
        $this->redirect('/public/index/login');
    }
}
