<?php
/**
 * 2019年3月2日
 * 记录用户预览页面信息
 * 保存操作
 */
namespace app\index\controller;

use think\Controller;

class Userstepdb extends Controller
{
    public function u_step()
    {
        if ($_POST)
        {
            $step = [
                'u_ip'=>$_POST["u_ip"],
                'client'=>$_POST["client"],
                'u_phone'=>$_POST["u_phone"],
                'view_name'=>$_POST["view_name"],
                'date'=>date("Y-m-d H:i:s")
            ];
            $data = model('user_step')->insert($step);
            if ($data)
            {
                echo "1";
            }
            else 
            {
                echo "-1";
            }
        }
        
    }
}