<?php
namespace app\index\controller;

class Managedb extends Common
{
    /**
     * 删除active公司活动文章
     */
    public function delete_active()
    {
        $id = $_GET['id'];
        $r_d = model('active')->where('id', $id)->delete();
        if ($r_d)
        {
            return $this->success('删除成功');
        }
        else 
        {
            return $this->error('删除失败');
        }
        
    }
    /**
     * 删除招聘
     */
    public function delete_job()
    {
        $id = $_GET["id"];
        $d_job = model('job')->where('id', $id)->delete();
        if ($d_job)
        {
            return $this->success('删除成功');
        }
        else
        {
            return $this->error('删除失败');
        }
    }
}