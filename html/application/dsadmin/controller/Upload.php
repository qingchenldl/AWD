<?php
namespace app\dsadmin\controller;
use think\Controller;
use think\File;
use think\Request;

class Upload extends Base
{
	//图片上传
    public function upload(){
       $file = request()->file('file');
       $info = $file->move(ROOT_PATH  . DS . 'uploads/images');
       if($info){
            echo $info->getSaveName();
        }else{
            echo $file->getError();
        }
    }


    //会员头像上传
    public function uploadface(){
      
       $file = request()->file('file');

       $info = $file->move(ROOT_PATH  . DS . 'uploads/face');

       if($info){
            echo $info->getSaveName();
        }else{
            echo $file->getError();
        }
    }
	
	
	public function uploadshipin(){
      
       $file = request()->file('file');

       $info = $file->move(ROOT_PATH  . DS . 'uploads/shipin');

       if($info){
            echo $info->getSaveName();
        }else{
            echo json_encode(["code"=>0,"msg"=>$file->getError()]);
        }
    }

}