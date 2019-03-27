<?php
namespace app\daili\controller;
use app\dsadmin\model\OrderModel;
use think\Db;

class Mingxi extends Base
{


   
    public function dsjl(){

        $key = input('key');
		$riqi= input('riqi');
		$map=[];
        
		$map['userid']=session('dailiuid');
		
		
		if($riqi){
			$map['shijian']=['like',"%".$riqi."%"];
		}
		 
        $order = new OrderModel();    

        $Nowpage = input('get.page') ? input('get.page'):1;

        $limits = config('list_rows');;// 获取总条数
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
		$map['userid']=session('dailiuid');
		$daydd=Db::name("dingdan")->where($map)->count();
		$this->assign('daydd', $daydd);
		
		$money1=Db::name("dingdan")->where($map)->sum('money');
		$this->assign('money1', $money1);
		
		
		
		$map['shijian']=['like',"%".$zuori."%"];
		$zdd=Db::name("dingdan")->where($map)->count();
		$this->assign('zdd', $zdd);
		
		$money2=Db::name("dingdan")->where($map)->sum('money');
		$this->assign('money2', $money2);
		
		$map=[];
		$map['userid']=session('dailiuid');
		$zong=Db::name("dingdan")->where($map)->count();
		$this->assign('zong', $zong);
		
		$money3=Db::name("dingdan")->where($map)->sum('money');
		$this->assign('money3', $money3);
		
		
        return $this->fetch();
    }


	public function dstj(){
		$userid=session('dailiuid');
		
		for($i = 0;$i <24;$i++){
		$tmp = 'sj';
		$tmp .= $i;
		$$tmp = "0";
		$sql = sprintf("select sum(money) as money from ".config('database.prefix')."dingdan where userid='$userid' and   shijian>='".date('Y-m-d').' '."%02d:00:00"."' and shijian<='".date('Y-m-d').' '."%02d:59:59"."'",$i,$i);
		
		
		
			$$tmp = empty($res[0]['money']) ? "0" : $res[0]['money'];
			
			$this->assign($tmp, $$tmp);
		}
		
		
		for($i = 0;$i <24;$i++){
		$tmp = 'dj';
		$tmp .= $i;
		$$tmp = "0";
		$sql = sprintf("select sum(money) as money from ".config('database.prefix')."dingdan where userid='$userid'  and   shijian>='".date('Y-m-d',strtotime('-1 day')).' '."%02d:00:00"."' and shijian<= '".date('Y-m-d',strtotime('-1 day')).' '."%02d:59:59"."'",$i,$i);
		$res=Db::query($sql);
		
			
		$$tmp = empty($res[0]['money']) ? "0" : $res[0]['money'];
		
		$this->assign($tmp, $$tmp);
		
			
		}
		
		
		return $this->fetch();
	}
    
	
	
   
   

}