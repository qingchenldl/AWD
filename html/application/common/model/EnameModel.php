<?php

namespace app\common\model;
use think\Model;
use think\Db;

class EnameModel extends Model
{
    protected $name = 'ename';

   
    public function getEnamesByWhere($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }

     public function getOneEname($id)
    {
        return $this->where('id', $id)->find();
    }
   
    public function insertEname($param)
    {
        try{
            $result = $this->validate('EnameValidate')->allowField(true)->save($param);
            if(false === $result){            
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'域名【'.$param['ename'].'】添加成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '添加域名成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑管理员信息
     * @param $param
     */
    public function editEname($param)
    {
        try{
            $result =  $this->validate('EnameValidate')->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){            
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'域名【'.$param['ename'].'】编辑成功',1);
                return ['code' => 1, 'data' => '', 'msg' => '编辑域名成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


   

   
    public function delEname($id)
    {
        try{

            $this->where('id', $id)->delete();
            Db::name('auth_group_access')->where('uid', $id)->delete();
            writelog(session('uid'),session('username'),'管理员【'.session('username').'】删除域名成功(ID='.$id.')',1);
            return ['code' => 1, 'data' => '', 'msg' => '删除域名成功'];

        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
}