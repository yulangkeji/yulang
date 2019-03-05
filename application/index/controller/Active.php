<?php
/**
 * 2019年03月01日
 * 公司信息获取
 * 
 */
namespace app\index\controller;

use think\Controller;

class Active extends Common
{
    /**
     * 进入添加动态分类页面
     */
    
    public function addmenu()
    {
        $data = $this->type_data();
        $this->assign("typelist", $data);
        return view();
    }
    /**
     * 获取活动分类信息列表
     * 获取全部内容
     */
    public function type_data()
    {
        $typeList = model('active_type')->select();
        return $typeList;
    }
    /**
     * 获取内容信息
     */
    public function active_content()
    {
        if ($_POST)
        {
            $type_id = $_POST["type_id"];
            $ac = model('active')->where('type_id', $type_id)->order('id desc')->select();
        }
        else 
        {
            $ac = model('active')->order('id desc')->select();
        }
        
        return $ac;
    }
    
}