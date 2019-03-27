<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"/www/wwwroot/ds/application/daili/view/caiwu/sqtixian.html";i:1530973934;s:57:"/www/wwwroot/ds/application/daili/view/public/header.html";i:1530177288;s:57:"/www/wwwroot/ds/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
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
                    <h5>申请提现</h5>
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
                    <form class="form-horizontal m-t" name="add" id="add" method="post" action="sqtixian">
						<div class="form-group">
                            <label class="col-sm-3 control-label">单笔最小提款金额：</label>
                            <div class="input-group col-sm-4">
                                 <label class="control-label"> <?php echo config('txzdje'); ?>元</label>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label">每天可提款总金额：</label>
                            <div class="input-group col-sm-4">
                               <label class="control-label"> <?php echo config('mrtxzgje'); ?>元</label>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-3 control-label">今日已申请提款总金额：</label>
                            <div class="input-group col-sm-4">
                                 <label class="control-label"> <?php echo $money1; ?>元</label>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-3 control-label">提现单笔最高金额：</label>
                            <div class="input-group col-sm-4">
                                 <label class="control-label"> <?php echo config('aqtxje'); ?>元</label>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-3 control-label">可用余额：</label>
                            <div class="input-group col-sm-4">
                                 <label class="control-label"> <?php echo $member['money']; ?>元</label>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <label class="col-sm-3 control-label">提现金额：</label>
                            <div class="input-group col-sm-4">
                                <input id="money" type="text" class="form-control" name="money" placeholder="输入提现金额">
                            </div>
                        </div>
						
						
						
						
						
						<div class="form-group">
                            <label class="col-sm-3 control-label">密码：</label>
                            <div class="input-group col-sm-4">
                                <input id="password" type="password" class="form-control" name="password" placeholder="输入密码">
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-3 control-label">收款模式：</label>
                            <div class="input-group col-sm-4">
                                <select class="form-control m-b chosen-select" name="type" id="type">
                                  
											<?php if(config('dlskms')==0||config('dlskms')==2): ?>
                                            <option value="1" <?php if($type==1): ?>selected<?php endif; ?>>收款码</option>
											<?php endif; if(config('dlskms')==0||config('dlskms')==1): ?>
                                            <option value="0" <?php if($type==0): ?>selected<?php endif; ?>>账户</option>
											<?php endif; ?>
                                </select>
                            </div>
                        </div>
						<?php if(config('dlskms')==0||config('dlskms')==2): ?>
						<div id="skm" <?php if(config('dlskms')==0&&$type==0): ?>style="display:none"<?php endif; ?>>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label">收款码：</label>
								<div class="input-group col-sm-4">
									<input id="imgurl" type="hidden" class="form-control" name="imgurl" placeholder="上传收款码" value="<?php if(!empty($zhsk)): ?><?php echo $zhsk['imgurl']; endif; ?>">
									
									 <div id="fileList" class="uploader-list" style="float:right"></div>
									<div id="imgPicker" style="float:left">选择文件</div>
									<div style="clear:both"><img id="imgurl2" src="<?php if(!empty($zhsk)): ?><?php echo $zhsk['imgurl']; endif; ?>" style="max-width:200px"></div>
								</div>
							</div>
                        </div>
						<?php endif; if(config('dlskms')==0||config('dlskms')==1): ?>
						<div id="zhanghu" <?php if(config('dlskms')==0&&$type!=0): ?>style="display:none"<?php endif; ?>>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label">收款人：</label>
								<div class="input-group col-sm-4">
									<input id="name" type="text" class="form-control" name="name" placeholder="请填写收款人" value="<?php if(!empty($zhsk2)): ?><?php echo $zhsk2['name']; endif; ?>">
									
									
								</div>
							</div>
							
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label">收款账号：</label>
								<div class="input-group col-sm-4">
									<input id="zhanghao" type="text" class="form-control" name="zhanghao" placeholder="请填写收款账号" value="<?php if(!empty($zhsk2)): ?><?php echo $zhsk2['zhanghao']; endif; ?>">
									
									
								</div>
							</div>
							
							
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label">账号类型：</label>
								<div class="input-group col-sm-4">
									<input id="leixing" type="text" class="form-control" name="leixing" placeholder="请填写账号类型" value="<?php if(!empty($zhsk2)): ?><?php echo $zhsk2['leixing']; endif; ?>">
									
									
								</div>
							</div>
                        </div>
                      <?php endif; ?>
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 确定</button>&nbsp;&nbsp;&nbsp;
                                
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

<script type="text/javascript" src="/static/admin/webupload/webuploader.min.js"></script>

<script type="text/javascript">

	<?php if(config('dlskms')==0): if($type==1||$type==2): ?>
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
        
            if(data.code==0){
                layer.msg('没有上传权限', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
            }else{
            $("#imgurl").val("/uploads/images/"+data._raw);
            
            $("#imgurl2").attr("src","/uploads/images/"+data._raw);
            
            }
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

        $("#type").change(function(){
            var type=$(this).val();
            if(type==0){
                $("#skm").hide();
                $("#zhanghu").show();
            }else{
                $("#zhanghu").hide();
                $("#skm").show();
               



    
       
    
            }
            
        })
    <?php else: ?>
		var shouci=0;
		$("#type").change(function(){
			var type=$(this).val();
			if(type==0){
				$("#skm").hide();
				$("#zhanghu").show();
			}else{
				$("#zhanghu").hide();
				$("#skm").show();
				if(shouci==0){
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
		
			if(data.code==0){
				layer.msg('没有上传权限', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
			}else{
			$("#imgurl").val("/uploads/images/"+data._raw);
			
			$("#imgurl2").attr("src","/uploads/images/"+data._raw);
			
			}
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
		shouci=1;
		}
	
			}
			
		})
	 <?php endif; endif; if(config('dlskms')==2): ?>
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
		
			if(data.code==0){
				layer.msg('没有上传权限', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
			}else{
			$("#imgurl").val("/uploads/images/"+data._raw);
			
			$("#imgurl2").attr("src","/uploads/images/"+data._raw);
			
			}
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
	<?php endif; ?>
</script>
   
<script type="text/javascript">

    $(function(){
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });

        function checkForm(){
            if( '' == $.trim($('#money').val())){
                layer.msg('提现金额不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
			if( '' == $.trim($('#password').val())){
                layer.msg('密码不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
			
			if(1 == $.trim($('#type').val())){
				if( '' == $.trim($('#imgurl').val())){
					layer.msg('请上传收款码', {icon: 5,time:1500,shade: 0.1}, function(index){
						layer.close(index);
					});
					return false;
				}
			
			
			}
			
			if(0 == $.trim($('#type').val())){
				if( '' == $.trim($('#name').val())){
					layer.msg('请填写收款人', {icon: 5,time:1500,shade: 0.1}, function(index){
						layer.close(index);
					});
					return false;
				}
				
				if( '' == $.trim($('#zhanghao').val())){
					layer.msg('请填写收款账号', {icon: 5,time:1500,shade: 0.1}, function(index){
						layer.close(index);
					});
					return false;
				}
				
				if( '' == $.trim($('#leixing').val())){
					layer.msg('请填写账号类型', {icon: 5,time:1500,shade: 0.1}, function(index){
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
                    window.location.href="<?php echo url('jilu'); ?>";
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
