<?php
namespace app\daili\controller;
use app\dsadmin\model\GonggaoModel;
use think\Db;

class Gonggao extends Base
{


   
    public function index(){

        $key = input('key');
		$riqi= input('riqi');
		$map=[];
        
		
		 
        $order = new GonggaoModel();    

        $Nowpage = input('get.page') ? input('get.page'):1;

        $limits = config('list_rows');;// 获取总条数
        $count = Db::name("gonggao")->where($map)->count();//计算总页面
		
        $allpage = intval(ceil($count / $limits));  
       
        $lists = $order->getGonggaoAll($map, $Nowpage, $limits);   

        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
		 $this->assign('riqi', $riqi);
        if(input('get.page'))
        {
			
            return json($lists);
        }
		
		
		
        return $this->fetch();
    }

	
	 public function read(){
		 $id=input('id');
		 $order = new GonggaoModel(); 
		  $gonggao = $order->getOneGonggao($id);  
			 $this->assign('gonggao', $gonggao);
		 return $this->fetch();
	 }
	
	
   
   

}