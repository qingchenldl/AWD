<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\wwwroot\154.48.235.148/application/daili/view/siyou/wodelianjie.html";i:1530662714;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/header.html";i:1530177288;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
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
<link href="/static/admin/css/layui.css" rel="stylesheet">
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
                    <h5>我的链接</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                   <textarea type="text" id="target" readonly="readonly" value="" style="width:1px;height:1px;margin-left:-100px"></textarea>
					<fieldset  class="layui-elem-field layui-field-title" style="">
					<legend>短链接</legend><div class="yijian"><button data-clipboard-action="copy" data-clipboard-target="#target" id="copy_btn" class="layui-btn layui-btn-small layui-btn-normal">一键复制</button></div>
					<div id="ts"><center><span class="red">请点击下面生成链接按钮 生成短链接</span></center></div>
					<div id="ts2"  style="display:none" ></div>
					<div class="layui-field-box"  id="moreUrlbox"></div>
					</fieldset>
					<hr>
					<center>(<span class="red">长按</span>链接可拷贝或复制)</center>
					<br>
					<div class="againUrl"  onclick="getInfo()">生成链接</div>
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


<script src="__JS__/clipboard.min.js"></script>


<script type="text/javascript">
function getInfo(){
$('#ts2').css('display','block');
$('#ts2').html("<center><span class='red'>获取数据中!</span></center>");
$('#moreUrlbox').html("");
var url = "<?php echo url('wodelianjie'); ?>";
$.get(url,{"shengcheng":1},function(res){
var short_urlMore =res.split(",");
var moreUrl = '';
var Text = '';
for(i=0;i<short_urlMore.length;i++){
Text += short_urlMore[i] + "\r";
moreUrl += '<center>'+short_urlMore[i]+'</center>' + "\r" + '<br>'
}
$('#ts').css('display','none');
$('#ts2').css('display','none');
$("#moreUrlbox").append(moreUrl);
$('#target').val(Text)
var clipboard = new Clipboard('#copy_btn');
clipboard.on('success', function(e) {
layer.msg('推广链接已经成功复制到您的黏贴板');
e.clearSelection();
});

});

$(".againUrl").hide();

}
</script>

  
   

   

</body>
</html>
