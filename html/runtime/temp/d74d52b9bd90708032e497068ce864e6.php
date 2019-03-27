<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"D:\wwwroot\154.48.235.148/application/dsadmin/view/kouliang/list.html";i:1532793948;s:69:"D:\wwwroot\154.48.235.148/application/dsadmin/view/public/header.html";i:1484102488;s:69:"D:\wwwroot\154.48.235.148/application/dsadmin/view/public/footer.html";i:1529869102;}*/ ?>
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
 <link href="/static/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>扣量订单列表</h5>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->           
            <div class="row">
                 <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url('lists'); ?>">
                        <div class="col-sm-6">
							<div class="input-group date" style="width:50%; float:left">
                                <span class="input-group-addon" onclick="laydate({elem: '#riqi'})"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" name="riqi" id="riqi"  onclick="laydate()" placeholder="选择日期" value="<?php echo $riqi; ?>">
                            </div>	
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="<?php echo $val; ?>" placeholder="输入需查询的代理ID" value="<?php echo $val; ?>"/>  
														
                                <span class="input-group-btn"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button> 
                                </span>
                            </div>
                        </div>
                    </form>           
            </div>
            <!--搜索框结束-->
			 <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
								<th><?php if(!empty($val)): ?>代理id:(<?php echo $val; ?>)_<?php endif; if(!empty($day)): ?><?php echo $day; else: ?>今日<?php endif; ?>扣单笔数</th>
                                <th><?php if(!empty($val)): ?>代理id:(<?php echo $val; ?>)_<?php endif; if(!empty($zuori)): ?><?php echo $zuori; else: ?>昨日<?php endif; ?>扣单笔数</th>
                                <th><?php if(!empty($val)): ?>代理id:(<?php echo $val; ?>)_<?php endif; if(!empty($day)): ?><?php echo $day; else: ?>今日<?php endif; ?>扣单总金额</th>
                                <th><?php if(!empty($val)): ?>代理id:(<?php echo $val; ?>)_<?php endif; if(!empty($zuori)): ?><?php echo $zuori; else: ?>昨日<?php endif; ?>扣单总金额</th>
                                <th><?php if(!empty($val)): ?>代理id:(<?php echo $val; ?>)_<?php endif; ?>历史总扣单笔数</th>
								 <th><?php if(!empty($val)): ?>代理id:(<?php echo $val; ?>)_<?php endif; ?>历史总扣单金额</th>
                               
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
			
			
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
								<th>ID</th>
                                <th>代理ID</th>
                               
                                <th>资源名称</th>
                                <th>打赏金额</th>
								 <th>订单时间</th>
                                <th>订单号</th>
								<th>微信订单号</th>
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                            <tr class="long-td">
								 <td>{{d[i].id}}</td>
                                <td>{{d[i].userid}}</td>
                                
                                <td>
								<span id="name{{d[i].id}}">******</span> <a onclick="show('{{d[i].id}}','{{d[i].zymc}}')" id='show{{d[i].id}}' style="color:#ff0000">点击显示</a>
								</td>
                                 <td>{{d[i].money}}</td>
                               <td>{{d[i].shijian}}</td>
							    <td>{{d[i].ddh}}</td>
								 <td>{{d[i].qudao}}</td>
                               
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
        $.getJSON('<?php echo url("lists"); ?>', {page: curr || 1,key:key,riqi:riqi}, function(data){
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






function show(id,name) {
var zt = $("#show"+id+"").html();
if(zt=='点击显示'){  
$("#name"+id+"").html(name);
$("#show"+id+"").html('点击隐藏');
}else if(zt=='点击隐藏'){  
$("#name"+id+"").html('****');
$("#show"+id+"").html('点击显示');
}
}

</script>
</body>
</html>