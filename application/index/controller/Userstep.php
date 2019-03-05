<?php
/**
 * 2019年3月2日
 * 记录用户预览页面信息
 * 显示查询
 */
namespace app\index\controller;

class Userstep extends Common
{
    public function u_step()
    {
        $data = model('user_step')->order('id desc')->select();
        $this->assign("steplist", $data);
        return view();
    }
}