<?php
use think\Db;
use taobao\AliSms;


/**
 * 字符串截取，支持中文和其他编码
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
	if (function_exists("mb_substr"))
		$slice = mb_substr($str, $start, $length, $charset);
	elseif (function_exists('iconv_substr')) {
		$slice = iconv_substr($str, $start, $length, $charset);
		if (false === $slice) {
			$slice = '';
		}
	} else {
		$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("", array_slice($match[0], $start, $length));
	}
	return $suffix ? $slice . '...' : $slice;
}

/**
 * 调用系统的API接口方法（静态方法）
 * api('User/getName','id=5'); 调用公共模块的User接口的getName方法
 * api('Admin/User/getName','id=5');  调用Admin模块的User接口
 * @param  string  $name 格式 [模块名]/接口名/方法名
 * @param  array|string  $vars 参数
 */
function api($name,$vars=array()){
    $array     = explode('/',$name);
    $method    = array_pop($array);
    $classname = array_pop($array);
    $module    = $array? array_pop($array) : 'common';
    $callback  = 'app\\'.$module.'\\Api\\'.$classname.'Api::'.$method;
    if(is_string($vars)) {
        parse_str($vars,$vars);
    }
    return call_user_func_array($callback,$vars);
}


/**
 * 获取配置的分组
 * @param string $group 配置分组
 * @return string
 */
function get_config_group($group=0){
    $list = config('config_group_list');
    return $group?$list[$group]:'';
}

/**
 * 获取配置的类型
 * @param string $type 配置类型
 * @return string
 */
function get_config_type($type=0){
    $list = config('config_type_list');  
    return $list[$type];
}


/**
 * 发送短信(参数：签名,模板（数组）,模板ID，手机号)
 */
function sms($signname='',$param=[],$code='',$phone)
{
    $alisms = new AliSms();
    $result = $alisms->sign($signname)->data($param)->code($code)->send($phone);
    return $result['info'];
}


/**
 * 循环删除目录和文件
 * @param string $dir_name
 * @return bool
 */
function delete_dir_file($dir_name) {
    $result = false;
    if(is_dir($dir_name)){
        if ($handle = opendir($dir_name)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    if (is_dir($dir_name . DS . $item)) {
                        delete_dir_file($dir_name . DS . $item);
                    } else {
                        unlink($dir_name . DS . $item);
                    }
                }
            }
            closedir($handle);
            if (rmdir($dir_name)) {
                $result = true;
            }
        }
    }

    return $result;
}



//时间格式化1
function formatTime($time) {
    $now_time = time();
    $t = $now_time - $time;
    $mon = (int) ($t / (86400 * 30));
    if ($mon >= 1) {
        return '一个月前';
    }
    $day = (int) ($t / 86400);
    if ($day >= 1) {
        return $day . '天前';
    }
    $h = (int) ($t / 3600);
    if ($h >= 1) {
        return $h . '小时前';
    }
    $min = (int) ($t / 60);
    if ($min >= 1) {
        return $min . '分钟前';
    }
    return '刚刚';
}

//时间格式化2
function pincheTime($time) {
     $today  =  strtotime(date('Y-m-d')); //今天零点
      $here   =  (int)(($time - $today)/86400) ; 
      if($here==1){
          return '明天';  
      }
      if($here==2) {
          return '后天';  
      }
      if($here>=3 && $here<7){
          return $here.'天后';  
      }
      if($here>=7 && $here<30){
          return '一周后';  
      }
      if($here>=30 && $here<365){
          return '一个月后';  
      }
      if($here>=365){
          $r = (int)($here/365).'年后'; 
          return   $r;
      }
     return '今天';
}


