<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\MemberModel;
use think\Db;

class Member extends Base
{


  


   
   
    public function index(){

        $key = input('key');

        $map['closed'] = 0;//0δɾ����1��ɾ��
        if($key&&$key!=="")
        {
            $map['id|account|nickname|qq|weixin'] = ['=', $key ];          
        }

        $member = new MemberModel();    

        $Nowpage = input('get.page') ? input('get.page'):1;

        $limits = 10;// ��ȡ������
        $count = $member->getAllCount($map);//������ҳ��

        $allpage = intval(ceil($count / $limits));  
       
        $lists = $member->getMemberByWhere($map, $Nowpage, $limits);   

        $this->assign('Nowpage', $Nowpage); //��ǰҳ
        $this->assign('allpage', $allpage); //��ҳ�� 
        $this->assign('val', $key);
        if(input('get.page'))
        {
            return json($lists);
        }

        return $this->fetch();
    }


   
    public function add_member()
    {
        if(request()->isAjax()){

            $param = input('post.');
           unset($param['file']);
            $member = new MemberModel();
            $flag = $member->insertMember($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

       
        return $this->fetch();
    }


   
    public function edit_member()
    {
        $member = new MemberModel();
        if(request()->isAjax()){
            $param = input('post.');
			
            $flag = $member->editMember($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
       
        $this->assign([
            'member' => $member->getOneMember($id),
           
        ]);
        return $this->fetch();
    }


   
    public function del_member()
    {
        $id = input('param.id');
        $member = new MemberModel();
        $flag = $member->delMember($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }



   
    public function member_status()
    {
        $id = input('param.id');
        $status = Db::name('member')->where('id',$id)->value('status');//�жϵ�ǰ״̬��� 
        if($status==1)
        {
            $flag = Db::name('member')->where('id',$id)->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '�ѽ�ֹ']);
        }
        else
        {
            $flag = Db::name('member')->where('id',$id)->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '�ѿ���']);
        }
    
    }

}