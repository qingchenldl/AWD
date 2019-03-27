<?php
namespace app\daili\controller;
use think\Config;
use think\Loader;
use think\Db;

class Index extends Base
{
    public function index()
    {
		
		
		return $this->fetch('/index');	
    }

    public function indexPage()
    {
         
		
		$day=date("Y-m-d");
		$zuori=date("Y-m-d",strtotime("$day-1 day"));
		$userid=session('dailiuid');
		
		$jrddbs=Db::name("dingdan")->where(['userid'=>$userid,'shijian'=>['like',"%".$day."%"]])->count();
		$this->assign('jrddbs', $jrddbs);
		
		$jrddje=Db::name("dingdan")->where(['userid'=>$userid,'shijian'=>['like',"%".$day."%"]])->sum('money');
		$this->assign('jrddje', empty($jrddje)?0:$jrddje);
		
		$zrddbs=Db::name("dingdan")->where(['userid'=>$userid,'shijian'=>['like',"%".$zuori."%"]])->count();
		$this->assign('zrddbs', $zrddbs);
		
		
		
		$zrddje=Db::name("dingdan")->where(['userid'=>$userid,'shijian'=>['like',"%".$zuori."%"]])->sum('money');
		$this->assign('zrddje', empty($zrddje)?0:$zrddje);
		
		$dingdanlist=Db::name("dingdan")->where(['userid'=>$userid])->order("id desc")->limit(5)->select();
		$this->assign('dingdanlist', $dingdanlist);
		
		$this->assign('ddcount',count($dingdanlist));
		
		
		$tixianlist=Db::name("pay")->where(['userid'=>$userid])->order("id desc")->limit(5)->select();
		$this->assign('tixianlist', $tixianlist);
		
		$this->assign('txcount',count($tixianlist));
		
		$tanchuang=Db::name('gonggao')->where(['tanchuang'=>1]) ->order('id desc')->find();
		
		$this -> assign('tanchuang', $tanchuang);
		
        return $this->fetch('index');
    }

}
