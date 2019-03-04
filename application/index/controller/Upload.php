<?php

namespace app\index\controller;

use think\Controller;
use think\view\driver\Think;

class Upload extends Common
{
    public function uploadify(){
        $file = $file = request()->file('myfile');
        if (!empty($file)) {
            $info = $file->move(ROOT_PATH.'public'.DS.'upload/');

            if($info){
                $data = $info->getSaveName(); //文件路径
            }else{
                $data = '文件上传失败啦！';
            }
            return $data; //直接返回，不要封住成json
        }
    }
}
