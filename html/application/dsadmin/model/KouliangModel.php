<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class KouliangModel extends Model
{
    protected $name = 'kou';  

    public function getKouliangByWhere($map, $Nowpage, $limits)
    {

        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }


    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }



    public function insertKouliang($param)
    {
        try{
            $result = $this->validate('KouliangValidate')->allowField(true)->save($param);
			
			
			
			
            if(false === $result){            
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    public function editKouliang($param)
    {
        try{
            $result =  $this->validate('KouliangValidate')->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){            
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    public function getOneKouliang($id)
    {
        return $this->where('id', $id)->find();
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