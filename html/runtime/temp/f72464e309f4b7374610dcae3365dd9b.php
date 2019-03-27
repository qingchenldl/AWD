<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"D:\wwwroot\154.48.235.148/application/daili/view/mingxi/dstj.html";i:1530663642;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/header.html";i:1530177288;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
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
 <link href="/static/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
 
 
 
 
<body class="gray-bg">
<div class="<?php if($ismobile==0): ?>wrapper wrapper-content<?php endif; ?> animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>打赏统计</h5>
        </div>
        <div class="ibox-content">
		<?php if($ismobile==0): ?>
            <!-- 内容主体区域 -->
			<div style="padding: 15px;">
			<fieldset class="layui-elem-field layui-field-title" style="">
			<legend>数据曲线图</legend>
			</fieldset>
			<div class="container-fluid">
			<canvas id="canvas" height="270" width="600" ></canvas>
			</div>

			</div>
		<?php else: ?>
		<div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
								
								
                               
                                <th>时间</th>
                               
                                <th>今天</th>
								
                                <th>昨天</th>
								
								
                            </tr>
                        </thead>
                        
                          
								
                               
                                
                           
                        <tbody id="list-content">
						
							<?php $__FOR_START_15732__=0;$__FOR_END_15732__=24;for($i=$__FOR_START_15732__;$i < $__FOR_END_15732__;$i+=1){ ?>
							<tr>
								<td><?php echo $i; ?>点</td>
                               <td><?php $tmp = 'sj';$tmp .= $i;echo $$tmp; ?></td>
                                
							  
								 <td><?php $tmp = 'dj';$tmp .= $i;echo $$tmp; ?></td>
								
                            </tr>
							<?php } ?>
							
						</tbody>
                    </table>
                   
                </div>
				
            </div>
            </div>
		<?php endif; ?>
        </div>
    </div>
</div>
<!-- End Panel Other -->
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
<?php if($ismobile==0): ?>
<script src="__JS__/Chart.min.js"></script>

<script>
var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
var lineChartData = {
labels : ["0点","1点","2点","3点","4点","5点","6点","7点","8点","9点","10点","11点","12点","13点","14点","15点","16点","17点","18点","19点","20点","21点","22点","23点"],
datasets : [
{
label: "My First dataset",
fillColor : "rgba(51,204,113,0.1)",
strokeColor : "rgba(51,204,113,1)",
pointColor : "rgba(51,204,113,1)",
pointStrokeColor : "#fff",
pointHighlightFill : "#fff",
pointHighlightStroke : "rgba(220,220,220,1)",
data : ["<?php echo round($sj0,2)?>","<?php echo round($sj1,2)?>","<?php echo round($sj2,2)?>","<?php echo round($sj3,2)?>","<?php echo round($sj4,2)?>","<?php echo round($sj5,2)?>","<?php echo round($sj6,2)?>","<?php echo round($sj7,2)?>","<?php echo round($sj8,2)?>","<?php echo round($sj9,2)?>","<?php echo round($sj10,2)?>","<?php echo round($sj11,2)?>","<?php echo round($sj12,2)?>","<?php echo round($sj13,2)?>","<?php echo round($sj14,2)?>","<?php echo round($sj15,2)?>","<?php echo round($sj16,2)?>","<?php echo round($sj17,2)?>","<?php echo round($sj18,2)?>","<?php echo round($sj19,2)?>","<?php echo round($sj20,2)?>","<?php echo round($sj21,2)?>","<?php echo round($sj22,2)?>","<?php echo round($sj23,2)?>"]
}
,
{
label: "My Second dataset",
fillColor : "rgba(138,140,115,0.2)",
strokeColor : "rgba(138,140,115,1)",
pointColor : "rgba(138,140,115,1)",
pointStrokeColor : "#fff",
pointHighlightFill : "#fff",
pointHighlightStroke : "rgba(151,187,205,1)",
data : ["<?php echo round($dj0,2)?>","<?php echo round($dj1,2)?>","<?php echo round($dj2,2)?>","<?php echo round($dj3,2)?>","<?php echo round($dj4,2)?>","<?php echo round($dj5,2)?>","<?php echo round($dj6,2)?>","<?php echo round($dj7,2)?>","<?php echo round($dj8,2)?>","<?php echo round($dj9,2)?>","<?php echo round($dj10,2)?>","<?php echo round($dj11,2)?>","<?php echo round($dj12,2)?>","<?php echo round($dj13,2)?>","<?php echo round($dj14,2)?>","<?php echo round($dj15,2)?>","<?php echo round($dj16,2)?>","<?php echo round($dj17,2)?>","<?php echo round($dj18,2)?>","<?php echo round($dj19,2)?>","<?php echo round($dj20,2)?>","<?php echo round($dj21,2)?>","<?php echo round($dj22,2)?>","<?php echo round($dj23,2)?>"]
}

]
}
window.onload = function(){
var ctx = document.getElementById("canvas").getContext("2d");
window.myLine = new Chart(ctx).Line(lineChartData, {
responsive: true
});
}
<?php endif; ?>
</script>
</body>
</html>