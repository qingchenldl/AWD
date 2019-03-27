<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class TupianModel extends Model
{
    protected $name = 'tupian';  
   

    /**
     * 根据搜索条件获取用户列表信息
     */
    public function getTupianByWhere($map, $Nowpage, $limits)
    {

        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的用户数量
     * @param $where
     */
    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }


    /**
     * 插入信息
     */
    public function insertTupian($param)
    {
        try{
            $result = $this->allowField(true)->save($param);
			
			
			
			
            if(false === $result){            
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

   


    
   


    public function delTupian($id)
    {
        try{
           
            $this->where(['id' => $id])->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


}