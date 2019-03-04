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
        //$data2 = $this->active_content();
        //$this->assign("actived", $data2);
        //var_dump($data2);
        //return $this->fetch();
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
        $ac = model('active')->where('type_id', 1)->select();
        //$json_data = json_encode($ac);
        return $ac;
    }
    
}