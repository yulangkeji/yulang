<?php
/**
 * 2019年3月3日
 * 驭浪官网接口
 */
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Api extends Controller
{
    /**
     * 公司动态分类接口
     * 返回全部数据
     */
    public function active_type_api()
    {
        $type_data = $this->select_db("active_type");
        echo $type_data;
    }
    
    /**
     * 公司动态文章
     * 根据id查询
     * 没有id默认返回10条最新数据
     */
    public function active_api()
    {
        if ($_POST)
        {         
            $where = [
                'type_id' =>  $_POST["type_id"]
            ];           
            $datalist = $this->select_db("active", $where, 'id desc');
            echo $datalist;
        }
        else 
        {
            $datalist = $this->select_db("active", "", 'id desc', "10");
            echo $datalist;
        }
    }
    /**
     * 查询招聘信息
     * 查询全部招聘信息
     * 返回全部信息
     */
    public function job_api()
    {
        $datalist = $this->select_db("job", "", 'id desc');
        echo $datalist;
    }

    /**
     * 查询首页配置信息接口
     */
    public function home_api(){
        $settings = $this->select_db('home');
        echo $settings;
    }

    /**
     * 关于我们项目配置接口
     */
    public function about_api(){
        $settings = [];
        $settings['profile'] = Db::table('yl_about')->where('name', 'profile')->find();
        $settings['culture'] = Db::table('yl_about')->where('name', 'culture')->find();

        echo json_encode($settings);
    }

    /**
     * 公司项目配置接口
     */
    public function project_api(Request $request){
        $get = $request->get();
        $id = $get['id'];
        if(! empty($id)){
            $setting = Db::table('yl_project')->find($id);
            $settings = json_encode($setting);
        }
        else{
            $settings = $this->select_db('project');
        }
        echo $settings;
    }
    
    /**
     * 查询数据库
     * @param unknown $db_name
     * @param unknown $where
     * @param unknown $order
     * @param unknown $limit
     */
    private function select_db($db_name = "", $where = "", $order = "", $limit = "")
    {
        $data = model($db_name);
        if ($where!="")
        {
            $data = $data->where($where);
        }
        if ($order != "")
        {
            $data = $data->order($order);
        }
        if ($limit != "")
        {
            $data = $data->limit($limit);
        }
        $data = $data->select();
        $json = json_encode($data);
        
        return $json;
    }
    
    
}