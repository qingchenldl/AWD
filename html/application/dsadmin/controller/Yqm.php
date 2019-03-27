<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\YqmModel;
use think\Db;

class Yqm extends Base
{


  


   
   
    public function index(){

        $key = input('key');

        
		$map=[];
        $yqm = new YqmModel();    

        $Nowpage = input('get.page') ? input('get.page'):1;

        $limits = 10;// 获取总条数
        $count = $yqm->getAllCount($map);//计算总页面

        $allpage = intval(ceil($count / $limits));  
       
        $lists = $yqm->getYqmByWhere($map, $Nowpage, $limits);   

        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
        if(input('get.page'))
        {
            return json($lists);
        }

        return $this->fetch();
    }


   
    public function add_yqm()
    {
        if(request()->isAjax()){

            $param = input('post.');
           
            $yqm = new YqmModel();
            $flag = $yqm->insertYqm($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
		
		$memberlist=Db::name('member')->select();
        $this->assign([
            'memberlist' => $memberlist
        ]);
        return $this->fetch();
    }


   
   


   
    public function del_yqm()
    {
        $id = input('param.id');
        $yqm = new YqmModel();
        $flag = $yqm->delYqm($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
	
	public function shengcheng(){
			$param=[];
            $yqm = new YqmModel();
            $flag = $yqm->insertYqm($param);
			 return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
	}

   
   

}