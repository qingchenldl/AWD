<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class GongyouModel extends Model
{
    protected $name = 'gongyou';
    
   


    public function getGongyouByWhere($map, $Nowpage, $limits)
    {
        return $this->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }
    
    

    public function insertGongyou($param)
    {
        try{
			$param['shijian']=date("Y-m-d H:i:s");
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




    public function updateGongyou($param)
    {
        try{
            $result = $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){          
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
				
				
				Db::name('siyou')->where(['pid'=>$param['id']])->update(['name'=>$param['name'],'url'=>$param['url'],'photo'=>$param['photo']]);
				
                return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }




    public function getOneGongyou($id)
    {
        return $this->where('id', $id)->find();
    }


	public function addsiyou($data){
		$gongyou= $this->where(['id'=>['in',$data['id']]])->select();
		$array=[];
		$i=0;
		$siyoucount=Db::name('siyou')->where(['userid'=>session('dailiuid')])->count();
		
		if($siyoucount+1>config('dlzdsps')){
				 return ['code' => 0, 'data' => '', 'msg' => "视频数超过限制"];
		}
		
		foreach($gongyou as $k=>$v){
			$siyou=Db::name('siyou')->where(['userid'=>session('dailiuid'),'pid'=>$v['id']])->find();
		
			if(empty($siyou)&&$siyoucount+1+$i<=config('dlzdsps')){
			
				$array[$i]['userid']=session('dailiuid');
				if($data['isduoge']==0){
					$array[$i]['name']=$data['title'];
				}else{
					$array[$i]['name']=$v['name'];
				}
				
				if($data['issuiji']=='1'){
					
						$array[$i]['money']=$data['guding'];
						$array[$i]['sj']=$data['guding'];
					
				}else{
					
						$array[$i]['money']=$data['end'];
						$array[$i]['sj']=$data['start'];
					
				}
				$array[$i]['zykey']=md5(session('dailiuid').uniqid().random(2));
				
				$array[$i]['userid']=session('dailiuid');
				$array[$i]['url']=$v['url'];
				$array[$i]['photo']=$v['photo'];
				$array[$i]['shijian']=date("Y-m-d H:i:s");
				$array[$i]['pid']=$v['id'];
				$i++;
			}
		}
		Db::name('siyou')->insertAll($array);
		
		return ['code' => 1, 'data' => '', 'msg' => '发布成功'];
	}

    public function delGongyou($id)
    {
        try{
            $this->where(['id'=>['in',$id]])->delete();
			Db::name('siyou')->where(['pid'=>['in',$id]])->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}