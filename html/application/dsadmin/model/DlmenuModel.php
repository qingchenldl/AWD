<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db; 
class DlmenuModel extends Model
{
    protected $name = 'dlauth_rule';
    
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;


    /**
     * [getAllMenu 获取全部代理菜单]
     * @author [dashang]
     */
    public function getAllMenu()
    {
        return $this->order('id asc')->select();       
    }


    /**
     * [insertMenu 添加代理菜单]
     * @author [dashang]
     */
    public function insertMenu($param)
    {
        try{
            $result = $this->save($param);
            if(false === $result){            
                writelog(session('uid'),session('username'),'用户【'.session('username').'】添加代理菜单失败',2);
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'用户【'.session('username').'】添加代理菜单成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '添加代理菜单成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    /**
     * [editMenu 编辑代理菜单]
     * @author [dashang]
     */
    public function editMenu($param)
    {
        try{
            $result =  $this->save($param, ['id' => $param['id']]);
            if(false === $result){
                writelog(session('uid'),session('username'),'用户【'.session('username').'】编辑代理菜单失败',2);
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'用户【'.session('username').'】编辑代理菜单成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '编辑代理菜单成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    /**
     * [getOneMenu 根据代理菜单id获取一条信息]
     * @author [dashang]
     */
    public function getOneMenu($id)
    {
        return $this->where('id', $id)->find();
    }



    /**
     * [delMenu 删除代理菜单]
     * @author [dashang]
     */
    public function delMenu($id)
    {
        try{
            $this->where('id', $id)->delete();
            writelog(session('uid'),session('username'),'用户【'.session('username').'】删除代理菜单成功',1);
            return ['code' => 1, 'data' => '', 'msg' => '删除代理菜单成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public function editAccess($param)
    {
        try{

            Db::name('dlauth_group')->update($param, ['id' => $param['id']]);
            return ['code' => 1, 'data' => '', 'msg' => '分配权限成功'];

        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

   

}