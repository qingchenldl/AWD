<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"/www/wwwroot/ds/application/daili/view/siyou/wailian.html";i:1530982262;s:57:"/www/wwwroot/ds/application/daili/view/public/header.html";i:1530177288;s:57:"/www/wwwroot/ds/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
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
                    <h5>添加外链</h5>
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
                    <form class="form-horizontal m-t" name="add" id="add" method="post" action="wailian">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">视频名称：</label>
                            <div class="input-group col-sm-4">
                                <input id="name" type="text" class="form-control" name="name" placeholder="输入视频名称">
                            </div>
                        </div>
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">视频地址：</label>
                            <div class="input-group col-sm-4">
                                <input id="url" type="text" class="form-control" name="url" placeholder="输入视频外链地址">
								
                            </div>
                        </div>
                       
						<div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">视频图片：</label>
                            <div class="input-group col-sm-4">
                                <input id="photo" type="text" class="form-control" name="photo" placeholder="输入视频图片">
								<div id="fileList" class="uploader-list" style="float:right"></div>
                                <div id="imgPicker" style="float:left">选择图片</div>
                            </div>
                        </div>
					   
                       <div class="hr-line-dashed"></div>
                       <div class="form-group">
						 <label class="col-sm-3 control-label"> </label>
					    <div class="input-group col-sm-4">
							<div class="layui-form-item" id='jg' <?php if(config("sfkqsims")==1): ?>style="display:none;"<?php endif; ?>>
							<div class="layui-inline">
							<label class="layui-form-label">打赏</label>
							<div class="layui-input-inline" style="width: 100px;">
							<input type="tel"  name="start"  oninput="gais()" id="s" lay-verify="phone"  class="layui-input" value="3" >
							</div>
							<div class="layui-form-mid">元 -</div>
							<div class="layui-input-inline" style="width: 100px;">
							<input type="text" id="e" name="end"  oninput="gaie()"  class="layui-input" value="5" >
							</div>
							<div class="layui-form-mid">元</div>
							</div>
							</div>
							<div class="layui-form-item" id='gd' <?php if(config("sfkqsims")==0): ?>style="display:none;"<?php endif; ?>>
							<label class="layui-form-label">固定</label>
							<div class="layui-input-inline">
							<input type="text"  name="guding" oninput="gaiguding()"  id="g" value="3"  class="layui-input">
							</div>
							<div class="layui-form-mid layui-word-aux">元</div>
							</div>
							<div class="foot4" <?php if(config("sfkqsims")==1): ?>style="display:none;"<?php endif; ?>>
							<input  <?php if(config("sfkqsims")==0): ?>checked<?php endif; ?>  type="checkbox" onChange="dochange()" id="checkbox1" style="margin-right:5px;background:0;border:1px solid #333;" /><span id="suiji1">随机（<span id="start">3</span>到<span id="end">5</span>元)</span>
							
							</div>
							<input type="hidden" name="issuiji" value="<?php if(config("sfkqsims")==0): ?>0<?php else: ?>1<?php endif; ?>" id="issuiji"/>

							
							</div>
						</div>
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                               
                            </div>
                        </div>
                    </form>
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



<script type="text/javascript">

	 function dochange(){
if(document.getElementById("checkbox1").checked){
$('#issuiji').val('0');
$('#gd').css('display',"none");
$('#jg').css('display',"block");
}else{
$('#issuiji').val('1');
$('#jg').css('display',"none");
$('#gd').css('display',"block");
}
}
function gais(){
var zuidi=<?php echo config("zuidijiage"); ?>;
var s=$('#s').val();
if(s<zuidi && s!=''){
layer.msg('最低价格不能小于'+zuidi, {icon: 5,time:2000});
return;
}
$('#start').html(s);
}
function gaie(){
var s=$('#s').val();
var e=$('#e').val();
var zuigao=<?php echo config("zuidajiage"); ?>;
if(e>zuigao && e!=""){
layer.msg('最高价格不能大于'+zuigao+'元', {icon: 5,time:2000});
return;
}
$('#end').html(e);
}
function gaiguding(){
var zuidi= <?php echo config("zuidijiage"); ?>;
var zuigao= <?php echo config("zuidajiage"); ?>;
var val=$('#g').val();
var g = parseInt(val);
if(g!="" && g<zuidi){
layer.msg('固定价格不能小于'+zuidi, {icon: 5,time:2000});
$('#g').val(zuidi);
return;
}
if(g!="" && g>zuigao){
layer.msg('固定价格不能大于'+zuigao, {icon: 5,time:2000});
$('#g').val(zuigao);
return;
}
$('#gudingmoney').html(g+"元");
}



  
   
</script>
   
<script type="text/javascript" src="/static/admin/webupload/webuploader.min.js"></script>

<script type="text/javascript">
    var $list = $('#fileList');
    //上传图片,初始化WebUploader
    var uploader = WebUploader.create({
     
        auto: true,// 选完文件后，是否自动上传。   
        swf: '/static/admin/webupload/Uploader.swf',// swf文件路径 
        server: "<?php echo url('Upload/upload'); ?>",// 文件接收服务端。
        duplicate :true,// 重复上传图片，true为可重复false为不可重复
        pick: '#imgPicker',// 选择文件的按钮。可选。

        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/jpg,image/jpeg,image/png'
        },

        'onUploadSuccess': function(file, data, response) {
            $("#photo").val('/uploads/images/'+data._raw);
            //$("#img_data").attr('src', '/uploads/images/' + data._raw).show();
        }
    });

    uploader.on( 'fileQueued', function( file ) {
        $list.html( '<div id="' + file.id + '" class="item">' +
            '<h4 class="info">' + file.name + '</h4>' +
            '<p class="state">正在上传...</p>' +
        '</div>' );
    });

    // 文件上传成功
    uploader.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传成功！');
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传出错!');
    }); 

    $(function(){
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });

        function checkForm(){
            if( '' == $.trim($('#url').val())){
                layer.msg('视频文件不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
			if( '' == $.trim($('#name').val())){
                layer.msg('视频名称不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
			
			if(1 == $.trim($('#issuiji').val())){
				if( '' == $.trim($('#g').val())){
					layer.msg('固定金额不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
						layer.close(index);
					});
					return false;
				}
			
			
			}
			
			if(0 == $.trim($('#issuiji').val())){
				if( '' == $.trim($('#s').val())){
					layer.msg('随机最小金额不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
						layer.close(index);
					});
					return false;
				}
				
				if( '' == $.trim($('#e').val())){
					layer.msg('随机最大金额不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
						layer.close(index);
					});
					return false;
				}
			
			
			}
			

     }

        function complete(data){
            if(data.code == 1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                    window.location.href="<?php echo url('siyou/index'); ?>";
                });
            }else{
                layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
        }

    });


    //IOS开关样式配置
   var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
    var config = {
        '.chosen-select': {},                    
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }



</script>
</body>
</html>
