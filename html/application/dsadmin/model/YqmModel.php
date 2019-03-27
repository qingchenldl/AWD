<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class YqmModel extends Model
{
    protected $name = 'yqm';  

    public function getYqmByWhere($map, $Nowpage, $limits)
    {

        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }


    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }



    public function insertYqm($param)
    {
        try{
			
			if(empty($param)){
				$param=['userid'=>'admin','shijian'=>date('Y-m-d H:i:s' ,time()),'zt'=>'未使用','yqm'=>random(2).uniqid()];
			}
			if(!empty($param['userid'])){
				$param=['userid'=>$param['userid'],'shijian'=>date('Y-m-d H:i:s' ,time()),'zt'=>'未使用','yqm'=>random(2).uniqid()];
			}
            $result = $this->validate('YqmValidate')->allowField(true)->save($param);
			
			
			
			
            if(false === $result){            
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
	
	public function insertduoYqm($num)
    {
        try{
			
			for($i=0;$i<$num;$i++){

				$param=['userid'=>session('dailiuid'),'shijian'=>date('Y-m-d H:i:s' ,time()),'zt'=>'未使用','yqm'=>random(2).uniqid(rand(1,10000)).rand(10,99)];

                
                $this->allowField(true)->insert($param);
			}
			
			
			
            $this->allowField(true)->insertAll($param);
			
			
			return ['code' => 1, 'data' => '', 'msg' => '购买成功'];
			
            
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
	

    public function editYqm($param)
    {
        try{
            $result =  $this->validate('YqmValidate')->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){            
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    public function getOneYqm($id)
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


    public function delYqm($id)
    {
        try{
           
            $this->where(['id' => $id])->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


}