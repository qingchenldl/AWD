<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\wwwroot\154.48.235.148/application/index/view/pay/notifyyunzhifu.html";i:1532793942;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title>支付中</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<script type="text/javascript" src="/ldpay/wapcss/jquery-2.1.1.min.js"></script>
</head>

<body>
<div class="llq2" id="llq2">正在处理。。。</div>

<div><a href="<?php echo $urlok;?>" style="font-size: 2rem;">返回</a></div>
<script type="text/javascript">
$(function(){

		setInterval(function(){
		  $.ajax({
			url:"/index.php/index/pay/zidong.html",
			type: "post",
			timeout:2000,
			data: {tradeNo:"<?php echo $tradeNo; ?>",zyid:"<?php echo $zyid; ?>"},
			success: function(d){
				if(d == "success" ){
					
					
						
							
								location.replace("<?php echo $urlok;?>");
								
							
						
					
				}
			}
		  });
		},2000);
		
});
</script>
</body>
</html>