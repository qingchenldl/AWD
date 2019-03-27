<?php
namespace app\daili\model;
use think\Model;
use think\Db;

class UserType extends Model
{
    protected  $name = 'auth_group';

    // �����Զ�д��ʱ����ֶ�
    protected $autoWriteTimestamp = true;
    /** 
     * [getRoleInfo ��ȡ��ɫ��Ϣ]
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