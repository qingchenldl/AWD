<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\TupianModel;
use think\Db;

class Tupian extends Base
{


  


   
   
    public function index(){

        
        
        $map=[];

        $Tupian = new TupianModel();    

        $Nowpage = input('get.page') ? input('get.page'):1;

        $limits = 10;// 获取总条数
        $count = $Tupian->getAllCount($map);//计算总页面

        $allpage = intval(ceil($count / $limits));  
       
        $lists = $Tupian->getTupianByWhere($map, $Nowpage, $limits);   

        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
       
        if(input('get.page'))
        {
            return json($lists);
        }

        return $this->fetch();
    }


   
    public function add()
    {
        if(request()->isAjax()){

            $param = input('post.');
           unset($param['file']);
            $Tupian = new TupianModel();
            $flag = $Tupian->insertTupian($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

       
        return $this->fetch();
    }


   
   

   
    public function del()
    {
        $id = input('param.id');
        $Tupian = new TupianModel();
        $flag = $Tupian->delTupian($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }


    

}