<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"D:\wwwroot\154.48.235.148/application/daili/view/mingxi/dsjl.html";i:1530660044;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/header.html";i:1530177288;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
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
            <h5>打赏记录</h5>
        </div>
        <div class="ibox-content">
            <?php if($ismobile==0): ?>
			 <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
								<th>今日订单笔数</th>
                                <th>昨日订单笔数</th>
                                <th>今日订单总金额</th>
                                <th>昨日订单总金额</th>
                                <th>历史总笔数</th>
								 <th>历史总金额</th>
                               
                            </tr>
                        </thead>
                       
                          
                           
                        <tbody >  
							
							<tr class="long-td">
								 <td><?php echo $daydd; ?></td>
                                <td><?php echo $zdd; ?></td>
                                <td><?php if(!empty($money1)): ?><?php echo $money1; ?>元<?php else: ?>0元<?php endif; ?></td>
                                <td><?php if(!empty($money2)): ?><?php echo $money2; ?>元<?php else: ?>0元<?php endif; ?></td>
                                 <td><?php echo $zong; ?></td>
                               <td><?php if(!empty($money3)): ?><?php echo $money3; ?>元<?php else: ?>0元<?php endif; ?></td>
							   
                               
                            </tr>
						</tbody>
                    </table>
                  
                </div>
            </div>
			<?php endif; ?>
			
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
							<?php if($ismobile==0): ?>
								<th>ID</th>
                               
                                <th>资源ID</th>
								<?php endif; ?>
                                <th>资源名称</th>
                                <th>打赏金额</th>
								 <th>订单时间</th>
								 <?php if($ismobile==0): ?>
                                <th>订单号</th>
								<?php endif; ?>
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                            <tr class="long-td">
							<?php if($ismobile==0): ?>
								 <td>{{d[i].id}}</td>
                                
                                <td>{{d[i].zyid}}</td>
								<?php endif; ?>
                                <td>
								{{d[i].zymc}}
								</td>
                                 <td>{{d[i].money}}</td>
                               <td>{{d[i].shijian}}</td>
							   <?php if($ismobile==0): ?>
							    <td>{{d[i].ddh}}</td>
								<?php endif; ?>
                               
                            </tr>
                            {{# } }}
                        </script>
                        <tbody id="list-content"></tbody>
                    </table>
                    <div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: right;"></div>
                </div>
            </div>
            <!-- End Example Pagination -->
        </div>
    </div>
</div>
<!-- End Panel Other -->
</div>

<!-- 加载动画 -->
<div class="spiner-example">
    <div class="sk-spinner sk-spinner-three-bounce">
        <div class="sk-bounce1"></div>
        <div class="sk-bounce2"></div>
        <div class="sk-bounce3"></div>
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
   
    //laypage分页
    Ajaxpage();
    function Ajaxpage(curr){
        var key=$('#key').val();
		var riqi=$('#riqi').val();
        $.getJSON('<?php echo url("mingxi/dsjl"); ?>', {page: curr || 1}, function(data){
            $(".spiner-example").css('display','none'); //数据加载完关闭动画 
            if(data==''){
                $("#list-content").html('<td colspan="20" style="padding-top:10px;padding-bottom:10px;font-size:16px;text-align:center">暂无数据</td>');
            }else{
                var tpl = document.getElementById('list-template').innerHTML;
                laytpl(tpl).render(data, function(html){
                    document.getElementById('list-content').innerHTML = html;
                });
                laypage({
                    cont: $('#AjaxPage'),//容器。值支持id名、原生dom对象，jquery对象,
                    pages:'<?php echo $allpage; ?>',//总页数
                    skip: true,//是否开启跳页
                    skin: '#1AB5B7',//分页组件颜色
                    curr: curr || 1,
                    groups: 3,//连续显示分页数
                    jump: function(obj, first){
                        if(!first){
                            Ajaxpage(obj.curr)
                        }
                        $('#allpage').html('第'+ obj.curr +'页，共'+ obj.pages +'页');
                    }
                });
            }
        });
    }





</script>
</body>
</html>