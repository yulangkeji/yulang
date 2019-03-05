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
                'name' => $_POST["name"],
                'phone' => $_POST["phone"],
                'centent' => $_POST["centent"],
                'create_time' => date("Y-m-d H:i:s")
            ];
            $add_msg = model('message')->insert($data);
            
            if ($add_msg)
            {
                $data = [
                    "msg" => "1"
                ];
                $js = json_encode($data);
                echo $js;
            }
            else 
            {
                $data = [
                    "msg" => "0"
                ];
                $js = json_encode($data);
                return $js;
            }
        }
        
    }
}