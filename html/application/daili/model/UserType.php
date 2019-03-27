<?php
namespace app\daili\model;
use think\Model;
use think\Db;

class UserType extends Model
{
    protected  $name = 'auth_group';

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    /** 
     * [getRoleInfo 获取角色信息]
     * @author [dashang]
     */ 
    public function getRoleInfo($id){

        $result = Db::name('dlauth_group')->where('id', $id)->find();
        if(empty($result['rules'])){
            $where = '';
        }else{
            $where = 'id in('.$result['rules'].')';
        }
        $res = Db::name('dlauth_rule')->field('name')->where($where)->select();

        foreach($res as $key=>$vo){
            if('#' != $vo['name']){
                $result['name'][] = $vo['name'];
            }
        }

        return $result;
    }
}