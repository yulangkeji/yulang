<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Validate;

class Project extends Common
{
    /**
     * 公司项目设置列表
     */
    public function index(){
        $projects = Db::table('yl_project')->select();
        return view('', compact('projects'));
    }

    /**
     * 新增项目
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
            'img' => 'require',
            'title' => 'require',
            'path' => 'require',
        ]);
        $status = $validate->check($post);
        if(! $status){
            return $this->error($validate->getError());
        }

        // 验证通过，保存数据到数据库
        $result = Db::table('yl_project')->insert([
            'img' => $post['img'],
            'title' => $post['title'],
            'type' => $post['type'],
            'path' => $post['path'],
            'content' => $post['content'],
        ]);

        if($result === 0){
            return $this->error('保存失败');
        }
        return $this->success('保存成功', '/public/index/project');
    }

    /**
     * 删除某条配置
     */
    public function delete(Request $request){
        $post = $request->post();
        $id = $post['id'];
        $project = Db::table('yl_project')->find($id);
        if(empty($project)){
            return $this->error('未找到您所要删除的项目');
        }
        $result = Db::table('yl_project')->delete($id);
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
        $project = Db::table('yl_project')->find($id);
        if(empty($project)){
            return $this->error('未找到您所要修改的项目');
        }

        return view('', compact('project'));
    }
    public function post_edit(Request $request){
        $post = $request->post();
        // 验证数据
        $id = $post['id'];
        $project = Db::table('yl_project')->find($id);
        if(empty($project)){
            return $this->error('未找到您所要修改的配置');
        }
        $validate = Validate::make([
            'img' => 'require',
            'title' => 'require',
            'path' => 'require',
        ]);
        $status = $validate->check($post);
        if(! $status){
            return $this->error($validate->getError());
        }

        // 验证通过，保存数据到数据库
        $result = Db::table('yl_project')->where('id', $id)->update([
            'img' => $post['img'],
            'title' => $post['title'],
            'type' => $post['type'],
            'path' => $post['path'],
            'content' => $post['content'],
        ]);

        if($result === 0){
            return $this->error('保存失败');
        }
        return $this->success('保存成功', '/public/index/project');
    }
}
