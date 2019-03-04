<?php
namespace app\index\controller;

use think\Controller;

class Message extends Common
{
    /**
     * 查询消息列表显示
     * 
     */
    public function msg_list()
    {
        $msg_list = model("message")->order('id desc')->select();
        
        $this->assign("mlist", $msg_list);
        return view();
    }
}