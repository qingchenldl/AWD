<?php
namespace app\daili\controller;
use app\dsadmin\model\PayModel;
use think\Db;

class Caiwu extends Base
{


   
    public function jilu(){

        
		$riqi= input('riqi');
		$map=[];
        
		$map['userid']=session('dailiuid');
		
		
		if($riqi){
			$map['shijian']=['like',"%".$riqi."%"];
		}
		
        $pay = new PayModel();    

        $Nowpage = input('get.page') ? input('get.page'):1;

        $limits = config('list_rows');// 获取总条数
        $count = $pay->getAllCount($map);//计算总页面
		
        $allpage = intval(ceil($count / $limits));  
       
        $lists = $pay->getPayByWhere($map, $Nowpage, $limits);   

        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
       
		 $this->assign('riqi', $riqi);
        if(input('get.page'))
        {
			
            return json($lists);
        }
		$map=[]; 
		
		
		$dzfbs=Db::name("pay")->where(['zt'=>"等待支付",'userid'=>session('dailiuid')])->count();
		$this->assign('dzfbs', $dzfbs);
		
		$money1=Db::name("pay")->where(['zt'=>"等待支付",'userid'=>session('dailiuid')])->sum('money');
		$this->assign('money1', empty($money1)?0:$money1);
		
		
		
		
        return $this->fetch();
    }

	
	public function sqtixian(){
		$money1=Db::name("pay")->where(['userid'=>session('dailiuid'),'shijian'=>['like',date('Y-m-d')]])->sum('money');
		$member=Db::name("member")->where(['id'=>session('dailiuid')])->find();
		if(input("post.")){
			$data=input("post.");
			if(floatval($data['money'])<config('txzdje')){
				
				return ['code'=>0,'msg'=>'提现金额不能小于最小提现金额！'];
				
			}
			
			if(floatval($data['money'])+$money1>config('mrtxzgje')){
				
				return ['code'=>0,'msg'=>'超过每天可提款总金额！'];
				
			}
			
			if(floatval($data['money'])>config('aqtxje')){
				
				return ['code'=>0,'msg'=>'超过提现单笔最高金额！'];
				
			}
			
			if(floatval($data['money'])>$member['money']){
				
				return ['code'=>0,'msg'=>'提现金额不能大于余额！'];
				
			}
			
			if(floatval($data['password'])!=$member['password']){
				
				return ['code'=>0,'msg'=>'密码错误！'];
				
			}
			
			if($data['type']==1&&empty($data['imgurl'])){
				return ['code'=>0,'msg'=>'请上传收款码！'];
				
			}
			
			if($data['type']==0&&(empty($data['name'])||empty($data['zhanghao'])||empty($data['leixing']))){
				return ['code'=>0,'msg'=>'账户信息不完整！'];
				
			}
			
			Db::name("member")->where(['id'=>session('dailiuid')])->setDec('money',floatval($data['money']));
			Db::name("member")->where(['id'=>session('dailiuid')])->setInc('txmoney',floatval($data['money']));
			$data['shijian']=date("Y-m-d H:i:s");
			$data['userid']=session('dailiuid');
			$data['zt']='等待支付';
			unset($data['password']);
			unset($data['file']);
			Db::name("pay")->insert($data);
			
			if($member['pid']!=0&&floatval($data['money'])>=config("fyzdje")){
				
				$sjmoney=floatval($data['money'])*config("yhfybl")/100;
				$sjmoney=round($sjmoney,2);
				if($sjmoney>0){
					
					Db::name("member")->where(['id'=>$member['pid']])->setInc('money',$sjmoney);
					
					$data2=[];
					$data2['shijian']=date("Y-m-d H:i:s");
					$data2['fymoney']=$sjmoney;
					$data2['name']=$member['nickname'];
					$data2['money2']=$data['money'];
					$data2['tjr']=$member['pid'];
					$data2['txuserid']=$member['id'];
					Db::name("fanyong")->insert($data2);
				}
			}
			
			
			return ['code'=>1,'msg'=>'申请成功！'];
			
			
			
		}

		
		$this->assign('money1', empty($money1)?0:$money1);
		
		$this->assign('member', $member);
		
		$zhsk=Db::name("pay")->where(['userid'=>session('dailiuid')])->order('id desc')->find();
		$type=2;
		if(!empty($zhsk)){
			$type=$zhsk['type'];
		}
		
		$zhsk=Db::name("pay")->where(['userid'=>session('dailiuid'),'type'=>1])->order('id desc')->find();
		
		$this->assign('zhsk', $zhsk);
		
		$zhsk2=Db::name("pay")->where(['userid'=>session('dailiuid'),'type'=>0])->order('id desc')->find();
		
		$this->assign('zhsk2', $zhsk2);
		
		$this->assign('type', $type);
		
        return $this->fetch();
    }

   
  

}