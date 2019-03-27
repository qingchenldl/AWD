<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\PayModel;
use think\Db;

class Pay extends Base
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
		$map['zt']="等待支付";
        $pay = new PayModel();    

        $Nowpage = input('get.page') ? input('get.page'):1;

        $limits = 10;// 获取总条数
        $count = $pay->getAllCount($map);//计算总页面
		
        $allpage = intval(ceil($count / $limits));  
       
        $lists = $pay->getPayByWhere($map, $Nowpage, $limits);   

        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
		 $this->assign('riqi', $riqi);
        if(input('get.page'))
        {
			
            return json($lists);
        }
		$map=[];
		
		
		$dzfbs=Db::name("pay")->where(['zt'=>"等待支付"])->count();
		$this->assign('dzfbs', $dzfbs);
		
		$money1=Db::name("pay")->where(['zt'=>"等待支付"])->sum('money');
		$this->assign('money1', empty($money1)?0:$money1);
		

		
		
        return $this->fetch();
    }

	
	public function yjs(){

        $key = input('key');
		$riqi= input('riqi');
		$map=[];
        if($key){
			$map['userid']=$key;
		}
		
		if($riqi){
			$map['shijian']=['like',"%".$riqi."%"];
		}
		$map['zt']="已支付";
        $pay = new PayModel();    

        $Nowpage = input('get.page') ? input('get.page'):1;

        $limits = 10;// 获取总条数
        $count = $pay->getAllCount($map);//计算总页面
		
        $allpage = intval(ceil($count / $limits));  
       
        $lists = $pay->getPayByWhere($map, $Nowpage, $limits);   

        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
		 $this->assign('riqi', $riqi);
        if(input('get.page'))
        {
			
            return json($lists);
        }
		$map=[];
		
		
		$dzfbs=Db::name("pay")->where(['zt'=>"已支付"])->count();
		$this->assign('dzfbs', $dzfbs);
		
		$money1=Db::name("pay")->where(['zt'=>"已支付"])->sum('money');
		$this->assign('money1', empty($money1)?0:$money1);
		

		
		
        return $this->fetch();
    }

    public function dakuan(){
		$ids=input('id');
		$pay = new PayModel();    
		$flag = $pay->dakuan($ids);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
	}
    
	public function hedui(){
		$userid=input('userid');
		$this->assign('userid',$userid);
		$dzfbs=Db::name("pay")->where(['zt'=>"等待支付",'userid'=>$userid])->count();
		$this->assign('dzfbs', $dzfbs);
		
		$money1=Db::name("pay")->where(['zt'=>"等待支付",'userid'=>$userid])->sum('money');
		$this->assign('money1', empty($money1)?0:$money1);
		
		
		$yzfbs=Db::name("pay")->where(['zt'=>"已支付",'userid'=>$userid])->count();
		$this->assign('yzfbs', $yzfbs);
		
		$money2=Db::name("pay")->where(['zt'=>"已支付",'userid'=>$userid])->sum('money');
		$this->assign('money2', empty($money2)?0:$money2);
		
		$zddbs=Db::name("dingdan")->where(['userid'=>$userid])->count();
		$this->assign('zddbs', $zddbs);
		
		$money3=Db::name("dingdan")->where(['userid'=>$userid])->sum('money');
		$this->assign('money3', empty($money3)?0:$money3);
		
		
		
		
		$member=Db::name("member")->where(['id'=>$userid])->find();
		$this->assign('member', $member);
		
		$sjmoney=$money3-(($money3*$member['txfeilv'])/100);
		$this->assign('sjmoney', $sjmoney);
		
		$day=date("Y-m-d");
		$zuori=date("Y-m-d",strtotime("$day-1 day"));
		
		
		$jrddbs=Db::name("dingdan")->where(['userid'=>$userid,'shijian'=>['like',"%".$day."%"]])->count();
		$this->assign('jrddbs', $jrddbs);
		
		$jrddje=Db::name("dingdan")->where(['userid'=>$userid,'shijian'=>['like',"%".$day."%"]])->sum('money');
		$this->assign('jrddje', empty($jrddje)?0:$jrddje);
		
		$zrddbs=Db::name("dingdan")->where(['userid'=>$userid,'shijian'=>['like',"%".$zuori."%"]])->count();
		$this->assign('zrddbs', $zrddbs);
		
		
		
		$zrddje=Db::name("dingdan")->where(['userid'=>$userid,'shijian'=>['like',"%".$zuori."%"]])->sum('money');
		$this->assign('zrddje', empty($zrddje)?0:$zrddje);
		
		
		$qrddbs=Db::query("select count(*) as count from  ".config('database.prefix')."dingdan  where  userid='$userid' and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(shijian)");
		$this->assign('qrddbs', $qrddbs[0]['count']);
		
		$qrddje=Db::query("select sum(money) as money from  ".config('database.prefix')."dingdan  where  userid='$userid' and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(shijian)");
		$this->assign('qrddje', $qrddje[0]['money']);
		
		$ssrddbs=Db::query("select count(*) as count from  ".config('database.prefix')."dingdan  where  userid='$userid' and DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= date(shijian)");
		$this->assign('ssrddbs', $ssrddbs[0]['count']);
		
		$ssddje=Db::query("select sum(money) as money from  ".config('database.prefix')."dingdan  where  userid='$userid' and DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= date(shijian)");
		$this->assign('ssddje', $ssddje[0]['money']);
		
		
		return $this->fetch();
	}
	
   
   

}