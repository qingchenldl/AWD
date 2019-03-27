<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class TousuModel extends Model
{
    protected $name = 'ts';
    
    /**
     * 根据条件获取列表信息
     * @param $where
     * @param $Nowpage
     * @param $limits
     */
    public function getTousuAll($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage,$limits)->order('id desc')->select();     
    }

    /**
     * 插入信息
     * @param $param
     */
    public function insertTousu($param)
    {
        try{
            $result = $this->validate('TousuValidate')->allowField(true)->save($param);
            if(false === $result){       
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加投诉成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑信息
     * @param $param
     */
    public function editTousu($param)
    {
        try{

            $result = $this->validate('TousuValidate')->allowField(true)->save($param, ['id' => $param['id']]);

            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑投诉成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 根据id获取一条信息
     * @param $id
     */
    public function getOneTousu($id)
    {
        return $this->where('id', $id)->find();
    }


    /**
     * 删除信息
     * @param $id
     */
    public function jzTousu($id)
    {
        try{
            $map['zt']="禁止访问";
            $this->save($map, ['id' => $id]);
            return ['code' => 1, 'data' => '', 'msg' => '禁止访问成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
	
	 public function yxTousu($id)
    {
        try{
            $map['zt']="允许访问";
            $this->save($map, ['id' => $id]);
            return ['code' => 1, 'data' => '', 'msg' => '允许访问成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
	
	  public function delTousu($id)
    {
        try{
           
            $this->where("id",$id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除投诉成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
	
}