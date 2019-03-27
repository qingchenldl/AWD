<?php require_once(dirname(__FILE__).'/config.php');
error_reporting(0);
if($ldpayoff==1){echo "<font color='#333333' style='font-size:18px; font-weight:bold;'>网站接口维护,请稍后重试.</font>";exit;}
$trade_no=trim(htmlspecialchars($_REQUEST['out_trade_no']));//接收订单号
$zyid=trim(htmlspecialchars($_REQUEST['url']));
$tiaozhuan=$_REQUEST['tiaozhuan'];
$optEmail="在线支付";//收款人的账号 用于显示在页面上
$cny=(float)trim(htmlspecialchars($_REQUEST['total_fee']));     //付款金额
$cny = number_format($cny, 2, '.', '');//---------20170823-------------------
$type=3;   //支付方式
$mobile="0";   //预留参数请设置传递值为
$ewmappid = $dosql->GetOne("SELECT * FROM `#@__ewmadmin` WHERE `id`=1");
$key=$ewmappid['appid'];//APPID

if($type==1){
$appimagename="zfb.png";
$typename="支付宝扫码";
//$picurlewm= "HTTPS://QR.ALIPAY.COM/xxxxxxxxxxxxxxxxxxxx";  //通用支付宝二维码地址
$picurlfx="tyali.jpg";
$ewmmaxn=$cny.".09";
}
if($type==2){
$appimagename="qqqianbao.jpg";
$typename="QQ钱包扫码";
//$picurlewm= "tyten.jpg";  //通用QQ二维码地址
$picurlfx="tyten.jpg";
$ewmmaxn=$cny.".09";
}
if($type==3){
$appimagename="wx.png";
$typename="微信扫码";
//$picurlewm= "tywx.jpg";  //通用微信二维码地址
$picurlfx="tywx.jpg";
$ewmmaxn=$cny.".09";
}

//判断是否是手机
function is_mobile(){
    $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
    $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
    $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";  
    $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
    $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
    $regex_match.=")/i";      
    return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
}
$is_mobile=is_mobile();
if($renyitype==0){
  if($is_mobile){
  $mobile=2;
  if($type<=3){require_once("appapiewm.php");}
  }else{
  if($type<=3){require_once("apiewm.php");}
  }
}else{
  if($is_mobile){
  $mobile=2;
  if($type<=3){require_once("appapiewmry.php");}
  }else{
  if($type<=3){require_once("apiewmry.php");}
  }
} 
  
  if(stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false){
  $isweixin=0;
  }else{
  $isweixin=1;
  }
  
$types = "add_balance";
$custom2= "approved";
$custom6=1;
$urlhistory = $dosql->GetOne("SELECT * FROM `#@__ewmadmin` WHERE `appid`='{$key}' and `type`='{$types}' and fkok=1 and `custom2`='{$custom2}' and `custom6`='{$custom6}' order by id asc");
$httpurls = $urlhistory['urls'];
$urlbak = $urlhistory['jiekou'];
$urlok = $tiaozhuan;
?>

