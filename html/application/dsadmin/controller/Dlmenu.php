<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\DlmenuModel;
use app\dsadmin\model\Nodedl;
use think\Db;

class Dlmenu extends Base
{	
    /**
     * [index 菜单列表]
     * @return [type] [description]
     * @author [dashang]
     */
    public function index()
    {
        $nav = new \org\Leftnav;
        $menu = new DlmenuModel();
        $admin_rule = $menu->getAllMenu();
        $arr = $nav::rule($admin_rule);
        $this->assign('admin_rule',$arr);
        return $this->fetch();
    }


    public function index2()
    {
       
        return $this->fetch();
    }

	
    /**
     * [add_rule 添加菜单]
     * @return [type] [description]
     * @author [dashang]
     */
	public function add_rule()
    {
        if(request()->isAjax()){
            $param = input('post.');           
            $menu = new DlmenuModel();
            $flag = $menu->insertMenu($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        return $this->fetch();
    }


    /**
     * [edit_rule 编辑菜单]
     * @return [type] [description]
     * @author [dashang]
     */
    public function edit_rule()
    {
        $menu = new DlmenuModel();
        if(request()->isPost()){
            $param = input('post.');
            $flag = $menu->editMenu($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $this->assign('menu',$menu->getOneMenu($id));
        return $this->fetch();
    }


    /**
     * [roleDel 删除角色]
     * @return [type] [description]
     * @author [dashang]
     */
    public function del_rule()
    {
        $id = input('param.id');
        $menu = new DlmenuModel();
        $flag = $menu->delMenu($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }



    /**
     * [ruleorder 排序]
     * @return [type] [description]
     * @author [dashang]
     */
    public function ruleorder()
    {
        if (request()->isAjax()){
            $param = input('post.');     
            $auth_rule = Db::name('dlauth_rule');
            foreach ($param as $id => $sort){
                $auth_rule->where(array('id' => $id ))->setField('sort' , $sort);
            }
            return json(['code' => 1, 'msg' => '排序更新成功']);
        }
    }


    /**
     * [rule_state 菜单状态]
     * @return [type] [description]
     * @author [dashang]
     */
    public function rule_state()
    {
        $id = input('param.id');
        $status = Db::name('auth_rule')->where('id',$id)->value('status');//判断当前状态
        if($status==1)
        {
            $flag = Db::name('auth_rule')->where('id',$id)->setField(['status'=>0]);
            return json(['code' => 1, 'data' => $flag['data'], 'msg' => '已禁止']);
        }
        else
        {
            $flag = Db::name('auth_rule')->where('id',$id)->setField(['status'=>1]);
            return json(['code' => 0, 'data' => $flag['data'], 'msg' => '已开启']);
        }
    
    } 

    public function giveAccess()
    {
        $param = input('param.');
        $node = new Nodedl();
        //获取现在的权限
        if('get' == $param['type']){
            $nodeStr = $node->getNodeInfo(1);
            return json(['code' => 1, 'data' => $nodeStr, 'msg' => 'success']);
        }
        //分配新权限
        if('give' == $param['type']){

            $doparam = [
                'id' => 1,
                'rules' => $param['rule']
            ];
            $menu = new DlmenuModel();
            $flag = $menu->editAccess($doparam);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
    }

   



}