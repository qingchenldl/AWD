<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\GongyouModel;
use think\Db;
class Gongyou extends Base
{


    public function index(){

        $key = input('key');
        $map = [];
        if($key&&$key!==""){
            $map['name'] = ['like',"%" . $key . "%"];           
        }       
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// ��ȡ������
        $count = Db::name('gongyou')->where($map)->count();//������ҳ��
        $allpage = intval(ceil($count / $limits));
        $gongyou = new GongyouModel();
        $lists = $gongyou->getGongyouByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //��ǰҳ
        $this->assign('allpage', $allpage); //��ҳ��
        $this->assign('count', $count); 
        $this->assign('val', $key);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }


    public function add()
    {
        if(request()->isAjax()){

            $param = input('post.');
            $gongyou = new GongyouModel();
            $flag = $gongyou->insertGongyou($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

       
        return $this->fetch();
    }
	
	
	public function shangchuan()
    {
       

       
        return $this->fetch();
    }


    public function edit()
    {
        $gongyou = new GongyouModel();
        
        if(request()->isAjax()){

            $param = input('post.');         
            $flag = $gongyou->updateGongyou($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
       
        $this->assign('gongyou',$gongyou->getOneGongyou($id));
        return $this->fetch();
    }



    public function del()
    {
        $id = input('param.id');
        $cate = new GongyouModel();
        $flag = $cate->delGongyou($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }








  

}