<?php
if ($mobile==2){
?>

<?php
if ($isweixin==0){
?>
<html class="no-js css-menubar" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>在线付款</title>
	<link rel="stylesheet" href="wapcss/bootstrap.css">
    <link rel="stylesheet" href="wapcss/bootstrap-extend.css">
    <link rel="stylesheet" href="wapcss/site.css">
	<script type="text/javascript" src="wapcss/jquery-2.1.1.min.js"></script>
</head>
  <body class="page-maintenance layout-full">
    <div class="page animsition text-center" style="-webkit-animation: 800ms; opacity: 1;">
      <div class="page-content vertical-align-middle">
          <!-- Qpay -->
          <div id="pjax" class="container">
		  		  <?php if($type==3){ ?>
		      <div>
              <div><div style="background-color:#019901">
                <font face="微软雅黑" style="font-weight:900;" color="#ffffff"><b style="font-weight:900;">微信扫码支付：微信扫码支付需要先保存此二维码到相册然后打开微信→扫一扫→相册→保存的个人收款二维码→完成支付。 <a href="wxexplain.php"><font color="#FFFFFF">>>>点击此处可以查看图文流程<<< </font></a></b></font></div></div>
            </div>
		  <?php } ?>
            <div class="row paypage-logo">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 paypage-logorow">
                <img src="wapcss/<?php echo $appimagename;?>" alt="<?php echo $typename;?>" width="94"></div>
            </div>
            <div class="row paypage-info">
              <div class="col-lg-6 col-lg-offset-2 col-md-7 col-md-offset-1 col-xs-10 col-xs-offset-0">
                <p class="paypage-desc">会员ID/订单号：<?php echo $trade_no;?></p>
              </div>
              <div class="col-lg-2 col-md-3 col-xs-2 clearfix">
                <p class="paypage-price">
                  <span class="paypage-price-number"><?php if ($fenzuid==99999){echo $nameuser;}else{ echo $cny;}?></span>元</p>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 paypage-qrrow">
                <?php if($type==3){ ?><p id="paypage-tip"><b>微信</b>保存二维码到手机相册打开微信扫一扫识别截图进行支付</p><?php } ?>
				<?php if($type==1){ ?><p id="paypage-tip"><a href="<?php echo $_SESSION['ewmurl']; ?>">支付宝APP如果没有自动跳转可尝试点击此处进行跳转支付</a></p><?php } ?>
				<?php if($type==2){ ?><p id="paypage-tip">QQ钱包支付可保存二维码到手机相册打开QQ进行扫一扫识别</p><?php } ?>
        		 <img class="ft-center" width="168" height="168" src="/ewmimages/<?php if ($fenzuid==99999){echo $ewm;}else{ echo $ewm;}?>?v=<?php echo time();?>"></font>
				 <input name="payAmount" id="payAmount" value="<?php echo $cny;?>" type="hidden">
				 <input name="title" id="title" value="<?php echo $trade_no;?>" type="hidden">
				 <input name="zyid" id="zyid" value="<?php echo $zyid;?>" type="hidden">
				 <input name="APPID" id="APPID" value="<?php echo $key;?>" type="hidden">
				 <input name="type" id="type" value="<?php echo $type;?>" type="hidden">
				 <input name="beizhu" id="beizhu" value="<?php echo $_SESSION['beizhu'];?>" type="hidden">
				 <input name="zhanghao" id="zhanghao" value="<?php echo $_SESSION['zhanghao'];?>" type="hidden">

                <p id="paypage-order" class="">
                  <span data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-title="支付后将自动发货" class="tip_show" data-original-title="" title="">订单号:<?php echo $trade_no;?></span><br><strong id="minute_show"><s></s>04分</strong>
    <strong id="second_show"><s></s>44秒</strong>过期               </p>
			 <p class="animation-slide-bottom">
			 <?php if ($type==1){ ?>
            <a class="btn btn-danger" href="<?php if ($fenzuid==99999){echo $_SESSION['ewmurl'];}else{ echo $_SESSION['ewmurl'];}?>" >点此处自动打开支付宝APP付款</a>			
			<?php }else{?>
			 <a class="btn btn-danger" href="#">付款成功会自动跳转</a>	
			<?php }?>
			</p>	
				  </div>
		</div>
	  </div>
    </div>  
	
<footer class="site-footer">
<div class="site-footer-legal"></div>
<div class="site-footer-right">
  <a target="_blank"><?php echo $typename;?></a></div>
</footer>
</div>
  </body></html>
<?php
}
?>
<?php
if ($isweixin==1 and $type==3){
?>
<html class="no-js css-menubar" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>在线付款</title>
	<link rel="stylesheet" href="wapcss/bootstrap.css">
    <link rel="stylesheet" href="wapcss/bootstrap-extend.css">
    <link rel="stylesheet" href="wapcss/site.css">
	<script type="text/javascript" src="wapcss/jquery-2.1.1.min.js"></script>
</head>
  <body class="page-maintenance layout-full">
    <div class="page animsition text-center" style="-webkit-animation: 800ms; opacity: 1;">
      <div class="page-content vertical-align-middle">
          <!-- Qpay -->
          <div id="pjax" class="container">
            <div class="row paypage-logo">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 paypage-logorow">
                <img src="wapcss/<?php echo $appimagename;?>" alt="<?php echo $typename;?>" width="94"></div>
            </div>
            <div class="row paypage-info">
              <div class="col-lg-6 col-lg-offset-2 col-md-7 col-md-offset-1 col-xs-10 col-xs-offset-0">
                <p class="paypage-desc">会员ID/订单号：<?php echo $trade_no;?></p>
              </div>
              <div class="col-lg-2 col-md-3 col-xs-2 clearfix">
                <p class="paypage-price">
                  <span class="paypage-price-number"><?php if ($fenzuid==99999){echo $nameuser;}else{ echo $cny;}?></span>元</p>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 paypage-qrrow">
                <?php if($type==3){ ?><p id="paypage-tip"><font  color="#CC0000" style="font-size:14px; font-weight:bolder;">微信中长按二维码图片，选择识别二维码进行支付</br>支付成功后稍等片刻会自动跳转回页面</font></p><?php } ?>
				<?php if($type==1){ ?><p id="paypage-tip"><a href="<?php echo $_SESSION['ewmurl']; ?>">支付宝APP如果没有自动跳转可尝试点击此处进行跳转支付</a></p><?php } ?>
				<?php if($type==2){ ?><p id="paypage-tip">QQ钱包支付可保存二维码到手机相册打开QQ进行扫一扫识别</p><?php } ?>
        		 <img class="ft-center" width="168" height="168" src="/ewmimages/<?php if ($fenzuid==99999){echo $ewm;}else{ echo $ewm;}?>?v=<?php echo time();?>"></font>
				 <input name="payAmount" id="payAmount" value="<?php echo $cny;?>" type="hidden">
				 <input name="title" id="title" value="<?php echo $trade_no;?>" type="hidden">
				 <input name="zyid" id="zyid" value="<?php echo $zyid;?>" type="hidden">
				 <input name="APPID" id="APPID" value="<?php echo $key;?>" type="hidden">
				 <input name="type" id="type" value="<?php echo $type;?>" type="hidden">
				 <input name="beizhu" id="beizhu" value="<?php echo $_SESSION['beizhu'];?>" type="hidden">
				 <input name="zhanghao" id="zhanghao" value="<?php echo $_SESSION['zhanghao'];?>" type="hidden">

                <p id="paypage-order" class="">
                  <span data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-title="支付后将自动发货" class="tip_show" data-original-title="" title="">订单号:<?php echo $trade_no;?></span><br><strong id="minute_show"><s></s>04分</strong>
    <strong id="second_show"><s></s>44秒</strong>过期               </p>
			 <p class="animation-slide-bottom">
            <a class="btn btn-danger" href="#">付款成功会自动跳转</a>			</p>	
				  </div>
		</div>
	  </div>
    </div>  
	
<footer class="site-footer">
<div class="site-footer-legal"></div>
<div class="site-footer-right">
  <a target="_blank"><?php echo $typename;?></a></div>
</footer>
</div>
  </body></html>
<?php
}
?>
<?php
if ($isweixin==1 and $type==2){
?>
<html class="no-js css-menubar" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>在线付款</title>
	<link rel="stylesheet" href="wapcss/bootstrap.css">
    <link rel="stylesheet" href="wapcss/bootstrap-extend.css">
    <link rel="stylesheet" href="wapcss/site.css">
	<script type="text/javascript" src="wapcss/jquery-2.1.1.min.js"></script>
</head>
  <body class="page-maintenance layout-full">
    <div class="page animsition text-center" style="-webkit-animation: 800ms; opacity: 1;">
      <div class="page-content vertical-align-middle">
          <!-- Qpay -->
          <div id="pjax" class="container">
            <div class="row paypage-logo">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 paypage-logorow">
                <img src="wapcss/<?php echo $appimagename;?>" alt="<?php echo $typename;?>" width="94"></div>
            </div>
            <div class="row paypage-info">
              <div class="col-lg-6 col-lg-offset-2 col-md-7 col-md-offset-1 col-xs-10 col-xs-offset-0">
                <p class="paypage-desc">会员ID/订单号：<?php echo $trade_no;?></p>
              </div>
              <div class="col-lg-2 col-md-3 col-xs-2 clearfix">
                <p class="paypage-price">
                  <span class="paypage-price-number"><?php if ($fenzuid==99999){echo $nameuser;}else{ echo $cny;}?></span>元</p>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 paypage-qrrow">
                <?php if($type==3){ ?><p id="paypage-tip"><font  color="#CC0000" style="font-size:14px; font-weight:bolder;">微信中长按二维码图片，选择识别二维码进行支付</br>支付成功后稍等片刻会自动跳转回页面</font></p><?php } ?>
				<?php if($type==1){ ?><p id="paypage-tip"><a href="<?php echo $_SESSION['ewmurl']; ?>">支付宝APP如果没有自动跳转可尝试点击此处进行跳转支付</a></p><?php } ?>
				<?php if($type==2){ ?><p id="paypage-tip"><font  color="#CC0000" style="font-size:14px; font-weight:bolder;">QQ钱包可保存二维码到手机相册打开QQ进行扫一扫识别</br>支付成功后稍等片刻会自动跳转回页面</font></p><?php } ?>
        		 <img class="ft-center" width="168" height="168" src="/ewmimages/<?php if ($fenzuid==99999){echo $ewm;}else{ echo $ewm;}?>?v=<?php echo time();?>"></font>
				 <input name="payAmount" id="payAmount" value="<?php echo $cny;?>" type="hidden">
				 <input name="title" id="title" value="<?php echo $trade_no;?>" type="hidden">
				 <input name="zyid" id="zyid" value="<?php echo $zyid;?>" type="hidden">
				 <input name="APPID" id="APPID" value="<?php echo $key;?>" type="hidden">
				 <input name="type" id="type" value="<?php echo $type;?>" type="hidden">
				 <input name="beizhu" id="beizhu" value="<?php echo $_SESSION['beizhu'];?>" type="hidden">
				 <input name="zhanghao" id="zhanghao" value="<?php echo $_SESSION['zhanghao'];?>" type="hidden">

                <p id="paypage-order" class="">
                  <span data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-title="支付后将自动发货" class="tip_show" data-original-title="" title="">订单号:<?php echo $trade_no;?></span><br><strong id="minute_show"><s></s>04分</strong>
    <strong id="second_show"><s></s>44秒</strong>过期               </p>
			 <p class="animation-slide-bottom">
            <a class="btn btn-danger" href="#">付款成功会自动跳转</a>			</p>	
				  </div>
		</div>
	  </div>
    </div>  
	
<footer class="site-footer">
<div class="site-footer-legal"></div>
<div class="site-footer-right">
  <a target="_blank"><?php echo $typename;?></a></div>
</footer>
</div>
  </body></html>
<?php
}
?>
<?php
if ($isweixin==1 and $type==1){
?>

<?php
if($error2018 == 1){
?>
<html class="no-js css-menubar" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>在线付款</title>
	<link rel="stylesheet" href="wapcss/bootstrap.css">
    <link rel="stylesheet" href="wapcss/bootstrap-extend.css">
    <link rel="stylesheet" href="wapcss/site.css">
	<script type="text/javascript" src="wapcss/jquery-2.1.1.min.js"></script>
</head>
  <body class="page-maintenance layout-full">
    <div class="page animsition text-center" style="-webkit-animation: 800ms; opacity: 1;">
      <div class="page-content vertical-align-middle">
          <!-- Qpay -->
          <div id="pjax" class="container">
            <div class="row paypage-logo">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 paypage-logorow">
                <img src="wapcss/<?php echo $appimagename;?>" alt="<?php echo $typename;?>" width="94"></div>
            </div>
            <div class="row paypage-info">
              <div class="col-lg-6 col-lg-offset-2 col-md-7 col-md-offset-1 col-xs-10 col-xs-offset-0">
                <p class="paypage-desc">会员ID/订单号：<?php echo $trade_no;?></p>
              </div>
              <div class="col-lg-2 col-md-3 col-xs-2 clearfix">
                <p class="paypage-price">
                  <span class="paypage-price-number"><?php if ($fenzuid==99999){echo $nameuser;}else{ echo $cny;}?></span>元</p>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12 paypage-qrrow">
                <?php if($type==3){ ?><p id="paypage-tip"><font  color="#CC0000" style="font-size:14px; font-weight:bolder;">微信中长按二维码图片，选择识别二维码进行支付</br>支付成功后稍等片刻会自动跳转回页面</font></p><?php } ?>
				<?php if($type==1){ ?><p id="paypage-tip"><a href="<?php echo $_SESSION['ewmurl']; ?>">支付宝APP如果没有自动跳转可尝试点击此处进行跳转支付</a></p><?php } ?>
				<?php if($type==2){ ?><p id="paypage-tip"><font  color="#CC0000" style="font-size:14px; font-weight:bolder;">QQ钱包可保存二维码到手机相册打开QQ进行扫一扫识别</br>支付成功后稍等片刻会自动跳转回页面</font></p><?php } ?>
        		 <img class="ft-center" width="168" height="168" src="/ewmimages/<?php if ($fenzuid==99999){echo $ewm;}else{ echo $ewm;}?>?v=<?php echo time();?>"></font>
				 <input name="payAmount" id="payAmount" value="<?php echo $cny;?>" type="hidden">
				 <input name="title" id="title" value="<?php echo $trade_no;?>" type="hidden">
				 <input name="zyid" id="zyid" value="<?php echo $zyid;?>" type="hidden">
				 <input name="APPID" id="APPID" value="<?php echo $key;?>" type="hidden">
				 <input name="type" id="type" value="<?php echo $type;?>" type="hidden">
				 <input name="beizhu" id="beizhu" value="<?php echo $_SESSION['beizhu'];?>" type="hidden">
				 <input name="zhanghao" id="zhanghao" value="<?php echo $_SESSION['zhanghao'];?>" type="hidden">

                <p id="paypage-order" class="">
                  <span data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-title="支付后将自动发货" class="tip_show" data-original-title="" title="">订单号:<?php echo $trade_no;?></span><br><strong id="minute_show"><s></s>04分</strong>
    <strong id="second_show"><s></s>44秒</strong>过期               </p>
			 <p class="animation-slide-bottom">
            <a class="btn btn-danger" href="#">付款成功会自动跳转</a>			</p>	
				  </div>
		</div>
	  </div>
    </div>  
	
<footer class="site-footer">
<div class="site-footer-legal"></div>
<div class="site-footer-right">
  <a target="_blank"><?php echo $typename;?></a></div>
</footer>
</div>
  </body></html>
<?php
	}else{
	$url = "/ldpay/aliurl.php?total_fee=".$nameuser."&jines=".$cny."&out_trade_no=".$trade_no."&pay=".$type."&url=".$urlok."&picurlewm=".$picurlewm."&appid=".$key."&beizhu=".$_SESSION['beizhu']."&gdpicurlewm=".$_SESSION['ewmurl'];//识别任意金额和固定
	header("Location:$url");
	die;
	}
}
?>
<?php
}else{
?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
      扫码支付 - 网上支付 安全快速！
    </title>
<link charset="utf-8" rel="stylesheet" href="css/api.css" media="all">
<?php
}
?>

