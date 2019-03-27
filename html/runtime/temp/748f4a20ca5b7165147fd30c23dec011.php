<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"D:\wwwroot\154.48.235.148/application/daili/view/user/index.html";i:1530663014;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/header.html";i:1530177288;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
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
                    <h5>我的基本资料</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" name="edit_member" id="edit_member" method="post" action="<?php echo url('index'); ?>">
						 
						  <div class="form-group">
                            <label class="col-sm-3 control-label">用户ID：</label>
                            <div class="input-group col-sm-4">
                                <label class="control-label"><?php echo $member['id']; ?></label>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label">账户余额：</label>
                            <div class="input-group col-sm-4">
                                <label class="control-label"><?php echo $member['money']; ?></label>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-3 control-label">用户名：</label>
                            <div class="input-group col-sm-4">
                                <input id="account" type="text" class="form-control" name="account" placeholder="请输入账号" value="<?php echo $member['account']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">昵称：</label>
                            <div class="input-group col-sm-4">
                                <input id="nickname" type="text" class="form-control" name="nickname" placeholder="请输入昵称" value="<?php echo $member['nickname']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">密码：</label>
                            <div class="input-group col-sm-4">
                                <input id="password" type="password" class="form-control" name="password" placeholder="请输入密码" value="<?php echo $member['password']; ?>">
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">头像：</label>
                            <div class="input-group col-sm-4">
                                <input type="hidden" id="data_photo" name="head_img"  value="<?php echo $member['head_img']; ?>">
                                <div id="fileList" class="uploader-list" style="float:right"></div>
                                <div id="imgPicker" style="float:left">选择头像</div>
                                <img id="img_data" class="img-circle" height="80px" width="80px" style="float:left;margin-left: 50px;margin-top: -10px;" src="/uploads/face/<?php echo $member['head_img']; ?>" onerror="this.src='/static/admin/images/head_default.gif'"/>
                            </div>
                        </div> 
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">qq：</label>
                            <div class="input-group col-sm-4">
                                <input id="qq" type="text" class="form-control" name="qq" placeholder="请输入代理qq" value="<?php echo $member['qq']; ?>">
                            </div>
                        </div>
                         <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">微信：</label>
                            <div class="input-group col-sm-4">
                                <input id="weixin" type="text" class="form-control" name="weixin" placeholder="请输入代理微信" value="<?php echo $member['weixin']; ?>">
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
<script type="text/javascript" src="/static/admin/webupload/webuploader.min.js"></script>

<script type="text/javascript">
    var $list = $('#fileList');
    //上传图片,初始化WebUploader
    var uploader = WebUploader.create({
     
        auto: true,// 选完文件后，是否自动上传。   
        swf: '/static/admin/webupload/Uploader.swf',// swf文件路径 
        server: "<?php echo url('Upload/uploadface'); ?>",// 文件接收服务端。
        duplicate :true,// 重复上传图片，true为可重复false为不可重复
        pick: '#imgPicker',// 选择文件的按钮。可选。

        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/jpg,image/jpeg,image/png'
        },

        'onUploadSuccess': function(file, data, response) {
            $("#data_photo").val(data._raw);
            $("#img_data").attr('src', '/uploads/face/' + data._raw).show();
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

    //提交
    $(function(){
        $('#edit_member').ajaxForm({
            beforeSubmit: checkForm, 
            success: complete, 
            dataType: 'json'
        });
        
        function checkForm(){
            if( '' == $.trim($('#account').val())){
                layer.msg('请输入用户名',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
                });
                return false;
            }

            if( '' == $.trim($('#nickname').val())){
                layer.msg('请输入昵称',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
                });
                return false;
            }
                       
            if( '' == $.trim($('#password').val())){
                layer.msg('请输入密码',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
                });
                return false;
            }

           

        }

        function complete(data){
            if(data.code==1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    window.location.href="<?php echo url('index'); ?>";
                });
            }else{
                layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1});
                return false;   
            }
        }   
    });

</script>
</body>
</html>