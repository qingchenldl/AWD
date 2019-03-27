<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\OrderModel;
use think\Db;

class Order extends Base
{


   
    public function index(){

        $key = input('key');
		$riqi= input('riqi');
		$map=[];
        if($key){
			$map['userid']=$key;
		}
		
		if($riqi){
			$map['shijian']=['like',"%".$riqi."%"];
		}
		
        $order = new OrderModel();    

        $Nowpage = input('get.page') ? input('get.page'):1;

        $limits = 10;// 获取总条数
        $count = $order->getAllCount($map);//计算总页面
		
        $allpage = intval(ceil($count / $limits));  
       
        $lists = $order->getOrderByWhere($map, $Nowpage, $limits);   

        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
		 $this->assign('riqi', $riqi);
        if(input('get.page'))
        {
			
            return json($lists);
        }
		$map=[];
		if(!empty($key)){
			$map['userid']=$key;
		}
		if(!empty($riqi)){
			$day=$riqi;
			$zuori=date("Y-m-d",strtotime("$day-1 day"));
			
			$this->assign('day', $day);
			$this->assign('zuori', $zuori);
			
		}else{
			$day=date("Y-m-d");
			$zuori=date("Y-m-d",strtotime("$day-1 day"));
		}
		$map['shijian']=['like',"%".$day."%"];
		$daydd=Db::name("dingdan")->where($map)->count();
		$this->assign('daydd', $daydd);
		
		$money1=Db::name("dingdan")->where($map)->sum('money');
		$this->assign('money1', round($money1,2));
		
		
		
		$map['shijian']=['like',"%".$zuori."%"];
		$zdd=Db::name("dingdan")->where($map)->count();
		$this->assign('zdd', $zdd);
		
		$money2=Db::name("dingdan")->where($map)->sum('money');
		$this->assign('money2', round($money2,2));
		
		$map=[];
		if(!empty($key)){
			$map['userid']=$key;
		}
		$zong=Db::name("dingdan")->where($map)->count();
		$this->assign('zong', $zong);
		
		$money3=Db::name("dingdan")->where($map)->sum('money');
		$this->assign('money3', round($money3,2));
		
		
        return $this->fetch();
    }

    public function search(){

        $key = input('key');
		$start= input('start');
		$end= input('end');
		$map=[];
		$map2="1";
        
		if($start){

			$map2.=" and UNIX_TIMESTAMP(shijian)>=".strtotime($start);
		}

		if($end){
			$map2.=" and UNIX_TIMESTAMP(shijian)<".strtotime($end);
		}
		if(empty($start)||empty($end)){
			$this->error("请选择时间");
		}
		if($key){
			$map['userid']=$key;
			
		}
		
        $order = new OrderModel();    

        $Nowpage = input('get.page') ? input('get.page'):1;

        $limits = 10;// 获取总条数

        $count = $order->getAllCount2($map,$map2);//计算总页面
		
        $allpage = intval(ceil($count / $limits));  
       
        $lists = $order->getOrderByWhere2($map,$map2, $Nowpage, $limits);   

        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
		 $this->assign('start', $start);
		 $this->assign('end', $end);
        if(input('get.page'))
        {
			
            return json($lists);
        }
		

		if(!empty($key)){
			$map['userid']=$key;
		}
		


		
		$daydd=Db::name("dingdan")->where($map)->where($map2)->count();
		$this->assign('daydd', $daydd);
		
		$money1=Db::name("dingdan")->where($map)->where($map2)->sum('money');
		$this->assign('money1', round($money1,2));
		
		
		
		
		
        return $this->fetch();
    }
   
    
	 
	
   
   

}