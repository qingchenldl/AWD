<?php
namespace app\daili\controller;
use app\dsadmin\model\MemberModel;
use app\dsadmin\model\FanyongModel;
use app\dsadmin\model\YqmModel;
use think\Db;

class User extends Base
{


   
    public function index(){

        
		$member=Db::name("member")->where(['id'=>session('dailiuid')])->find();
		
		if(request()->isAjax()){

            $param = input('post.');
			
			$data=[];
			
			$data['id']=session('dailiuid');
			
			$data['account']=$param['account'];
			$data['nickname']=$param['nickname'];
			$data['password']=$param['password'];
			$data['head_img']=$param['head_img'];
			$data['qq']=$param['qq'];
			$data['weixin']=$param['weixin'];
			
			
			 $memberm = new MemberModel();
			
            $flag = $memberm->editMember($data);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
		
		$this->assign('member', $member);
		
        return $this->fetch();
    }
	public function yqm(){
		$key= input('key');
		$map=[];
        $map['userid']=session('dailiuid');
		if($key==1){
			$map['zt']="��ʹ��";
			
		}
		if($key==2){
			$map['zt']="δʹ��";
			
		}
		$Nowpage = input('get.page') ? input('get.page'):1;

        $limits = config('list_rows');// ��ȡ������
        $count = Db::name("yqm")->where($map)->count();//������ҳ��
		$allpage = intval(ceil($count / $limits));  
		$Member = new YqmModel();    
		
		$lists = $Member->getYqmByWhere($map, $Nowpage, $limits);   
		 $this->assign('Nowpage', $Nowpage); //��ǰҳ
        $this->assign('allpage', $allpage); //��ҳ�� 
		 $this->assign('key', $key);
		 
		if(input('get.page'))
        {
			
            return json($lists);
        }
		return $this->fetch();
	}
	
	public function yqmbuy(){
		$member=Db::name("member")->where(['id'=>session('dailiuid')])->find();
		if(input("post.")){
			$num=intval(input("post.num"));
			$price=$num*config("yqmjiage");
			if($num<=0){
				return ['code'=>0,'msg'=>'��������ȷ��'];
			}
			
			if($price>$member['money']){
				return ['code'=>0,'msg'=>'���㣡'];
			}
			Db::name("member")->where(['id'=>session('dailiuid')])->setDec('money',$price);
			
			$Member = new YqmModel();    
			$flag = $Member->insertduoYqm($num);   
			
			 return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
		}
		$this->assign('member', $member);
		return $this->fetch();
	}
	public function xiaji(){
		
		$Nowpage = input('get.page') ? input('get.page'):1;

        $limits = config('list_rows');// ��ȡ������
        $count = Db::name("member")->where(['pid'=>session('dailiuid')])->count();//������ҳ��
		$allpage = intval(ceil($count / $limits));  
		$Member = new MemberModel();    
		$map=['pid'=>session('dailiuid')];
		$lists = $Member->getMemberByWhere($map, $Nowpage, $limits);   
		 $this->assign('Nowpage', $Nowpage); //��ǰҳ
        $this->assign('allpage', $allpage); //��ҳ�� 
		if(input('get.page'))
        {
			
            return json($lists);
        }
		return $this->fetch();
	} 
	
		
	public function fanyong(){
		$riqi= input('riqi');
		$map=[];
        $map['tjr']=session('dailiuid');
		if($riqi){ 
			$map['shijian']=['like',"%".$riqi."%"];
		}
		$Nowpage = input('get.page') ? input('get.page'):1;

        $limits = config('list_rows');// ��ȡ������
        $count = Db::name("fanyong")->where($map)->count();//������ҳ��
		$allpage = intval(ceil($count / $limits));  
		$Member = new FanyongModel();    
		
		$lists = $Member->getMemberByWhere($map, $Nowpage, $limits);   
		 $this->assign('Nowpage', $Nowpage); //��ǰҳ
        $this->assign('allpage', $allpage); //��ҳ�� 
		 $this->assign('riqi', $riqi);
		if(input('get.page'))
        {
			
            return json($lists);
        }
		return $this->fetch();
	}
   
	public function shuoming(){
		$xjjangli=config('yhfybl')/100;
		$this->assign('xjjangli', $xjjangli);
		return $this->fetch();
	}
  

}