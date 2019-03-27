<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"/www/wwwroot/dsds.test.sdgtwz.com/application/dsadmin/view/login.html";i:1530745646;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit"> 
    <title><?php echo config('WEB_SITE_TITLE'); ?>管理台</title>
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
                        <h1><?php echo config('WEB_SITE_TITLE'); ?>管理台</h1>
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
                <?php if(config('verify_type') == 1): ?>
                    <div style="margin-bottom:70px">
                        <input type="text" class="form-control" placeholder="验证码" style="color:black;width:120px;float:left;margin:0px 0px;" name="code" id="code"/>
                        <img src="<?php echo url('checkVerify'); ?>" id="yzm" onclick="javascript:this.src='<?php echo url('checkVerify'); ?>?tm='+Math.random();" style="float:right;cursor: pointer"/>
                    </div>
                <?php else: ?>
                    <div id="embed-captcha"></div>
                    <p id="wait">正在加载验证码......</p>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary btn-block">登　录</button>
            </form>
        </div>
    </div>
    <div class="signup-footer">
        <div class="pull-left">
            <a href="javascript:;"  target="_blank"  style="color:#fff">&copy; <?php echo config('WEB_SITE_TITLE'); ?>  V<?php echo config('appbanben'); ?></a>
        </div>
    </div>
</div>
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

        $("button").removeClass('btn-primary').addClass('btn-danger').text("登录中...");
    }


    function complete(data){
        if(data.code==1){
            dashang.success(data.msg,data.url);
        }else{ 
            dashang.error(data.msg);
            $("button").removeClass('btn-danger').addClass('btn-primary').text("登　录"); 
			$("#yzm").click();			
            return false;   
        }

    }
 
});


</script>
</body>
</html>