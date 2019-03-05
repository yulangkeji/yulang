<?php
/**
 * 2019年3月2日
 * wangqifu
 * 信息管理模块实现预览和删除功能
 */
namespace app\index\controller;

use think\Controller;

class Manage extends Controller
{
    /**
     * 进入管理页面
     * @return \think\response\View
     */
    public function manage_view()
    {
        //查询公司动态（全部）
        $content = model('active')->select();
        $this->assign("contents", $content);
        //查询招聘信息
        $jobdata = model('job')->select();
        $this->assign("jobd", $jobdata);
        return view();
    }
    /**
     * 进入预览页面
     * @return \think\response\View
     */
    public function preview()
    {
        $id = $_GET["id"];
        $content = model('active')->where('id', $id)->select();
        $this->assign("content", $content[0]);
        return view();
    }
    
}