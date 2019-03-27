<?php
namespace app\daili\controller;
use think\Controller;
use think\File;
use think\Request;

class Upload extends Base
{
	//ͼƬ�ϴ�
    public function upload(){
       $file = request()->file('file');
       $info = $file->move(ROOT_PATH  . DS . 'uploads/images');
       if($info){
            echo "success";
        }else{ 
            echo $file->getError();
        }
    }


    //��Աͷ���ϴ�
    public function uploadface(){
      
       $file = request()->file('file');
    
       $info = $file->move(ROOT_PATH  . DS . 'uploads/face');

       if($info){
            echo "success";
        }else{
            echo $file->getError();
        }
    }
	
	
	public function uploadshipin(){
      
       $file = request()->file('file');
	   if(config('fbspsz')!=1){
		   echo json_encode(['code'=>0,"msg"=>"û��Ȩ��"]);
		   exit;
	   }
       $info = $file->move(ROOT_PATH  . DS . 'uploads/shipin');

       if($info){
            echo "success";
        }else{
            echo json_encode(["code"=>0,"msg"=>$file->getError()]);
        }
    }

}