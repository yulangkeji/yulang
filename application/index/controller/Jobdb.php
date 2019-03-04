<?php
/**
 * 2019年3月1日
 * 驭浪逛网招聘写入模块
 * 数据表：yl_job
 * 字段：name, centent
 */
namespace app\index\controller;

use think\Controller;

class Jobdb extends Controller
{
    /**
     * 保存招聘信息
     * 待新增表单验证
     */
    public function add_data()
    {
        if ($_POST["name"] != null && $_POST["editorValue"]!=null)
        {
            $data = [
                'name' => $_POST["name"],
                'centent' =>$_POST["editorValue"],
                'date' => date("Y-m-d")
            ];
            
            $add = model("job")->insert($data);
            if ($add)
            {
                echo "<script>alert('添加成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";;
            }
        }
        else 
        {
           echo "<script>alert('内容不能为空');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        }
        
    }
}