<script src="css/jquery.min.js"></script>
<script type="text/javascript">
var intDiff = parseInt(300);
function timer(intDiff){
    window.setInterval(function(){
    var day=0,
        hour=0,
        minute=0,
        second=0;    
    if(intDiff > 0){
        day = Math.floor(intDiff / (60 * 60 * 24));
        hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
        minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
        second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
    }
    if (minute <= 9) minute = '0' + minute;
    if (second <= 9) second = '0' + second;
    $('#day_show').html(day+"天");
    $('#hour_show').html('<s id="h"></s>'+hour+'时');
    $('#minute_show').html('<s></s>'+minute+'分');
    $('#second_show').html('<s></s>'+second+'秒');
     if(intDiff==0){
     //self.location=document.referrer;
	 self.location.href="<?php echo $urlok;?>";
	 //self.location.href=location.replace;
	 }
    intDiff--;
    }, 1000);
} 
$(function(){
    timer(intDiff);
});
</script>

<?php
if ($mobile==0){
?>
  </head>
 <body>

    <div class="topbar">
      <div class="topbar-wrap fn-clear">
        <a href="https://help.alipay.com/lab/help_detail.htm?help_id=258086" class="topbar-link-last" target="_blank" seed="goToHelp">常见问题</a>
        		<span class="topbar-link-first">你好，欢迎使用扫码付款！</span>
      </div>
    </div>
    <div id="header">
      <div class="header-container fn-clear">
        <div class="header-title">
          <div class="<?php echo $logo;?>">
          </div>
          <span class="logo-title">
            我的收银台
          </span>
        </div>
      </div>
    </div>
     
<div id="container">
      <div id="content" class="fn-clear">
        <div id="J_order" class="order-area">
          <div id="order" class="order order-bow">
            <div class="orderDetail-base">
              <div class="commodity-message-row">
                <span class="first long-content">
                 会员ID/订单号：<?php echo $trade_no;?></span>&nbsp;&nbsp;(本次交易将直达收款方账户)
                <span class="second short-content">
                  收款方：<?php echo $optEmail;?>&nbsp;
                </span>
              </div>
			   <span class="payAmount-area" id="J_basePriceArea">
            <strong class=" amount-font-22 "><?php if ($fenzuid==99999){echo $nameuser;}else{ echo $cny;}?></strong> 元
        </span>

            </div>
          </div>
        </div>
        <!-- 操作区 -->
        <div class="cashier-center-container">
          <div data-module="excashier/login/2015.08.02/loginPwdMemberT" id="J_loginPwdMemberTModule" class="cashiser-switch-wrapper fn-clear">
            <!-- 扫码支付页面 -->
            <div class="cashier-center-view view-qrcode fn-left" id="J_view_qr">
      
              <!-- 扫码区域 -->
              <div data-role="qrPayArea" class="qrcode-integration qrcode-area" id="J_qrPayArea">
                <div class="qrcode-header">
                  <div class="ft-center">
                    扫一扫付款<?php if ($fenzuid==99999){echo $nameuser;}else{ echo $cny;}?>（元）                  </div>
                  <div class="ft-center qrcode-header-money"><?php if ($fenzuid==99999){echo $nameuser;}else{ echo $cny;}?></div>
                </div>
                <div class="qrcode-img-wrapper" id="payok">
				 <font>
				 <img class="ft-center" width="168" height="168" src="/ewmimages/<?php if ($fenzuid==99999){echo $ewm;}else{ echo $ewm;}?>?v=<?php echo time();?>"></font>
				 <input name="payAmount" id="payAmount" value="<?php echo $cny;?>" type="hidden">
				 <input name="title" id="title" value="<?php echo $trade_no;?>" type="hidden">
				 <input name="zyid" id="zyid" value="<?php echo $zyid;?>" type="hidden">
				 <input name="APPID" id="APPID" value="<?php echo $key;?>" type="hidden">
				 <input name="type" id="type" value="<?php echo $type;?>" type="hidden">
				 <input name="beizhu" id="beizhu" value="<?php echo $_SESSION['beizhu'];?>" type="hidden">
				 <input name="zhanghao" id="zhanghao" value="<?php echo $_SESSION['zhanghao'];?>" type="hidden">
                  <div class="qrcode-img-explain fn-clear">
                    <img class="fn-left" src="css/T1bdtfXfdiXXXXXXXX.png" alt="扫一扫标识">
                    <div class="fn-left"><font id="zt">打开<?php echo $qrna;?></font><br><strong id="minute_show"><s></s>04分</strong>
    <strong id="second_show"><s></s>44秒</strong>过期</div>
                  </div>
                </div>
				<br>
          　　　　 　　<a href="<?php echo $uourldown;?>" class="qrcode-downloadApp">首次使用请下载<?php echo $qrna;?></a>
              </div>
              <!-- 指引区域 -->
              <div class="qrguide-area">
                <img src="<?php echo $qr;?>" class="qrguide-area-img active">              </div>
            </div>
       
          </div>
        </div>
      </div>
	  </div>
<div id="partner"><br><p>本站为第三方辅助软件服务商，与支付宝官方和淘宝网无任何关系，本支付系统拒绝违法网站使用 <br>支付系统不提供资金托管和结算，转账后将立即到达指定的账户。</p>
<br><img alt="合作机构" src="css/2R3cKfrKqS.png"></div>
</body>
</html>
<?php
}
?>
<script type="text/javascript">
$(function(){
    var posTimmer;
	var $win = $(window);
	var $submit = $('#submit');
		setInterval(function(){
		  $.ajax({
			url:"/index.php/index/pay/zidong.html",
			type: "post",
			timeout:2000,
			data: {tradeNo:$("#title").val(),payAmount:$("#payAmount").val(),APPID:$("#APPID").val(),paytype:$("#type").val(),zhanghao:$("#zhanghao").val(),beizhu:$("#beizhu").val(),zyid:$("#zyid").val()},
			success: function(d){
				if(d == "success" ){
					$submit.text('付款成功');
					setTimeout(function(){
						if ( 0 ) {
						        <?php if ($payok2018type==1){ ?>
								var i=window.confirm("付款成功!");
								if(i!=0){
								location.replace("<?php echo $urlok;?>");
								}
								<?php }else{ ?>
								location.replace("<?php echo $urlok;?>");
								<?php }?>
						} else {
							if (window.opener) {
						        <?php if ($payok2018type==1){ ?>
								var i=window.confirm("付款成功!");
								if(i!=0){
								location.replace("<?php echo $urlok;?>");
								}
								<?php }else{ ?>
								location.replace("<?php echo $urlok;?>");
								<?php }?>
							} else {
						        <?php if ($payok2018type==1){ ?>
								var i=window.confirm("付款成功!");
								if(i!=0){
								location.replace("<?php echo $urlok;?>");
								}
								<?php }else{ ?>
								location.replace("<?php echo $urlok;?>");
								<?php }?>
							}
						}
					},500);
				}
			}
		  });
		},2000);
		$('#msgPayForm').submit();
});
</script>
<?php
if ($ewm=="ali.png" and $fenzuid<>99999){
echo "<script language='javascript'> "; 
echo "alert('暂时无二维码，请稍等后在支付');";
echo "</script>";

echo "<script language='javascript' type='text/javascript'>";
echo "window.location.href='/'";
echo "</script>";
exit();
}

