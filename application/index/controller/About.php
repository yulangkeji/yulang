<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class About extends Common
{
    /**
     * 关于我们设置显示
     */
    public function index(){
        $profile = Db::table('yl_about')->where('name', 'profile')->find();
        $culture = Db::table('yl_about')->where('name', 'culture')->find();
        $data = ['profile' => $profile, 'culture' => $culture];
        return view('', compact('data'));
    }

    /**
     * 提交保存的方法
     */
    public function post(Request $request){
        $post = $request->post();
        // 验证数据
        if(empty($post['profile_path'])){
            return $this->error('请上传公司简介的显示文件');
        }
        if(empty($post['culture_path'])){
            return $this->error('请上传企业文化的显示文件');
        }
        // 保存配置
        Db::table('yl_about')->where('name', ['=','profile'], ['=', 'culture'], 'or')->delete();
        $profile_result = Db::table('yl_about')->insert([
            'name' => 'profile',
            'path' => $post['profile_path'],
            'type' => $post['profile_type'],
            'content' => $post['profile_content'],
        ]);
        $culture_result = Db::table('yl_about')->insert([
            'name' => 'culture',
            'path' => $post['culture_path'],
            'type' => $post['culture_type'],
            'content' => $post['culture_content'],
        ]);
        if($profile_result === 0 || $culture_result === 0){
            return $this->error('保存失败');
        }
        return $this->success('保存成功', '/public/index/about');
    }
}
