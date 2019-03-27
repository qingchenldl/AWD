<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"/var/www/html/ship/application/dsadmin/view/config/group.html";i:1485218686;s:62:"/var/www/html/ship/application/dsadmin/view/public/header.html";i:1484102488;s:62:"/var/www/html/ship/application/dsadmin/view/public/footer.html";i:1529869102;}*/ ?>
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
<style type="text/css">
/* TAB */
.nav-tabs.nav>li>a {
    padding: 10px 25px;
    margin-right: 0;
}
.nav-tabs.nav>li>a:hover,
.nav-tabs.nav>li.active>a {
    border-top: 3px solid #1ab394;
    padding-top: 8px;
}
.nav-tabs>li>a {
    color: #A7B1C2;
    font-weight: 500;  
    margin-right: 2px;
    line-height: 1.42857143;
    border: 1px solid transparent;
    border-radius: 0;
}
</style>

<body class="gray-bg">
<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>网站配置</h5>
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
                    <div class="panel-body">                      
                        <div class="builder-tabs builder-form-tabs">
                            <ul class="nav nav-tabs">
                                <?php if(is_array(\think\Config::get('config_group_list')) || \think\Config::get('config_group_list') instanceof \think\Collection || \think\Config::get('config_group_list') instanceof \think\Paginator): $i = 0; $__LIST__ = \think\Config::get('config_group_list');if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?>
                                    <li <?php if($id == $key): ?>class="active"<?php endif; ?>><a href="<?php echo url('?id='.$key); ?>"><?php echo $group; ?>配置</a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>           
                            </ul>
                        </div>
                        <div class="form-group"></div>
                    
                    <div class="builder-container">
                        <div class="row">
                            <div class="col-xs-12">
                                <form action="<?php echo url('save'); ?>" method="post" class="form-horizontal">  
                                    <div class="hr-line-dashed"></div>                                
                                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$config): $mod = ($i % 2 );++$i;?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $config['title']; ?>：</label>
                                            <div class="input-group col-sm-4">
                                                <?php switch($config['type']): case "0": ?>
                                                    <input type="text" class="form-control" name="config[<?php echo $config['name']; ?>]" value="<?php echo $config['value']; ?>">
                                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?php echo $config['remark']; ?></span>
                                                <?php break; case "1": ?>
                                                    <input type="text" class="form-control" name="config[<?php echo $config['name']; ?>]" value="<?php echo $config['value']; ?>">
                                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?php echo $config['remark']; ?></span>
                                                <?php break; case "2": ?>
                                                    <textarea class="form-control" type="text" rows="4" name="config[<?php echo $config['name']; ?>]"><?php echo $config['value']; ?></textarea>
                                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?php echo $config['remark']; ?></span>
                                                <?php break; case "3": ?>
                                                    <textarea class="form-control" type="text" rows="4" name="config[<?php echo $config['name']; ?>]"><?php echo $config['value']; ?></textarea>
                                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?php echo $config['remark']; ?></span>
                                                <?php break; case "4": ?>
                                                    <select class="form-control m-b chosen-select" name="config[<?php echo $config['name']; ?>]">
                                                        <?php $_result=parse_config_attr($config['extra']);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                            <option value="<?php echo $key; ?>" <?php if($config['value'] == $key): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?php echo $config['remark']; ?></span>
                                                <?php break; endswitch; ?>                                           
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                        </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-3">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存信息</button>&nbsp;&nbsp;&nbsp;
                                            <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                                        </div>
                                    </div>                               
                                </form>
                            </div>
                        </div>
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

<script type="text/javascript">

    var config = {
        '.chosen-select': {},                    
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>
</body>
</html>
