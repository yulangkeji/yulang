<?php

namespace app\index\controller;

use app\common\model\yl_home;
use think\Controller;
use think\Db;
use think\Request;
use think\Validate;
use think\View;

class Home extends Common
{
    /**
     * 首页设置列表
     */
    public function index(){
        $settings = Db::table('yl_home')->select();
        return view('', compact('settings'));
    }

    /**
     * 新增设置
     */
    public function add(){
        return view();
    }
    /**
     * 提交新增
     */
    public function post_add(Request $request){
        $post = $request->post();


        // 验证数据
        $validate = Validate::make([
            'path' => 'require',
            'type' => 'require'
        ]);
        $status = $validate->check($post);
        if(! $status){
            return $this->error($validate->getError());
        }

        // 验证通过，保存数据到数据库
        $result = Db::table('yl_home')->insert([
            'type' => $post['type'],
            'path' => $post['path'],
            'desc' => $post['desc'],
            'btn_url' => $post['btn_url'],
        ]);
        if($result === 0){
            return $this->error('保存失败');
        }
        return $this->success('保存成功', '/public/index/home');
    }

    /**
     * 删除某条配置
     */
    public function delete(Request $request){
        $post = $request->post();
        $id = $post['id'];
        $setting = Db::table('yl_home')->find($id);
        if(empty($setting)){
            return $this->error('未找到您所要删除的配置');
        }
         $result = Db::table('yl_home')->delete($id);
        if($result === 0){
            return $this->error('删除失败');
        }
        return $this->success('删除成功');
    }

    /**
     * 修改某条设置
     */
    public function edit(Request $request){
        $get = $request->get();
        $id = $get['id'];
        $setting = Db::table('yl_home')->find($id);
        if(empty($setting)){
            return $this->error('未找到您所要修改的配置');
        }

        return view('', compact('setting'));
    }
    public function post_edit(Request $request){
        $post = $request->post();
        // 验证数据
        $id = $post['id'];
        $setting = Db::table('yl_home')->find($id);
        if(empty($setting)){
            return $this->error('未找到您所要修改的配置');
        }
        $validate = Validate::make([
            'path' => 'require',
            'type' => 'require'
        ]);
        $status = $validate->check($post);
        if(! $status){
            return $this->error($validate->getError());
        }

        // 验证通过，保存数据到数据库
        $result = Db::table('yl_home')->where('id', $id)->update([
            'type' => $post['type'],
            'path' => $post['path'],
            'desc' => $post['desc'],
            'btn_url' => $post['btn_url'],
        ]);
        if($result === 0){
            return $this->error('保存失败');
        }
        return $this->success('保存成功', '/public/index/home');
    }
}
