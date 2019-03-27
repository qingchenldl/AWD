<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class SiyouModel extends Model
{
    protected $name = 'siyou';
    
   


    public function getSiyouByWhere($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }
    
    

    public function insertSiyou($param)
    {
        try{
        	
            $result = $this->allowField(true)->save($param);
            if(false === $result){             
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '视频添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

	public function fabushipin($data){
		
			
			if(config('dlspggpk')==1){
				$param=[];
				$param['shijian']=date("Y-m-d H:i:s");
				$param['url']=$data['url'];
				$param['name']=$data['name'];
				$param['photo']=$data['photo'];
				$pid=Db::name('gongyou')->insertGetId($param);
				
			}
			
			$array=[];
			$array['userid']=session('dailiuid');
			
			$array['name']=$data['name'];
			
			
			
			
			if($data['issuiji']=='1'){
				
					$array['money']=$data['guding'];
					$array['sj']=$data['guding'];
				
			}else{
				
					$array['money']=$data['end'];
					$array['sj']=$data['start'];
				
			}
			$array['zykey']=md5(session('dailiuid').uniqid());
			
			
			$array['url']=$data['url'];
			$array['shijian']=date("Y-m-d H:i:s");
			$array['photo']=$data['photo'];
			if(!empty($pid)){
				$array['pid']=$pid;
			}
			
			$result = $this->allowField(true)->save($array);
            if(false === $result){             
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '发布成功'];
            }
		
			
	}
	
	
	
	public function fabushipinwailian($data){
		
			
			if(config('dltjwlggpk')==1){
				$param=[];
				$param['shijian']=date("Y-m-d H:i:s");
				$param['url']=$data['url'];
				$param['name']=$data['name'];
				$param['photo']=$data['photo'];
				$pid=Db::name('gongyou')->insertGetId($param);
				
			}
			
			$array=[];
			$array['userid']=session('dailiuid');
			
			$array['name']=$data['name'];
			
			
			if($data['issuiji']=='1'){
				
					$array['money']=$data['guding'];
					$array['sj']=$data['guding'];
				
			}else{
				
					$array['money']=$data['end'];
					$array['sj']=$data['start'];
				
			}
			$array['zykey']=md5(session('dailiuid').uniqid());
			
			
			$array['url']=$data['url'];
			$array['photo']=$data['photo'];
			$array['shijian']=date("Y-m-d H:i:s");
			
			if(!empty($pid)){
				$array['pid']=$pid;
			}
			
			$result = $this->allowField(true)->save($array);
            if(false === $result){             
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '发布成功'];
            }
		
			
	}


    public function updateSiyou($param)
    {
        try{
            $result = $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){          
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '视频编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }




    public function getOneSiyou($id)
    {
        return $this->where('id', $id)->find();
    }




    public function delSiyou($id)
    {
        try{
            $this->where(['id'=>['in',$id]])->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
	
	public function delSiyoudaili($id)
    {
        try{
            $this->where(['id'=>['in',$id],'userid'=>session('dailiuid')])->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}
