<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class GonggaoModel extends Model
{
    protected $name = 'gonggao';
    protected $autoWriteTimestamp = true;
    /**
     * 根据条件获取列表信息
     * @param $where
     * @param $Nowpage
     * @param $limits
     */
    public function getGonggaoAll($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage,$limits)->order('id desc')->select();     
    }

    /**
     * 插入信息
     * @param $param
     */
    public function insertGonggao($param)
    {
        try{
            $result = $this->validate('GonggaoValidate')->allowField(true)->save($param);
            if(false === $result){       
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加公告成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑信息
     * @param $param
     */
    public function editGonggao($param)
    {
        try{

            $result = $this->validate('GonggaoValidate')->allowField(true)->save($param, ['id' => $param['id']]);

            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑公告成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 根据id获取一条信息
     * @param $id
     */
    public function getOneGonggao($id)
    {
        return $this->where('id', $id)->find();
    }


    /**
     * 删除信息
     * @param $id
     */
    public function delGonggao($id)
    {
        try{
            
            $this->where(['id' => $id])->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除公告成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}