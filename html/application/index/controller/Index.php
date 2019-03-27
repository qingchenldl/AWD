<?php
namespace app\index\controller;
use app\index\model\SiyouModel;
use think\Controller;
use think\Db;
use think;
class Index extends Controller
{
	public function _initialize()
    {
		$config = cache('db_config_data');

        if(!$config){            
            $config = api('Config/lists');                          
            cache('db_config_data',$config);
        }
        config($config); 
	}
	public function _empty($name)
    {
        return $this->fetch('/Public/404');
    }
    public function index()
    {
		
       
        $this->redirect(url("daili/index/index"));
    }
	
	public function ff(){
		$code=input("get.code");
		$ename=Db::name("ename")->where(['status'=>1])->order("id desc")->find();
		
		
		
		if(empty($ename)||config('ksymkg')==0){
			
			$this->redirect("http://".$_SERVER['HTTP_HOST']."/".config("ffhouzhui")."?code=".$code);
			
		}else{
			
			if(is_mobile()){
			
			$this->redirect("http://".$ename['ename']."/".config("ffhouzhui")."?code=".$code);
			}else{
				$this->redirect("http://www.qq.com");
			}
			
			
		}
		//print_r($ename);
	}

	public function ff2(){
		$userid=input("userid");
		$ddh=input("ddh");
		$id=input("id");
		$ename=Db::name("ename")->where(['status'=>1])->order("id desc")->find();
		
		
		
		if(empty($ename)||config('ksymkg')==0){
			
			$this->redirect("http://".$_SERVER['HTTP_HOST']."/index.php/index/index/hezi/userid/".$userid."/ddh/".$ddh."/id/".$id.".html");
			
		}else{
			if(is_mobile()){
			$this->redirect("http://".$ename['ename']."/index.php/index/index/hezi/userid/".$userid."/ddh/".$ddh."/id/".$id.".html");
			}else{
				$this->redirect("http://www.qq.com");
			}
		}
		//print_r($ename);
	}
	
	public function jubao(){
		
		$shijian=date('Y-m-d H:i:s' ,time());
		$data=[];
		$data['shijian']=$shijian;
		$data['ip']=getIP();
		$data['zt']="禁止访问";
		$data['neirong']=input("post.content");
		$data['typeto']=input("post.type");
		Db::name("ts")->insert($data);
		echo 1;
	}
	
	public function tousu(){
		
		return $this->fetch();
	}
	
	
	public function hezi(){
		
		if(config("ffymkg")==1){
			if(config("ffymsz")=="http://".$_SERVER['HTTP_HOST']){
				$this->redirect("http://www.qq.com");
				exit();
			}
		}
		
		
		$ip= getIP();
		
		$cunzai = Db::query("select typeto from ds_ts where zt='禁止访问' and ip='".$ip."'");
		print_r($cunzai);
		if(!empty($cunzai)){
			$content2 ="<script>location.href='/err.html'</script>";
			
			echo $content2;
			exit;
		}
		
		$userid=input("userid");
		$id=input("id");
		$tui=Db::name("tui")->where(['userid'=>$userid,'id'=>$id])->find();
		
		$ddh2=input("ddh");
		$map = ['userid'=>$userid];
		$Nowpage = input('get.page') ? input('get.page'):1;

        $limits = 8;// 获取总条数
        $count = Db::name('Siyou')->where($map)->count();//计算总页面

        $allpage = intval(ceil($count / $limits));
        $Siyou = new SiyouModel();
        $lists = $Siyou->getSiyouByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count); 
		
		$list=Db::name("siyou")->where(['userid'=>$userid])->limit(0,10)->select();

		if(input('get.page')){
			if($lists) {
			$lists = collection($lists)->toArray();
			}
			
			foreach($lists as &$v){
				
				if(config('ffymkg')==1){
				$longurl=config('ffymsz')."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddh2;
				}else{
				$longurl="http://".$_SERVER['HTTP_HOST']."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddh2;	
				}
				
				
				$long=urlencode($longurl);
				
				
				
				//$zl2 =dwz($long,config('dwzjk'));  
				$longurl="http://".$_SERVER['HTTP_HOST']."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddh2;	
				$v['dwz']=$longurl;
			}
			
            return json($lists);
        }

		
		
		$this->assign("tui",$tui);

