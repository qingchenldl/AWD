<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\ConfigModel;
use think\Db;

class Config extends Base
{

    /**
     * [index 配置列表]
     * @author [dashang]
     */
    public function index(){

        $key = input('key');
        $map = [];
        if($key&&$key!=="")
        {
            $map['title'] = ['like',"%" . $key . "%"];          
        }       
        $config = new ConfigModel();
        $nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = $config->getAllCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));      
        $list = $config->getAllConfig($map, $nowpage, $limits);  
        $this->assign('nowpage', $nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
        $this->assign('list', $list);
        return $this->fetch();
    }


    /**
     * [add_config 添加配置]
     * @author [dashang]
     */
    public function add_config()
    {
        if(request()->isAjax()){

            $param = input('post.');
            $config = new ConfigModel();
            $flag = $config->insertConfig($param);
            cache('db_config_data',null);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        return $this->fetch();
    }


    /**
     * [edit_config 编辑配置]
     * @author [dashang]
     */
    public function edit_config()
    {
        $config = new ConfigModel();
        if(request()->isAjax()){
            $param = input('post.');
            $flag = $config->editConfig($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $info = $config->getOneConfig($id);
        $this->assign('info', $info);
        return $this->fetch();
    }


    /**
     * [del_config 删除配置]
     * @author [dashang]
     */
    public function del_config()
    {
        $id = input('param.id');
        $config = new ConfigModel();
        $flag = $config->delConfig($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }



    /**
     * [user_state 配置状态]
     * @author [dashang]
     */
    public function status_config()
    {
        $id = input('param.id');
        $status = Db::name('config')->where(array('id'=>$id))->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('config')->where(array('id'=>$id))->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('config')->where(array('id'=>$id))->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }
    
    }


    /**
     * [获取某个标签的配置参数]
     * @author [dashang] 
     */
    public function group() {
        $id   = input('id',1);
        $type = config('config_group_list'); 
        $list = Db::name("Config")->where(array('status'=>1,'group'=>$id))->field('id,name,title,extra,value,remark,type')->order('sort')->select();
        if($list) {
            $this->assign('list',$list);
        }
        $this->assign('id',$id);
        return $this->fetch();
    }



    /**
     * [批量保存配置]
     * @author [dashang]
     */
    public function save($config){
        //print_r($config);
        if($config && is_array($config)){
            $Config = Db::name('Config');
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                $Config->where($map)->setField('value', $value);
            }
        }
        cache('db_config_data',null);
        $this->success('保存成功！');
    }

}