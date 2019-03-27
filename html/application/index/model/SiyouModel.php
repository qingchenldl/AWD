<?php

namespace app\index\model;
use think\Model;
use think\Db;

class SiyouModel extends Model
{
    protected $name = 'siyou';
    
   


    public function getSiyouByWhere($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }
    
    

   

	


    public function getOneSiyou($id)
    {
        return $this->where('id', $id)->find();
    }




   

}