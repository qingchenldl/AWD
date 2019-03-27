<?php
namespace app\dsadmin\controller;
use app\common\model\EnameModel;
use think\Db;

class Ename extends Base
{

   
    public function index(){

        $key = input('key');
        $map = [];
        if($key&&$key!=="")
        {
            $map['ename'] = ['like',"%" . $key . "%"];          
        }       
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('ename')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $ename = new EnameModel();
        $lists = $ename->getEnamesByWhere($map, $Nowpage, $limits);
       
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数 
        $this->assign('val', $key);
        if(input('get.page'))
        {
            return json($lists);
        }
        return $this->fetch();
    }


   
    public function add()
    {
        if(request()->isAjax()){

            $param = input('post.');
           
            $ename = new EnameModel();
            $flag = $ename->insertEname($param);
            
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

       
        return $this->fetch();
    }


   
    public function edit()
    {
        $ename = new EnameModel();

        if(request()->isAjax()){

            $param = input('post.');
            
            $flag = $ename->editEname($param);

            
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        
        $this->assign([
            'ename' => $ename->getOneEname($id),
        ]);
        return $this->fetch();
    } 


    
    public function del()
    {
        $id = input('param.id');
        $role = new EnameModel();
        $flag = $role->delEname($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }



   
    public function status()
    {
        $id = input('param.id');
        $status = Db::name('ename')->where('id',$id)->value('status');//判断当前状态情况
        if($status==1)
        {
            $flag = Db::name('ename')->where('id',$id)->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('ename')->where('id',$id)->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }
    
    }

}