<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\Node;
use think\Controller;
use think\Db;
class Base extends Controller
{
    public function _initialize()
    {
		
        if(!session("uid")||!session("username")){
            $this->redirect(url("login/index"));

        }
       
        $auth = new \com\Auth();   
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        $url        = $module."/".$controller."/".$action;
		
		
		
		
        //跳过检测以及主页权限
        if(session("uid")!=1){
            if(!in_array($url, ["dsadmin/index/index","dsadmin/index/indexpage"])){
				
			
				
                if(!$auth->check($url,session("uid"))){
                    $this->error("抱歉，您没有操作权限");
                }
            }
        }
        
        $node = new Node();
        $this->assign([
            "username" => session("username"),
            "portrait" => session("portrait"),
            "rolename" => session("rolename"),
            "menu" => $node->getMenu(session("rule"))
        ]);
        
        $config = cache("db_config_data");

        if(!$config){            
            $config = api("Config/lists");                          
            cache("db_config_data",$config);
        }
        config($config); 

        if(config("web_site_close") == 0 && session("uid") !=1 ){
            $this->error("站点已经关闭，请稍后访问~");
        }

        if(config("admin_allow_ip") && session("uid") !=1 ){
           
            if(in_array(request()->ip(),explode(",",config("admin_allow_ip")))){
                return $this->fetch("/Public/404");
            }
        }

    }
	
	public function _empty($name)
    {
        return $this->fetch("/Public/404");
    }

	public function shengji(){
		$newbanben=getcurl('http://42.51.45.31:1231/index/api/shengji.html?ename='.$_SERVER['HTTP_HOST']."&banben=".config("appbanben"));
        
        $newbanben=json_decode($newbanben,true);
        $url=$newbanben['shengjiurl'];
        $save_dir = "./";
        $filename ="shengji.zip";
        $this->getFile($url, $save_dir, $filename,1);
        $res=$this->unzip_file("./shengji.zip","./");
        unlink("./shengji.zip");
        if(file_exists("./shengji.sql"))
        {
            $dsadmin_str=file_get_contents('./shengji.sql');
             unlink("./shengji.sql");
            $sql_array=preg_split("/;[\r\n]+/", str_replace('ds_',config("database.prefix"),$dsadmin_str));
           
            foreach ($sql_array as $k => $v) {
                
                if (!empty($v)) {

                    Db::query($v);
                }
            }

        }

       $this->success('更新成功！', url("index/indexpage"));
	}


    public function unzip_file($file, $destination){  
    // 实例化对象  
    $zip = new \ZipArchive() ;  
    //打开zip文档，如果打开失败返回提示信息  
    if ($zip->open($file) !== TRUE) {  
        die ("请查看配置文件解压扩展（php_zip）是否打开");  
    }  
    //将压缩文件解压到指定的目录下  
    $zip->extractTo($destination);  
    //关闭zip文档  
    $zip->close();  
       
    }  



    public function getFile($url, $save_dir = '', $filename = '', $type = 0) {
        if (trim($url) == '') {
            return false;
        }
        if (trim($save_dir) == '') {
            $save_dir = './';
        }
        if (0 !== strrpos($save_dir, '/')) {
            $save_dir.= '/';
        }
        //创建保存目录
        if (!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {
            return false;
        }
        //获取远程文件所采用的方法 
        if ($type) {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $content = curl_exec($ch);
            curl_close($ch);
        } else {
            ob_start();
            readfile($url);
            $content = ob_get_contents();
            ob_end_clean();
        }
        //echo $content;
        $size = strlen($content);
        //文件大小
        $fp2 = @fopen($save_dir . $filename, 'a');
        fwrite($fp2, $content);
        fclose($fp2);
        unset($content, $url);
        return array(
            'file_name' => $filename,
            'save_path' => $save_dir . $filename,
            'file_size' => $size
        );
    }

	
}