function dwz($url,$type){
		$url2='';
		
		switch($type){
			case 1:
			$html = file_get_contents("http://980.so/api.php?format=json&url=" . $url);
			$result = json_decode($html, true);
			
			$url2=$result['url'];
			break;
			case 2:
			$html = file_get_contents("http://suo.im/api.php?format=json&url=" . $url);
			$result = json_decode($html, true);
			$url2=$result['url'];
			break;
			
			case 3:
			$html = file_get_contents("http://api.c7.gg/api.php?format=json&url=" . $url);
			$result = json_decode(trim($html, chr(239) . chr(187) . chr(191)), true);
			$url2=$result['url'];
			break;
			
			case 4:
			$html = file_get_contents("http://api.kks.me/api.php?format=json&url=" . $url);
			$result = json_decode(trim($html, chr(239) . chr(187) . chr(191)), true);
			$url2=$result['url'];
			break;
			
			case 5:
			$html = file_get_contents("http://api.rrd.me/api.php?format=json&url=" . $url);
			$result = json_decode(trim($html, chr(239) . chr(187) . chr(191)), true);
			$url2=$result['url'];
			break;
			
			case 6:
			$html = file_get_contents("http://api.uee.me/api.php?format=json&url=" . $url);
			$result = json_decode(trim($html, chr(239) . chr(187) . chr(191)), true);
			$url2=$result['url'];
			break;
			
			case 7:
			
			$url2=file_get_contents("http://6du.in/?is_api=1&lurl=" . $url);
			break;
			
			case 8:
			$html = file_get_contents("http://mrw.so/api.php?format=json&url=" . $url);
			$result = json_decode(trim($html, chr(239) . chr(187) . chr(191)), true);
			$url2=$result['url'];
			break;
			
			case 9:
			$html = file_get_contents("http://api.u6.gg/api.php?url=" . $url);
			$result = substr($html, 9);
			$url2=$result;
			break;
			
			case 10:
			$url2 = file_get_contents("http://api.t.sina.com.cn/short_url/shorten.json?source=3271760578&url_long=" . $url);
			$json = json_decode($url2);
			$url2 = $json[0]->url_short;
			break;
			default:
			break;
			
		}
		return $url2;
	}
	
	
	function random($length=6, $type='string', $convert=0){
	    $config = array(
	        'number'=>'1234567890',
	        'letter'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
	        'string'=>'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
	        'all'=>'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
	    );
	    
	    if(!isset($config[$type])) $type = 'string';
	    $string = $config[$type];
	    
	    $code = '';
	    $strlen = strlen($string) -1;
	    for($i = 0; $i < $length; $i++){
	        $code .= $string{mt_rand(0, $strlen)};
	    }
	    if(!empty($convert)){
	        $code = ($convert > 0)? strtoupper($code) : strtolower($code);
	    }
	    return $code;
	}
	
	function is_mobile(){  
		$user_agent = $_SERVER['HTTP_USER_AGENT'];  
	  
		$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");  
		$is_mobile = false;  
		foreach ($mobile_agents as $device) {//这里把值遍历一遍，用于查找是否有上述字符串出现过  
		   if (stristr($user_agent, $device)) { //stristr 查找访客端信息是否在上述数组中，不存在即为PC端。  
				$is_mobile = true;  
				break;  
			}  
		}  
		return $is_mobile;  
	}  
	
	
	function writefile($fname, $str)
	{
		$fp = fopen($fname, "w");
		fputs($fp, $str);
		fclose($fp);
	}
	
	function randColor()
	{
		$colors = array();
		for ($i = 0; $i < 6; $i++) {
			$colors[] = dechex(rand(0, 15));
		}
		return implode('', $colors);
	}
	
	function is_HTTPS(){  //判断是不是https
            if(!isset($_SERVER['HTTPS']))  return FALSE;  
            if($_SERVER['HTTPS'] === 1){  //Apache  
                return TRUE;  
            }elseif($_SERVER['HTTPS'] === 'on'){ //IIS  
                return TRUE;  
            }elseif($_SERVER['SERVER_PORT'] == 443){ //其他  
                return TRUE;  
            }  
                return FALSE;  
   }  
   
   function get_ip_info($ip = '')
	{
		
		$res = @file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip);
		if (empty($res)) {
			return false;
		}
		
		$json = json_decode($res, true);
		
		
		return $json;
	}

	function getcurl($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        }
        
        $postUrl = $url;
        $curlPost = $param;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        
        return $data;
    }

    function getIP()
{
	static $realip;
	if (isset($_SERVER)) {
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else {
			if (isset($_SERVER["HTTP_CLIENT_IP"])) {
				$realip = $_SERVER["HTTP_CLIENT_IP"];
			} else {
				$realip = $_SERVER["REMOTE_ADDR"];
			}
		}
	} else {
		if (getenv("HTTP_X_FORWARDED_FOR")) {
			$realip = getenv("HTTP_X_FORWARDED_FOR");
		} else {
			if (getenv("HTTP_CLIENT_IP")) {
				$realip = getenv("HTTP_CLIENT_IP");
			} else {
				$realip = getenv("REMOTE_ADDR");
			}
		}
	}
	return $realip;
}