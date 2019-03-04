<?php
/**
 * 2019年3月1日
 * 查询招聘信息模块
 */
namespace app\index\controller;

use think\Controller;

class Job extends Controller
{
    /**
     * 操作信息页面
     */
    public function jobview()
    {
        $jobdata = $this->job_data();
        $this->assign("jdata", $jobdata);
        return view();   
    }
    
    /**
     * 获取招聘信息
     */
    public function job_data()
    {
        $j_d = model("job")->select();
        return $j_d;
    }
    
}