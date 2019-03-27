<?php
namespace app\daili\controller;
use app\dsadmin\model\SiyouModel;

use think\Db;
use think\Request;
class Siyou extends Base
{


    public function index(){
	  
		
	   
        $map = ['userid'=>session('dailiuid')];
        
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = Db::name('Siyou')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $Siyou = new SiyouModel();
        $lists = $Siyou->getSiyouByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count); 
       
		
        if(input('get.page')){
			if($lists) {
			$lists = collection($lists)->toArray();
			}
			
			foreach($lists as &$v){
				
				$ddhtz=random(10);
				
				if(config('ffymkg')==1){
				$longurl=config('ffymsz')."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddhtz;
				}else{
				$longurl="http://".$_SERVER['HTTP_HOST']."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddhtz;	
				}
				
				
				$long=urlencode($longurl);
				
				
				
				$zl2 =dwz($long,config('dwzjk'));  
				$v['dwz']=$zl2;
			}
			
            return json($lists);
        }
        return $this->fetch();
    }
	public function read(){
			$id = input('id');
			$cate = new SiyouModel();
			$shipin=$cate->getOneSiyou($id);
			 $this->assign('shipin', $shipin); 
			return $this->fetch();
	}
	public function fabushipin(){
		
		 if(input('post.url')){
			 
			 $siyoucount=Db::name('siyou')->where(['userid'=>session('dailiuid')])->count();
			 if($siyoucount+1>config('dlzdsps')){
				 return json(['code' => 0,  'msg' => "视频数超过限制"]);
			 }
			 
			 $data=input('post.');
			 $param=$data;
			 if(intval($param['issuiji'])==0){
				if(floatval($param['start'])<config("zuidijiage")){
					return json(['code' => 0,  'msg' => "价格错误"]);
				}
				
				if(floatval($param['end'])>config("zuidajiage")){
					return json(['code' => 0,  'msg' => "价格错误"]);
				}
				
				if(floatval($param['end'])<floatval($param['start'])){
					return json(['code' => 0,  'msg' => "价格错误"]);
				}
				
			}
			
			if(intval($param['issuiji'])==1||config('sfkqsims')==1){
				

				if(floatval($param['guding'])<config("zuidijiage")||floatval($param['guding'])>config("zuidajiage")||!is_numeric($param['guding'])){
					return json(['code' => 0,  'msg' => "价格错误"]);
				}
				$data['guding']=floatval($param['guding']);
			}
			 
			 $Siyou = new SiyouModel();
			 $flag=$Siyou->fabushipin($data);
			 return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
		 }
		
		

		
		return $this->fetch();
	}
	
	
	public function wodelianjie(){
		
		 if(input('get.shengcheng')){
			 
			  $siyou=Db::name('siyou')->where(['userid'=>session('dailiuid')])->select();
			  if($siyou) {
				$siyou = collection($siyou)->toArray();
				}
			  
			  foreach($siyou as $v){
				  $ddhtz=random(10);
				//$longurl=config('ffymsz')."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddhtz;
				
				if(config('ffymkg')==1){
				$longurl=config('ffymsz')."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddhtz;
				}else{
				$longurl="http://".$_SERVER['HTTP_HOST']."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddhtz;	
				}
				
				$long=urlencode($longurl);
				
				
				
				$zl2 =dwz($long,config('dwzjk'));  
				$res[] =$v['name']."  ".$zl2;
			  }
			 echo implode(',',$res);
			  exit;
		 }
		
		
		return $this->fetch();
	}
	
	public function wailian(){
		
		 if(input('post.url')){
			 
			 $siyoucount=Db::name('siyou')->where(['userid'=>session('dailiuid')])->count();
			 if($siyoucount+1>config('dlzdsps')){
				 return json(['code' => 0,  'msg' => "视频数超过限制"]);
			 }
			 $data=input('post.');
			 $param=$data;
			  
			 if(intval($param['issuiji'])==0){
				if(floatval($param['start'])<config("zuidijiage")){
					return json(['code' => 0,  'msg' => "价格错误"]);
				}
				
				if(floatval($param['end'])>config("zuidajiage")){
					return json(['code' => 0,  'msg' => "价格错误"]);
				}
				
				if(floatval($param['end'])<floatval($param['start'])){
					return json(['code' => 0,  'msg' => "价格错误"]);
				}
				
			}
			
			if(floatval($param['issuiji'])==1||config('sfkqsims')==1){
				

				if(floatval($param['guding'])<config("zuidijiage")||floatval($param['guding'])>config("zuidajiage")||!is_numeric($param['guding'])){
					return json(['code' => 0,  'msg' => "价格错误"]);
				}
				$data['guding']=floatval($param['guding']);
			}
			
			 $Siyou = new SiyouModel();
			 $flag=$Siyou->fabushipinwailian($data);
			 return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
		 }
		
		
		return $this->fetch();
	}
	

	public function editprice(){
		
		$id=input("post.id");
		$siyou=Db::name('siyou')->where(['id'=>$id])->find();
		if($siyou['userid']!=session('dailiuid')){
			echo "<script>location.href='index.php'</script>";
		exit;
			
		}
		$neirong=input("post.money");
		if($id==null  or $neirong==null){
		echo "<script>location.href='index.php'</script>";
		exit;
		}
                  
       if(config('sfkqsims')==1){
              if (strpos($neirong, '-') !== false) {
                  return json(['code' => 0,  'msg' => "价格错误"]);
               }
                  
              

				if(floatval($neirong)<config("zuidijiage")||floatval($neirong)>config("zuidajiage")||!is_numeric($neirong)){
					return json(['code' => 0,  'msg' => "价格错误"]);
				}
       }   
                  
		if (strpos($neirong, '-') !== false) {
			$p = explode('-',$neirong); 
			$sj=$p[0];
			$money=$p[1];
            
            if($money<config("zuidijiage")||$sj>config("zuidajiage")){
                  return json(['code' => 0,  'msg' => "价格错误"]);
            } 
            
		}else{
			$sj=$neirong;
			$money=$neirong;
		}
		Db::name('siyou')->where(['id'=>$id])->update(['sj'=>$sj,"money"=>$money]);
		echo json_encode(array('zt'=>"1"));
	}
	
	public function edittitle(){
		
		$id=input("post.id");
		$siyou=Db::name('siyou')->where(['id'=>$id])->find();
		if($siyou['userid']!=session('dailiuid')){
			echo "<script>location.href='index.php'</script>";
		exit;
			
		}
		$name=input("post.name");
		if($id==null){
		echo "<script>location.href='index.php'</script>";
		exit;
		}
		
		Db::name('siyou')->where(['id'=>$id])->update(['name'=>$name]);
		echo json_encode(array('zt'=>"1"));
	}
  
	public function del()
    {
        $id = input('param.id');
        $cate = new SiyouModel();
        $flag = $cate->delSiyoudaili($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

}