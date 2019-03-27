<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"/www/wwwroot/ds/application/daili/view/user/shuoming.html";i:1530659888;s:57:"/www/wwwroot/ds/application/daili/view/public/header.html";i:1530177288;s:57:"/www/wwwroot/ds/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?>代理中心</title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }
    </style>
</head>
<link rel="stylesheet" type="text/css" href="/static/admin/webupload/webuploader.css">
<link rel="stylesheet" type="text/css" href="/static/admin/webupload/style.css">
<style>
.file-item{float: left; position: relative; width: 110px;height: 110px; margin: 0 20px 20px 0; padding: 4px;}
.file-item .info{overflow: hidden;}
.uploader-list{width: 100%; overflow: hidden;}
</style>
<body class="gray-bg">
<div class="<?php if($ismobile==0): ?>wrapper wrapper-content<?php endif; ?> animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>代理用户说明</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                   <blockquote class="layui-elem-quote layui-quote-nm">
<span style="font-size:48px"> 1.</span><span style="font-size:48px">提现时间说明:</span>
<br>
<br>
<span style="font-size:24px;color:#ff0000">夜间不处理任何提现申请，财务打款时间更改为周一到周五下午13点到15点统一处理提现申请。</span>
<br>
<br>
<span style="font-size:24px;color:#ff0000">周末休息如有提现等到周一上班处理请给位代理们互相告知！</span>
<br>
<br>
<span style="font-size:24px;color:#ff0000">代理将提现金额以整数提,请各位代理填写好个人的收款方式！</span>
<br>
<br>
<span style="font-size:24px;color:#ff0000">为了你的安全，超过<?php echo config('mrtxzgje'); ?>元请联系客服安全提现！ 微信；<span style="color:#FF00FF;font-size:32px"><?php echo config('zzwxh'); ?></span></span>
<br>
<br>
<span style="font-size:48px"> 2.</span><span style="font-size:48px">邀请码说明:</span>
<br>
<br>
<span style="font-size:24px;color:#ff0000">所有新注册的用户初始是没有邀请码功能的！</span>
<br>
<br>
<span style="font-size:24px;color:#ff0000">只有在历史总营业额满 <?php echo config('yqmjiage'); ?> 元时才会自动授权邀请码功能！</span>
<br>
<br>
<span style="font-size:48px"> 3.</span><span style="font-size:48px">有效代理说明:</span>
<br>
<br>
<span style="font-size:24px;color:#ff0000">以您的邀请码注册的用户皆为注册用户，当一个注册用户的营业额满： <?php echo config('fyzdje'); ?> 元时为有效下级！</span>
<br>
<br>
<span style="font-size:48px"> 4.</span><span style="font-size:48px">佣金说明:</span>
<br>
<br>
<span style="font-size:24px;color:#ff0000">当您的下级在进行提现时，系统会将提现金额换算您对应的佣金奖励直接进入您的账户余额中！</span>
<br>
<br>
<span style="font-size:24px;color:#ff0000">既: &nbsp;100  (提现金额) * <?php echo $xjjangli; ?> （佣金比例） = （ 等于您的佣金提成）</span>
</blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<script src="__JS__/plugins/chosen/chosen.jquery.js"></script>
<script src="__JS__/plugins/iCheck/icheck.min.js"></script>
<script src="__JS__/plugins/layer/laydate/laydate.js"></script>
<script src="__JS__/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/layer/layer.js"></script>
<script src="__JS__/laypage/laypage.js"></script>
<script src="__JS__/laytpl/laytpl.js"></script>
<script src="__JS__/dashang.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>

</body>
</html>