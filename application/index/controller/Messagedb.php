<?php
/**
 * 2019年3月1日
 * 驭浪联系我们留言写入模块
 * 表名称：message
 * 字段：name, phone, centent, create_time
 */
namespace app\index\controller;

use think\Controller;

class Messagedb extends Controller
{
    public function add_message()
    {
        if ($_POST)
        {
            $data = [
                'name' => "驭浪2",
                'phone' => "18888888888",
                'centent' => "业务合作咨询",
                'create_time' => date("Y-m-d H:i:s")
            ];
            $add_msg = model('message')->insert($data);
            if ($add_msg)
            {
                echo "添加成功";
            }
        }
        
    }
}