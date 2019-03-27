<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"/www/wwwroot/dsds.test.sdgtwz.com/application/dsadmin/view/index/index.html";i:1530830172;s:77:"/www/wwwroot/dsds.test.sdgtwz.com/application/dsadmin/view/public/header.html";i:1484102488;s:77:"/www/wwwroot/dsds.test.sdgtwz.com/application/dsadmin/view/public/footer.html";i:1529869102;}*/ ?>
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

<body class="gray-bg">






<div class="wrapper wrapper-content">
    <!--<div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <div>尊敬的会员<span id="weather"></span></div>
    </div>-->

    <!-- 上方tab -->
    <div class="row">
       
          
          
            
            
      
        
        <div class="row">
        
        
       
        
        
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>系统信息</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
              
                    <div class="ibox-content">
                        <div class="feed-activity-list">
							
                            <div class="feed-element">
                                <div>
                                  <small class="pull-right text-navy"></small>
                                    <strong>当前时间：</strong>
                                    <div id="weather_time"></div>
                                    <small class="text-muted"></small>
                                </div>
                            </div>
							
                            
                    <div class="panel-body">
                        <p><i class="fa fa-sitemap"></i> 框架版本：ThinkPHP<?php echo $info['think_v']; ?></p>
                        <p><i class="fa fa-windows"></i> 服务环境：<?php echo $info['web_server']; ?></p>
                        <p><i class="fa fa-warning"></i> 上传附件限制：<?php echo $info['onload']; ?></p>
                        <p><i class="fa fa-credit-card"></i> PHP 版本：<?php echo $info['phpversion']; ?></p>
						<p><i class="fa fa-sitemap"></i> 系统版本：<?php echo config("appbanben"); ?> <?php echo $newbanben['msg']; ?></p>
                    </div>

                         

                        </div>
                    </div>
                </div>
            </div>
			
			
			<div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>声明</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
              
                    <div class="ibox-content">
                        <div class="feed-activity-list">
							
                          
							
                            
                    <div class="panel-body">
                        <p>本打赏系统仅供作为正规视频传输吸粉收费系统，禁止利用程序从事违法活动。正规视频传输收费系统之用，切勿利用本程序从事商业违法行为。用户上传内容一律与本系统制作者无关，由使用用户自行承担！如用于其他用途所产生的一切不良后果本人概不负责！</p>
                        
                    </div>

                         

                        </div>
                    </div>
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
<script src="/static/admin/js/jquery.leoweather.min.js"></script>

<script type="text/javascript">
	$('#weather_time').leoweather({format:'{年}年{月}月{日}日 星期{周} {时}:{分}:{秒}'});
	
</script>

</body>
</html>