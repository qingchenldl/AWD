<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\TousuModel;
use think\Db;

class Tousu extends Base
{


    public function index(){

        $key = input('key');
        $map = [];
       
        if($key&&$key!=="")
        {
            $map['title'] = ['like',"%" . $key . "%"];          
        }             
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db('ts')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $Tousu = new TousuModel();
        $lists = $Tousu->getTousuAll($map, $Nowpage, $limits);    
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }


    public function add_Tousu()
    {
        if(request()->isAjax()){

            $param = input('post.');
            $param['closed'] = 0;
            $Tousu = new TousuModel();
            $flag = $Tousu->insertTousu($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
       
        return $this->fetch();

    }


  
    



    public function del()
    {
        $id = input('param.id');
        $Tousu = new TousuModel();
        $flag = $Tousu->delTousu($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
	
	public function jz_tousu()
    {
        $id = input('param.id');
        $Tousu = new TousuModel();
        $flag = $Tousu->jzTousu($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
	
	public function yx_tousu()
    {
        $id = input('param.id');
        $Tousu = new TousuModel();
        $flag = $Tousu->yxTousu($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
	

   

}