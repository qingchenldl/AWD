<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class KlModel extends Model
{
    protected $name = 'kl';  

    public function getKouliangByWhere($map, $Nowpage, $limits)
    {

        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }


    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }



   


   



  

    public function delUser($id)
    {
        try{

            $this->where('id', $id)->delete();
            Db::name('auth_group_access')->where('uid', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];

        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    public function delKouliang($id)
    {
        try{
           
            $this->where(['id' => $id])->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


}