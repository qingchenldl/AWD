<?php
namespace app\dsadmin\controller;
use think\Db;
class Zhifu extends Base
{
    public function index(){
		
		
		if(input("post.")){
			$content=serialize(input("post."));
			Db::name("zhifu")->where(['id'=>1])->update(['content'=>$content]);
			
			return ['code'=>1,'msg'=>"修改成功！"];
		}
        
		$zhifu=Db::name("zhifu")->where(['id'=>1])->find();
		
		$content=unserialize($zhifu['content']);
		
		$this->assign("content",$content);
		
        return $this->fetch();
    }
}