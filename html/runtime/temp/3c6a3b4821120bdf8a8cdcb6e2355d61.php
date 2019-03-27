<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"D:\wwwroot\154.48.235.148/application/dsadmin/view/kouliang/add_kouliang.html";i:1529998276;s:69:"D:\wwwroot\154.48.235.148/application/dsadmin/view/public/header.html";i:1484102488;s:69:"D:\wwwroot\154.48.235.148/application/dsadmin/view/public/footer.html";i:1529869102;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?></title>
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
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加扣量</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" name="add_kouliang" id="add_kouliang" method="post" action="<?php echo url('add_kouliang'); ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">代理选择：</label>
                            <div class="input-group col-sm-4">
                                 <select class="form-control m-b chosen-select" name="userid" id="userid">
								  <option value="0">请选择</option>
								  
								  
                                  <?php if(is_array($memberlist) || $memberlist instanceof \think\Collection || $memberlist instanceof \think\Paginator): $i = 0; $__LIST__ = $memberlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									
									  <option value="<?php echo $vo['id']; ?>"><?php echo $vo['nickname']; ?>(<?php echo $vo['id']; ?>)</option>
									<?php endforeach; endif; else: echo "" ;endif; ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">初始值：</label>
                            <div class="input-group col-sm-4">
                                <input id="cs" type="text" class="form-control" name="cs" placeholder="请输入初始值">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">倒数值：</label>
                            <div class="input-group col-sm-4">
                                <input id="ns" type="text" class="form-control" name="ns" placeholder="请输入倒数值">
                            </div>
                        </div>
                        
                        
                       
                        
						 
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
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
   
    //提交
    $(function(){
        $('#add_kouliang').ajaxForm({
            beforeSubmit: checkForm, 
            success: complete, 
            dataType: 'json'
        });
        
        function checkForm(){
			
			if( 0 == $.trim($('#userid').val())){
                layer.msg('请选择代理',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
                });
                return false;
            }
            if( '' == $.trim($('#cs').val())){
                layer.msg('请输入初始值',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
                });
                return false;
            }

            if( '' == $.trim($('#ns').val())){
                layer.msg('请输入倒数值',{icon:2,time:1500,shade: 0.1}, function(index){
                layer.close(index);
                });
                return false;
            }
                       
          

           

        }


        function complete(data){
            if(data.code==1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    window.location.href="<?php echo url('kouliang/index'); ?>";
                });
            }else{
                layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1});
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