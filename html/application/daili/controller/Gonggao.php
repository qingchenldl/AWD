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

        $limits = config('list_rows');;// ��ȡ������
        $count = Db::name("gonggao")->where($map)->count();//������ҳ��
		
        $allpage = intval(ceil($count / $limits));  
       
        $lists = $order->getGonggaoAll($map, $Nowpage, $limits);   

        $this->assign('Nowpage', $Nowpage); //��ǰҳ
        $this->assign('allpage', $allpage); //��ҳ�� 
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