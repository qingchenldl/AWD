<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class OrderModel extends Model
{
    protected $name = 'dingdan';  

    public function getOrderByWhere($map, $Nowpage, $limits)
    {

        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }


    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }


    public function getOrderByWhere2($map,$map2, $Nowpage, $limits)
    {

        return $this->where($map)->where($map2)->page($Nowpage, $limits)->order('id desc')->select();
    }


    public function getAllCount2($map,$map2)
    {
        return $this->where($map)->where($map2)->count();
    }



   

}