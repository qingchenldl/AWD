<?php
namespace app\daili\controller;
use app\dsadmin\model\GongyouModel;
use think\Db;
use think\Request;
class Gongyou extends Base
{


    public function index(){
	  
		if(input('post.id')){
			$param = input('post.');
			
			if(intval($param['issuiji'])==0){
				if(floatval($param['start'])<config("zuidijiage")){
					return json(['code' => 0,  'msg' => "�۸����"]);
				}
				
				if(floatval($param['end'])>config("zuidajiage")){
					return json(['code' => 0,  'msg' => "�۸����"]);
				}
				
				if(floatval($param['end'])<floatval($param['start'])){
					return json(['code' => 0,  'msg' => "�۸����"]);
				}
				
			}
			
			if(intval($param['issuiji'])==1||config('sfkqsims')==1){
				

				if(floatval($param['guding'])<config("zuidijiage")||floatval($param['guding'])>config("zuidajiage")||!is_numeric($param['guding'])){
					return json(['code' => 0,  'msg' => "�۸����"]);
				}
				$data['guding']=floatval($param['guding']);
			}
			
			$cate = new GongyouModel();
			$flag = $cate->addsiyou($param);
			
			
			
			
			
			
			 return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg'],'url'=>url('daili/gongyou/index')]);
		}
	   
	   
        $map = [];
            
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// ��ȡ������
        $count = Db::name('gongyou')->where($map)->count();//������ҳ��
        $allpage = intval(ceil($count / $limits));
        $gongyou = new GongyouModel();
        $lists = $gongyou->getGongyouByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //��ǰҳ
        $this->assign('allpage', $allpage); //��ҳ��
        $this->assign('count', $count); 
        
		
        if(input('get.page')){
			
			foreach($lists as &$v){
				$fabu=Db::name('siyou')->where(['userid'=>session('dailiuid'),'pid'=>$v->id])->value("id");
				
				if(empty($fabu)){
					$v['fabu']=1;
				}else{
					$v['fabu']=0;
				}
				
			}
			
            return json($lists);
        }
        return $this->fetch();
    }


	public function read(){
			$id = input('id');
			$cate = new GongyouModel();
			$shipin=$cate->getOneGongyou($id);
			 $this->assign('shipin', $shipin); 
			return $this->fetch();
	}
  
  

}