		$this->assign("userid",$userid);
		$this->assign("ddh",$ddh2);
		return $this->fetch();
	}
	
	
	
	public function shipinok(){

		$ip= getIP();
		$cunzai = Db::query("select typeto from ds_ts where zt='禁止访问' and ip='".$ip."'");
		print_r($cunzai);
		if(!empty($cunzai)){
			$content2 ="<script>location.href='/err.html'</script>";
			
			echo $content2;
			exit;
		}

		$zyid=input("zyid");
		$liebiao=Db::name("siyou")->where(['id'=>$zyid])->find();
		$userid=$liebiao['userid'];
		$ddh=input("ddh");
		$dingdan = Db::name("dingdan")->where(['ddh'=>$ddh])->find();
		
		if(empty($dingdan)){
			$kl = Db::name("kl")->where(['ddh'=>$ddh])->find();
			if(empty($kl)){
			
			echo "<script>alert('若支付后无法观看，请刷新或者退出重进即可观赏。')</script>";
			exit;
			}
		}

		$yifutime=time()-intval(config("guoqitime"))*3600;
		$ip= getIP();
		$ippd=Db::name("ip")->where(['zyid'=>$zyid,"userid"=>$userid,"ddh2"=>$ddh,"ip"=>$ip,'shijian'=>['>',$yifutime]])->find();
		$ddh2=substr($ddh, 0, 10);
      
		if(empty($ippd)){
			
			$geturl="/".config('ffhouzhui')."?code=".$liebiao['zykey']."|".$ddh2;
			$content2 ="<script>location.href='$geturl'</script>";
			
			echo $content2;
			exit;
			
		}
		
		
		
		
		
		
		$list=Db::name("siyou")->where(['userid'=>$liebiao['userid']])->order('rand()')->limit(0,10)->select();
		foreach($list as &$v){
				//if(config('ffymkg')==1){
				//$longurl=config('ffymsz')."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddh2;
				//}else{
				$longurl="http://".$_SERVER['HTTP_HOST']."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddh2;	
				//}
				
				
			//	$long=urlencode($longurl);
				
				
				
				//$zl2 =dwz($long,config('dwzjk'));  
				$v['dwz']=$longurl;
			
		}
		$this->assign("list",$list);
		$this->assign("liebiao",$liebiao);
		return $this->fetch();
	}
	public function dashangjilu(){
		
		
		
		if (config("web_site_close") == "0"){echo "网站已关闭";exit;}
		$ip= getIP();
		
		
		
		
		$iplist=Db::name("ip")->order("rand()")->find();
		$ipdz=$iplist['ip'];
		
		
		
		if($ip==$ipdz){
		echo json_encode(array('status'=>"0"));
		}else{
		$ipInfos = get_ip_info($ipdz); 
		
		$sf=$ipInfos['data']['region'];
		$cs=$ipInfos['data']['city'];
		$wz=$sf.$cs;
		$s=$wz;
		echo json_encode(array('status'=>"1",'ip'=>$s));
		}
	}


	public function chazhifu(){
		$ip= getIP();
		$gcode=input("get.code");
		$ddh=substr($gcode,-10);
		$code=substr($gcode,0,32);
		
		$us2=Db::name("siyou")->where(['zykey'=>$code])->find();
		$zyid=$us2['id'];
		$userid=$us2['userid'];

		$yifutime=time()-intval(config("guoqitime"))*3600;
		
		$ippd=Db::name("ip")->where(['zyid'=>$zyid,"userid"=>$userid,"ddh"=>$ddh,"ip"=>$ip,'shijian'=>['>',$yifutime]])->find();
		if($ippd){
			if($ippd['zt']=="已付"){
			$geturl=url('shipinok',['zyid'=>$ippd['zyid'],'ddh'=>$ippd['ddh2']]);
			echo json_encode(["code"=>1,"url"=>$geturl]);
			exit;
			}else{
				echo json_encode(["code"=>0]);

			}
		}else{
				echo json_encode(["code"=>0]);

		}

	}


	public function shipindo(){
		if(config("ffymkg")==1){
			if(config("ffymsz")=="http://".$_SERVER['HTTP_HOST']){
			
				$content2 ="<script>location.href='http://www.qq.com'</script>";
				$daima2=base64_encode($content2);
				echo $daima2;
			
				exit();
			}
		}
		$ip= getIP();
		$cunzai=Db::name("ts")->where(['zt'=>"禁止访问",'ip'=>$ip])->find();
		if(!empty($cunzai)){
			$content2 ="<script>location.href='/err.html'</script>";
			$daima2=base64_encode($content2);
			echo $daima2;
			exit;
		}
		$gcode=input("get.code");
		$ddh=substr($gcode,-10);
		$code=substr($gcode,0,32);
		
		$us2=Db::name("siyou")->where(['zykey'=>$code])->find();
		$zyid=$us2['id'];
		$userid=$us2['userid'];

		$yifutime=time()-intval(config("guoqitime"))*3600;

		$ippd=Db::name("ip")->where(['zyid'=>$zyid,"userid"=>$userid,"ddh"=>$ddh,"ip"=>$ip,'shijian'=>['>',$yifutime]])->find();
		if($ippd){
			if($ippd['zt']=="已付"){
			$geturl=url('shipinok',['zyid'=>$ippd['zyid'],'ddh'=>$ippd['ddh2']]);
			$content2 ="<script>location.href='$geturl'</script>";
			$daima2=base64_encode($content2);
			echo $daima2;
			exit;
			}
		}
		
		
		$shijian2=date('Y-m-d H:i:s' ,time());
		
		$user=Db::name("member")->where(['id'=>$userid])->find();
		if($user['weixin']==null){
		$weixin=config('zzwxh');
		}else{
		$weixin=$user['weixin'];
		}
		
		
		$userlist=Db::name("siyou")->where(['id'=>$zyid])->find();
		$csm=rand(10,150).".".rand(1,9).rand(1,9);
		$ssm=rand(10,60).".".rand(1,9);
		if($userlist['sj']==$userlist['money']){
		$money=$userlist['money'];
		}else{
		
		$money=rand($userlist['sj']*10,$userlist['money']*10);
		$money=$money/10;
		
		}
		//随机背景图
		$bjt='/static/index/bj.png';
		//随机背景图
		
		$suijitu=Db::name("tupian")->order("rand()")->find();
		if(!empty($suijitu)){
			$bjt=$suijitu['photo'];
		}



		if($userlist==null||!is_mobile()){
		$content2 ="<script>location.href='".config('dnfwtz')."'</script>";
		$daima2=base64_encode($content2);
		echo $daima2;
		exit;
		}else{
		//样式输出
		$content ='<html>';
		$content.='<head>';
		$content.='<meta http-equiv="content-type" content="text/html;charset=gb2312"/>';
		$content.='<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">';
		$content.='<title>打赏看视频</title>';
		$content.='<script type="text/javascript" src="/static/index/jquery-1.8.0.min.js"></script>';
		$content.='<link rel="stylesheet" href="/static/index/css/dashang2.css">';
		$content.='<link rel="stylesheet" href="/static/index/m.css">';
		$content.='<script type="text/javascript" src="/static/index/m.js"></script>';
		$content.='</head>';
		$content.='<body>';
		$content.='<div id="background" style="position:absolute;z-index:-1;width:100%;height:100%;top:0px;left:0px;">';
		$content.='<img src="'.$bjt.'" width="100%" height="100%"/>';
		$content.='</div> ';
		$content.='<p class="sheng"><a onClick="da()">打赏看视频</a></p>';
		$content.='<div class="content">';
		$content.='<div class="nav">';
		$content.='<img src="/static/index/redbg.png"/> ';
		$content.='<p class="p1"><a onClick="dj()" style="position: absolute; top: 0px; left: 4%;font-size:30px;color:#9d2129;">×</a> 打赏看视频</p>';
		$content.='<div class="tou"><img src="/uploads/face/'.$user['head_img'].'"></div><p class="p3">'.$money.'<span style="font-size:12px;">元'.'</span></p>';
		$content.='<p class="p2">打赏看视频，金额随机</p>';
		$content.='<p class="p5">(内容由用户发布,并非平台提供,赏金归发布者)</p>';
		$content.='<div class="reward" style=""> ';
		$content.='<div  class="button"  style="width:100%;font-size:15px;height:40px;line-height:40px;">';
		
		$content.='<a onClick="wxpay()" style="background:#fae2b2;border-radius:10px; color:#d35b4d;display:inline-block;width:100%;height:40px;font-weight:bold;margin-left:1px">微信打赏</a>';
		
		$content.='</div> ';
		if(config("wyywsz")==0){
		$content.='<input type="submit" class="submit1" onClick="dianji()" value="我也要玩">';
		}else{
		$content.='<a href="'.url('index/index/hezi',['userid'=>$userid,'ddh'=>$ddh]).'"><button type="button" class="submit1">更多精彩视频</button></a>';
		}
		$content.='</div> ';
		$content.='<div style="text-align:center; color:#fff; font-size:14px; margin-top:8px; padding:10px; "> ';
		if(config("zfjk")==2){
		$content.='注：微信扫码打赏 长按识别 付款即可';
		}
		
		$content.='</div> ';
		$content.='</div> ';
		$content.='</div> ';
		$content.='<div class="daxiao">视频大小:'.$csm.'M,时长'.$ssm.'</div>';
		$content.='<div class="footer" ><a href="'.url('index/index/tousu').'">   &nbsp;&nbsp;&nbsp;投诉</a></div>';
		$content.='<div style="width:100%;height:100%;background:#000;position:fixed;top:0; filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity:0.5;" id="touming"></div>';
		$content.='<div class="erwei" style="display:none;">';
		$content.='<div class="erweima" style="width:200px;height:160px;background:#fff;margin:0 auto;position:relative;border-radius:10px;margin-top:55%;">';
		$content.='<p style="border-bottom:1px solid #ccc;padding:0 10px; height:30px; line-height: 30px;"><a onClick="gb()" style="position: absolute; top: 0; right: 4%;">×</a>请联系获取邀请码</p>';
		$content.='<div style="padding: 10px;">稳定打赏大平台招募代理中 具体加微信咨询<br>'.'<br>微信:'.$weixin.'</div>';
		$content.='</div>';
		$content.='</div>';
		$content.='<script type="text/javascript">'."\r\n";
		
		$content.='function wxpay(){'."\r\n";
		
		
		$content.="var _loading = '".'<div class="_loading" style="position:fixed;left:50%;top:40%;margin-left:-40px;width:90px;height:80px;border-radius:5%;background:#000;opacity:0.8;background:#000 url(/static/images/loading.gif) center 12px no-repeat;background-size:25px;z-index:99999;color:#fff;text-align:center;font-size:12px;"><br><br><br>正在提交订单...</div>'."';"."\r\n";
		$content.="$('body').append(_loading);"."\r\n";
		$content.="window.location.href='".'http://'.$_SERVER['HTTP_HOST'].'/index.php/index/pay/dunpay?ddh='.$ddh.'&money='.$money.'&userid='.$userid.'&zyid='.$zyid."&code=".$code."'; " ."\r\n";
		$content.='}'."\r\n";
		
		$content.='function dj(){'."\r\n";
		$content.="$('.nav').css('display','none');"."\r\n";
		$content.="$('.sheng').css('display','block');"."\r\n";
		$content.='}'."\r\n";
		$content.='function da(){'."\r\n";
		$content.="$('.nav').css('display','block');"."\r\n";
		$content.="$('.sheng').css('display','none');"."\r\n";
		$content.='}'."\r\n";
		$content.='function dianji(){'."\r\n";
		$content.="$('.erwei').css('display', 'block');"."\r\n";
		$content.='}'."\r\n";
		$content.='function gb(){'."\r\n";
		$content.="$('.erwei').css('display', 'none');"."\r\n";
		$content.='}'."\r\n";
		
		$content.='</script>'."\r\n";
		$content.='<script type="text/javascript">'."\r\n";
		
		
		

		



		//新增
		$content.='setInterval(getNo, 5000);'."\r\n";
		$content.='function getNo(){'."\r\n";
		
		
		
		$content.='$.ajax({'."\r\n";
		$content.='type:"post",'."\r\n";
		$content.='url:"'.url("index/index/dashangjilu").'",'."\r\n";
		$content.='datatype:"json",'."\r\n";
		$content.='async: true,'."\r\n";
		$content.='data:{},'."\r\n";
		$content.='timeout: 10000 ,'."\r\n";
		$content.='success : function(data){'."\r\n";
		$content.='var obj=JSON.parse(data);'."\r\n";
		$content.='if(obj.status=="1"){'."\r\n";
		$content.="$.message('来自'+obj.ip+'用户成功打赏了 ".$money." 元观看了该视频')"."\r\n";
		$content.='} '."\r\n";
		$content.='},'."\r\n";
		$content.='error:function(){'."\r\n";
		$content.='},'."\r\n";
		$content.='});'."\r\n";
		$content.='}'."\r\n";
		//新增
		$content.='</script>'."\r\n";
		$content.='</body>';
		$content.='</html>';
		$daima=base64_encode($content);
		//JS输出
		$content2 ='<script type="text/javascript">';
		$content2.='var b = new Base64();';
		$content2.='var str = b.decode('."'".$daima."'".');';
		$content2.='document.write(str);';
		$content2.='</script>';
		$daima2=base64_encode($content2);
		echo $daima2;
		
		}
		
	}
	
}
