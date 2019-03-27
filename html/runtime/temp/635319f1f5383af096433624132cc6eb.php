<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"/var/www/html/ship/application/daili/view/index/index.html";i:1530899132;s:60:"/var/www/html/ship/application/daili/view/public/header.html";i:1530177288;s:60:"/var/www/html/ship/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
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
<link href="/static/admin/css/layui.css" rel="stylesheet">
<link href="/static/admin/css/global.css" rel="stylesheet">
<link href="/static/admin/css/iconfont/iconfont.css" rel="stylesheet">

<body class="gray-bg">






<div <?php if($ismobile==0): ?>class="wrapper wrapper-content"<?php endif; ?>>
   
    <div class="row">
       <p>本打赏系统仅供作为正规视频传输吸粉收费系统，禁止利用程序从事违法活动。正规视频传输收费系统之用，切勿利用本程序从事商业违法行为。用户上传内容一律与本系统制作者无关，由使用用户自行承担！如用于其他用途所产生的一切不良后果本人概不负责！</p> 
          
<div >
<div style=" padding:15px;">
<link rel="stylesheet" href="uboui/css/global.css">
<link rel="stylesheet" href="uboui/iconfont/iconfont.css">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
<div class="warning"><center><span style="font-size:24px;color:#ff0000">代理用户说明,详情:<a  href="<?php echo url('user/shuoming'); ?>" >点击查看</a></center></span></div>
<fieldset class="layui-elem-field layui-field-title" style=""><legend>交易统计</legend></fieldset>

<div class="layui-row layui-col-space1">
<div class="layui-col-md3">
<a href="dingdan.php">
<div class="grid-demo grid-demo-bg1 layui-bg-green"><i class="iconfont icon-recharge"></i>
<i class="g-name">今日打赏金额</i>
<span class="g-title"><i class="number"><?php echo $jrddje; ?></i><br><i class="text">元</i></span>
</div>
</a> 
</div>
<div class="layui-col-md3">
<a href="dingdan.php">
<div class="grid-demo" style="background-color: #5FB878;"><i class="iconfont icon-list"></i>
<i class="g-name">今日打赏笔数</i>
<span class="g-title"><i class="number"><?php echo $jrddbs; ?>笔</i></span>
</div>
</a> 
</div>
<div class="layui-col-md3">
<a href="dingdan.php">
<div class="grid-demo grid-demo-bg1" style="background-color: #393D49;"><i class="iconfont icon-recharge"></i>
<i class="g-name">昨日打赏金额</i>
<span class="g-title"><i class="number"><?php echo $zrddje; ?> </i><br><i class="text">元</i></span>
</div>
</a>  
</div>
<div class="layui-col-md3">
<a href="dingdan.php">
<div class="grid-demo" style="background-color: #1E9FFF;"><i class="iconfont icon-list"></i>
<i class="g-name">昨日打赏笔数</i>
<span class="g-title"><i class="number"><?php echo $zrddbs; ?> </i><br><i class="text">笔</i></span>
</div>
</a>  
</div>
</div>
<fieldset class="layui-elem-field layui-field-title" style=""><legend>打赏记录</legend></fieldset>
<div class="layui-form" style="padding: 0px 10.5px;">
<table class="layui-table">
<colgroup>
<col width="150">
<col width="350">
<col width="250">
<col>
</colgroup>
<thead>
<tr>
<?php if($ismobile==0): ?>
<th style="text-align:center;" >视频ID</th>
<?php endif; ?>
<th style="text-align:center;" width="50%">视频名称</th>
<th style="text-align:center;" >打赏金额</th>
<?php if($ismobile==0): ?>
<th style="text-align:center;" >打赏订单号</th>
<?php endif; ?>
<th style="text-align:center;" >打赏时间</th>
</tr> 
</thead>
<tbody>
<?php if($ddcount>0): if(is_array($dingdanlist) || $dingdanlist instanceof \think\Collection || $dingdanlist instanceof \think\Paginator): $i = 0; $__LIST__ = $dingdanlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<tr>
<?php if($ismobile==0): ?>
<td style="text-align:center;" ><?php echo $vo['zyid']; ?></td>
<?php endif; ?>
<td  style="text-align:center;" ><?php echo $vo['zymc']; ?></td>
<td  style="text-align:center;" ><?php echo $vo['money']; ?></td>
<?php if($ismobile==0): ?>
<td  style="text-align:center;" ><?php echo $vo['ddh']; ?></td>
<?php endif; ?>
<td  style="text-align:center;" ><?php echo $vo['shijian']; ?></td>
</tr>
<?php endforeach; endif; else: echo "" ;endif; else: ?>
<tr><td colspan="5" style="text-align:center;">没有打赏记录</td></tr>
<?php endif; ?>
</tbody>
<tfoot>
<tr>
<td colspan="8" style="text-align:center;"><a href="<?php echo url('mingxi/dsjl'); ?>">查看更多</a></td>
</tr> 
</tfoot>
</table>
</div>
<fieldset class="layui-elem-field layui-field-title" style=""><legend>提现记录</legend></fieldset>
<div class="layui-form" style="padding: 0px 10.5px;">
<table class="layui-table">
<colgroup>
<col width="150">
<col width="150">
<col width="200">
<col width="30">
<col width="50">
<col>
</colgroup>
<thead>

<tr>
<th style="text-align:center;" >提款金额</th>
<th style="text-align:center;" >提款时间</th>
<th style="text-align:center;" >提款状态</th>
</tr> 
</thead>
<tbody>
	
<?php if($txcount>0): if(is_array($tixianlist) || $tixianlist instanceof \think\Collection || $tixianlist instanceof \think\Paginator): $i = 0; $__LIST__ = $tixianlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<tr>
<td style="text-align:center;" >￥<?php echo $vo['money']; ?>元</td>
<td  style="text-align:center;" ><?php echo $vo['shijian']; ?></td>
<td  style="text-align:center;" ><?php echo $vo['zt']; ?></td>
<?php endforeach; endif; else: echo "" ;endif; ?>
</tr>
<?php else: ?>
<tr><td colspan="3" style="text-align:center;">没有提款记录</td></tr>
<?php endif; ?>
</tbody>
<tfoot>
<tr>
<td colspan="10" style="text-align:center;"><a href="<?php echo url('caiwu/jilu'); ?>">查看更多</a></td>
</tr> 
</tfoot>
</table>
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
<?php if(!empty($tanchuang)): ?>
<script>
layer.alert('<div id="a1"  style="width:580px;height:360px;"><h3><?php echo $tanchuang['title']; ?></h3><div><?php echo $tanchuang['content']; ?></idv></div>', {
skin: 'layui-layer-molv' ,
area: ['620px', '510px'] 
,closeBtn: 0,btn:['关闭'],
title:"公告",
}); 
</script>
<?php endif; ?>
</body>
</html>