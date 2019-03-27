<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class PayModel extends Model
{
    protected $name = 'pay';  

    public function getPayByWhere($map, $Nowpage, $limits)
    {

        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }


    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }
	
	public function dakuan($id){
		try{
			
			
			
            $this->where(['id'=>['in',$id]] )->update(['zt'=>"已支付"]);
            return ['code' => 1, 'data' => '', 'msg' => '确认成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
	}


   

}