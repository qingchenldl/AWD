<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\GonggaoModel;
use think\Db;

class Gonggao extends Base
{


    public function index(){

        $key = input('key');
        $map = [];
        $map['closed'] =0;
        if($key&&$key!=="")
        {
            $map['title'] = ['like',"%" . $key . "%"];          
        }             
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// ��ȡ������
        $count = Db('gonggao')->where($map)->count();//������ҳ��
        $allpage = intval(ceil($count / $limits));
        $gonggao = new GonggaoModel();
        $lists = $gonggao->getGonggaoAll($map, $Nowpage, $limits);    
        $this->assign('Nowpage', $Nowpage); //��ǰҳ
        $this->assign('allpage', $allpage); //��ҳ�� 
        $this->assign('val', $key);
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }


    public function add_gonggao()
    {
        if(request()->isAjax()){

            $param = input('post.');
            $param['closed'] = 0;
            $gonggao = new GonggaoModel();
            $flag = $gonggao->insertGonggao($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
       
        return $this->fetch();

    }


  
    public function edit_gonggao()
    {
        $gonggao = new GonggaoModel();
        if(request()->isPost()){
            
            $param = input('post.');
            $flag = $gonggao->editGonggao($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $this->assign('gonggao',$gonggao->getOneGonggao($id));
        return $this->fetch();
    }



    public function del_gonggao()
    {
        $id = input('param.id');
        $gonggao = new GonggaoModel();
        $flag = $gonggao->delGonggao($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }



    public function gonggao_state()
    { 
        $id=input('param.id');
        $status = Db::name('gonggao')->where(array('id'=>$id))->value('status');//�жϵ�ǰ״̬���
        if($status==1)
        {
            $flag = Db::name('gonggao')->where(array('id'=>$id))->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '���ö�']);
        }
        else
        {
            $flag = Db::name('gonggao')->where(array('id'=>$id))->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '���ö�']);
        }
    
    } 
	public function gonggao_tc()
    {
        $id=input('param.id');
        $status = Db::name('gonggao')->where(array('id'=>$id))->value('tanchuang');//�жϵ�ǰ״̬���
        if($status==1)
        {
            $flag = Db::name('gonggao')->where(array('id'=>$id))->setField(['tanchuang'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '������']);
        }
        else
        {
            $flag = Db::name('gonggao')->where(array('id'=>$id))->setField(['tanchuang'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '����']);
        }
    
    } 



}