if ($mobile==2 and $type==1 and $isweixin==0 and $fenzuid<>99999){
echo "<script language='javascript' type='text/javascript'>";
echo "window.location.href='".$_SESSION['ewmurl']."'";
echo "</script>";
}

if ($fenzuid==99999 and $mobile==0){//是PC页面
echo "<script language='javascript' type='text/javascript'>";
echo "setTimeout(\"alert('重要提示：扫码付款时必须输入指定金额(".$nameuser.")，否则会充值失败哦')\",2000);";
echo "</script>";
}

if ($fenzuid==99999 and $mobile==2 and $type==1){//是手机是支付宝
echo "<script language='javascript' type='text/javascript'>";
echo "setTimeout(\"alert('重要提示：点按钮打开支付宝APP,付款时必须输入指定金额(".$nameuser.")，否则会充值失败哦')\",2000);";
echo "</script>";
}

if ($fenzuid==99999 and $isweixin==1 and $mobile==2 and $type==3){//是手机页面且微信里且是微信支付
echo "<script language='javascript' type='text/javascript'>";
echo "setTimeout(\"alert('重要提示：长按图片选识别图片进行支付,付款时必须输入指定金额(".$nameuser.")，否则会充值失败哦')\",2000);";
echo "</script>";
}

if ($fenzuid==99999 and $isweixin==0 and $mobile==2 and $type==3){//是手机页面不是微信里且是微信支付
echo "<script language='javascript' type='text/javascript'>";
echo "setTimeout(\"alert('重要提示：保存二维码到手机相册打开微信扫一扫识别图片支付,付款时必须输入指定金额(".$nameuser.")，否则会充值失败哦')\",2000);";
echo "</script>";
}

if ($fenzuid==99999 and $isweixin==0 and $mobile==2 and $type==2){//是手机页面不是微信里且是QQ支付
echo "<script language='javascript' type='text/javascript'>";
echo "setTimeout(\"alert('重要提示：保存二维码到手机相册打开QQ扫一扫识别图片支付,付款时必须输入指定金额(".$nameuser.")，否则会充值失败哦')\",2000);";
echo "</script>";
}

?>