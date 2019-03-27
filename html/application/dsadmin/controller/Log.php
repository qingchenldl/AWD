<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\LogModel;
use think\Db;
use com\IpLocation;
 
class Log extends Base
{

    /**
     * [operate_log ������־]
     * @return [type] [description]
     * @author [dashang]
     */
    public function operate_log()
    {
        //exit(json_encode(array(array('name' => 'lunui', 'age'=> 26) )));
        $key = input('key');
        $map = [];
        if($key&&$key!==""){
            $map['admin_id'] =  $key;          
        }      
        $arr=Db::name("admin")->column("id,username"); //��ȡ�û��б�      
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// ��ȡ������
        $count = Db::name('log')->where($map)->count();//������ҳ��
        $allpage = intval(ceil($count / $limits));
        $lists = Db::name('log')->where($map)->page($Nowpage, $limits)->order('add_time desc')->select();       
        $Ip = new IpLocation('UTFWry.dat'); // ʵ������ ������ʾIP��ַ���ļ�
        foreach($lists as $k=>$v){
            $lists[$k]['add_time']=date('Y-m-d H:i:s',$v['add_time']);
            $lists[$k]['ipaddr'] = $Ip->getlocation($lists[$k]['ip']);
        }  
        $this->assign('Nowpage', $Nowpage); //��ǰҳ 
        $this->assign('allpage', $allpage); //��ҳ�� 
        $this->assign('count', $count);
        $this->assign("search_user",$arr);
        $this->assign('val', $key);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }


    /**
     * [del_log ɾ����־]
     * @return [type] [description]
     * @author [dashang]
     */
    public function del_log()
    {
        $id = input('param.id');
        $log = new LogModel();
        $flag = $log->delLog($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
 
}