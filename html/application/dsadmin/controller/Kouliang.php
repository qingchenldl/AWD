<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\KouliangModel;
use app\dsadmin\model\KlModel;
use think\Db;
class Kouliang extends Base
{
    public function lists(){
        $key = input('key');
        $riqi= input('riqi');
        $map=[];
        if($key){
            $map['userid']=$key;
        }
        if($riqi){
            $map['shijian']=['like','%'.$riqi.'%'];
        }
        $order = new KlModel();    
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;
        $count = $order->getAllCount($map);
        $allpage = intval(ceil($count / $limits));  
        $lists = $order->getKouliangByWhere($map, $Nowpage, $limits);   
        $this->assign('Nowpage', $Nowpage); 
        $this->assign('allpage', $allpage); 
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
            $zuori=date('Y-m-d',strtotime($day." -1 day"));
            
            $this->assign('day', $day);
            $this->assign('zuori', $zuori);
        }else{
            $day=date('Y-m-d');
            $zuori=date('Y-m-d',strtotime($day.' -1 day'));
        }
        $map['shijian']=['like','%'.$day.'%'];
        $daydd=Db::name('kl')->where($map)->count();
        $this->assign('daydd', $daydd);
        $money1=Db::name('kl')->where($map)->sum('money');
        $this->assign('money1', $money1);
        $map['shijian']=['like','%'.$zuori.'%'];
        $zdd=Db::name('kl')->where($map)->count();
        $this->assign('zdd', $zdd);
        $map=[];
         $map['shijian']=['like','%'.$zuori.'%'];
        $money2=Db::name('kl')->where($map)->sum('money');
        $this->assign('money2', $money2);
        
        $map=[];
        if(!empty($key)){
            $map['userid']=$key;
        }
        $zong=Db::name('kl')->where($map)->count();
        $this->assign('zong', $zong);
        
        $money3=Db::name('kl')->where($map)->sum('money');
        $this->assign('money3', $money3);
        
        
        return $this->fetch("list");
    }
    public function index(){
        $key = input('key');
		$map=[];
        $kouliang = new KouliangModel();    
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;
        $count = $kouliang->getAllCount($map);//计算总页面
        $allpage = intval(ceil($count / $limits));  
        $lists = $kouliang->getKouliangByWhere($map, $Nowpage, $limits);   
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
        if(input('get.page')) 
        {
            return json($lists);
        }

        return $this->fetch("kouliang/index");
    }
	
    public function add_kouliang()
    {
        if(request()->isAjax()){

            $param = input('post.');
           	if(intval($param['cs'])<1){
           		$this->error("初始值不能小于1");
           	}
           	if(intval($param['ns'])<=1){
           		$this->error("倒数值不能小于1");
           	}
            $kouliang = new KouliangModel();
            $flag = $kouliang->insertKouliang($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
		
		$memberlist=Db::name('member')->select();
        $this->assign([
            'memberlist' => $memberlist
        ]);
        return $this->fetch();
    }
    public function edit_kouliang()
    {
        $kouliang = new KouliangModel();
        if(request()->isAjax()){
            $param = input('post.');
            if(intval($param['cs'])<1){
           		$this->error("初始值不能小于1");
           	}
           	if(intval($param['ns'])<=1){
           		$this->error("倒数值不能小于1");
           	}
            $flag = $kouliang->editKouliang($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
       $memberlist=Db::name('member')->select();
       
        $this->assign([
            'kouliang' => $kouliang->getOneKouliang($id),
            'memberlist' => $memberlist
        ]);
        return $this->fetch();
    }
    public function del_kouliang()
    {
        $id = input('param.id');
        $kouliang = new KouliangModel();
        $flag = $kouliang->delKouliang($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
    public function kouliang_status()
    {
        $id = input('param.id');
        $status = Db::name('kouliang')->where('id',$id)->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('kouliang')->where('id',$id)->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('kouliang')->where('id',$id)->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }
    
    }

}