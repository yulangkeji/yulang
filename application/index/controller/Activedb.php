<?php
/**
 * 2019-03-01
 * 公司动态模块信息写入
 * 数据表
 * 分类表：yl_active_type
 * 字段：name
 * 内容表：active
 * 字段：type_id, img , title, date, content
 */
namespace app\index\controller;

use think\Controller;

class Activedb extends Common
{
    /**
     * 添加分类
     */
    public function add_type()
    {
        if ($_POST["name"] != null)
        {
            $data = [
                "name" => $_POST["name"]
            ];
            $add_data = model('active_type')->insert($data);
            if ($add_data)
            {
                echo "<script>alert('添加成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
            }
        }
        else 
        {
            echo "<script>alert('内容不能为空');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        }
        
    }
    /**
     * 添加内容
     */
    public function add_active_desc()
    {
        //var_dump($_POST);
        if ($_POST)
        {
            $thumbnail = $this->upload_base64($_POST["thumbnail"], $_POST["1thumbnail"]);
            if ($thumbnail)
            {
                $data = [
                    "type_id" => $_POST["type_id"],
                    "img" => $thumbnail,
                    "title" => $_POST["title"],
                    "date" => date("Y-m-d H:i:s"),
                    "content" => $_POST["editorValue"]
                ];
                $add_data = model('active')->insert($data);
                if ($add_data)
                {
                    echo "添加成功";
                }
            }
            else 
            {
                echo "不支持中文名称";
            }
        }

    }
    /**
     * 上传图片base64
     */
    public function upload_base64($bs, $name){
        $base64 = $bs;
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)){
            $type = $result[2];
            $new_file = ROOT_PATH .'public' . DS . 'static'.DS.'images'.DS.$name;
            $img_name = '/static/images/'.$name;
            if(!is_file($new_file)) {
                
                if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64)))){
                    return $img_name;
                }
            }
            else
            {
                return $img_name;
            }
            $this->img_db($img_name);
            
        }
    }
    
}