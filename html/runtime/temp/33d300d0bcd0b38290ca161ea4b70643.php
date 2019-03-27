<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:47:"/var/www/html/application/daili/view/login.html";i:1553303061;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?>代理中心</title>
    <link href="__CSS__/bootstrap.min.css" rel="stylesheet">
    <link href="__CSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="__CSS__/animate.min.css" rel="stylesheet">
    <link href="__CSS__/style.min.css" rel="stylesheet">
    <link href="__CSS__/login.min.css" rel="stylesheet">
    <!--极验验证需要引入的两个JS-->
    <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
    <script src="http://static.geetest.com/static/tools/gt.js"></script>

    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>
</head>

<body class="signin">
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7" style="color:#fff">
            <div class="signin-info">
                    <div class="logopanel m-b">
                        <h1><?php echo config('WEB_SITE_TITLE'); ?>代理中心</h1>
                    </div>
                    <div class="m-b"></div>
                    <h4><?php echo config('WEB_SITE_TITLE'); ?> Web Content Management Center.</h4>
                    <ul class="m-b">
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 创造一流品牌 打造一流服务</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 速度、质量、成效</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 创新引领未来</li>
                    </ul>
                   
                </div>
        </div>
        <div class="col-sm-5" style="color:#fff">
            <form id="doLogin" name="doLogin" method="post" action="<?php echo url('doLogin'); ?>">
                <h4 class="no-margins">登录：</h4>
                <p class="m-t-md">Powered by <?php echo config('WEB_SITE_TITLE'); ?></p>
                <input type="text" class="form-control uname" placeholder="用户名" id="username" name="username" value="" />
                <input type="password" class="form-control pword m-b" placeholder="密码" id="password" name="password" value="" />
                <button id="loginbtn" type="submit" class="btn btn-primary btn-block">登　录</button>
				<?php if(config('user_allow_register')==1): ?>
				 <button type="button" class="btn btn-danger  btn-block" data-toggle="modal" data-target="#forget">注  册</button>
				<?php endif; ?>
            </form>
        </div>
    </div>
    <div class="signup-footer">
        <div class="pull-left">
            <a href="javascript:;"  target="_blank"  style="color:#fff">&copy; <?php echo config('WEB_SITE_TITLE'); ?></a>
        </div>
    </div>
</div>

<?php if(config('user_allow_register')==1): ?>
<div class="modal inmodal" id="forget" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                	<span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                </button>
	                <i class="fa fa-laptop modal-icon"></i>
	                <h4 class="modal-title">注  册</h4>
                </div>
                <form name="runemail" id="runemail" action="<?php echo url('zhuce'); ?>" method="post">
	                <div class="modal-body">
	                    <div class="form-group">
	                    <label>用户名</label> 
	                    <input type="text"  name="account" id="account" placeholder="用户名" class="form-control"></div>
	                </div>
					
					<div class="modal-body">
	                    <div class="form-group">
	                    <label>昵称</label> 
	                    <input type="text"  name="nickname" id="nickname" placeholder="昵称" class="form-control"></div>
	                </div>
					
					<div class="modal-body">
	                    <div class="form-group">
	                    <label>密码</label> 
	                    <input type="password"  name="password" id="password2" placeholder="密码" class="form-control"></div>
	                </div>
										
	                <div class="modal-footer">
	                    <button type="submit" class="btn btn-primary">提 交</button>
	                    <button type="button" class="btn btn-danger" data-dismiss="modal">关 闭</button>
	                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/layer/layer.js"></script>
<script src="__JS__/dashang.js"></script>
 <script>
    var handlerEmbed = function (captchaObj) {
        $("#embed-submit").click(function (e) {
            var validate = captchaObj.getValidate();
            if (!validate) {
                $("#notice")[0].className = "show";
                setTimeout(function () {
                    $("#notice")[0].className = "hide";
                }, 2000);
                e.preventDefault();
            }
        });
        // 将验证码加到id为captcha的元素里
        captchaObj.appendTo("#embed-captcha");
        captchaObj.onReady(function () {
            $("#wait")[0].className = "hide";
        });
        // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
    };
    $.ajax({
        // 获取id，challenge，success（是否启用failback）
        url: "<?php echo url('dsadmin/Login/getVerify',array('t'=>time())); ?>", // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                product: "float", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
            }, handlerEmbed);
        }
    });


$(function(){
    $('#doLogin').ajaxForm({
        beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
        success: complete, // 这是提交后的方法
        dataType: 'json'
    });
    
    function checkForm(){
        if( '' == $.trim($('#username').val())){           
            dashang.error('请输入登录用户名');
            return false;
        }
 
        if( '' == $.trim($('#password').val())){
            dashang.error('请输入登录密码');
            return false;
        }

        $("#loginbtn").removeClass('btn-primary').addClass('btn-danger').text("登录中...");
    }


    function complete(data){
        if(data.code==1){
            dashang.success(data.msg,data.url);
        }else{ 
            dashang.error(data.msg);
            $("#loginbtn").removeClass('btn-danger').addClass('btn-primary').text("登　录");  

			$("#yzm").click();
				
            return false;   
        }

    }
 
});

<?php if(config('user_allow_register')==1): ?>
$(function(){
	$('#runemail').ajaxForm({
		beforeSubmit: emailcheckForm, // 此方法主要是提交前执行的方法，根据需要设置
		success: emailcomplete, // 这是提交后的方法
		dataType: 'json'
	});
	
	function emailcheckForm(){
		if( '' == $.trim($('#account').val())){
			layer.alert('用户名不能为空', {icon: 5,time:3000});
			$('#account').focus(); 
			return false;
		}
		
		if( '' == $.trim($('#nickname').val())){
			layer.alert('昵称不能为空', {icon: 5,time:3000});
			$('#nickname').focus(); 
			return false;
		}
		
		if( '' == $.trim($('#password2').val())){
			layer.alert('密码不能为空', {icon: 5,time:3000});
			$('#password2').focus(); 
			return false;
		}


 }
	function emailcomplete(data){
		if(data.code==1){
			layer.alert(data.msg, {icon: 6},function(){
				location=data.url;
			});
			return false;
		}else{
			layer.alert(data.msg, {icon: 5,time:3000});
			return false;	
		}
	}
 
});
<?php endif; ?>

</script>
</body>
</html>