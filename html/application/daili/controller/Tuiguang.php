<?php
namespace app\daili\controller;
use think\Db;

class Tuiguang extends Base
{

	public function index(){
		 $map = ['userid'=>session('dailiuid')];
        
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = Db::name('tui')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
      
        $lists = Db::name('tui')->where($map)->page($Nowpage, $limits)->order('id desc')->select();
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count); 
       
		
        if(input('get.page')){
			
			foreach($lists as &$v){
				
				$ddhtz=random(10);
				
				if(config('ffymkg')==1){
				$longurl=config('ffymsz')."/index.php/index/index/ff2/userid/".session('dailiuid')."/ddh/".$ddhtz."/id/".$v['id'].".html";
				}else{
				$longurl="http://".$_SERVER['HTTP_HOST']."/index.php/index/index/ff2/userid/".session('dailiuid')."/ddh/".$ddhtz."/id/".$v['id'].".html";
				}
				
				
				$long=urlencode($longurl);
				
				
				
				$zl2 =dwz($long,config('dwzjk'));  
				$v['dwz']=$zl2;
			}
			
            return json($lists);
        }
        return $this->fetch();

	}
   
    public function edit(){
    	$id=input('id');
        
		$tui=Db::name("tui")->where(['userid'=>session('dailiuid'),'id'=>$id])->find();
		
		if(input('post.')){
			$id=input('post.id');
			$shipinurl=input('post.shipinurl');
			Db::name("tui")->where(['userid'=>session('dailiuid'),'id'=>$id])->update(['url'=>$shipinurl]);
			 return json(['code' => 1,  'msg' => "修改成功"]);
		}
		
		
		
		$this->assign('tui', $tui);
		$ddhtz=random(10);
				if(config('ffymkg')==1){ 
				$longurl=config('ffymsz')."/index.php/index/index/ff2/userid/".session('dailiuid')."/ddh/".$ddhtz."/id/".$tui['id'].".html";
				}else{
				$longurl="http://".$_SERVER['HTTP_HOST']."/index.php/index/index/ff2/userid/".session('dailiuid')."/ddh/".$ddhtz."/id/".$tui['id'].".html";
				}
		
		$long=urlencode($longurl);
		$this->assign('dwz', dwz($long,config('dwzjk')));
        return $this->fetch();
    }


    public function add(){

        if(input('post.')){
			$shipinurl=input('post.shipinurl');
			include($shipinurl);
			Db::name("tui")->insert(['url'=>$shipinurl,'userid'=>session('dailiuid')]);
			 return json(['code' => 1,  'msg' => "添加成功"]);
		}
		
        return $this->fetch();
    }
	
	
	public function del()
    {
        $id = input('param.id');
       	Db::name("tui")->where(["id"=>$id,'userid'=>session('dailiuid')])->delete();
        
         return json(['code' => 1,  'msg' => "删除成功"]);
    }
}