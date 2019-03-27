<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:52:"/www/wwwroot/ds/application/daili/view/user/yqm.html";i:1530663062;s:57:"/www/wwwroot/ds/application/daili/view/public/header.html";i:1530177288;s:57:"/www/wwwroot/ds/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
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
            <h5>邀请码管理 </h5>
        </div>
        <div class="ibox-content">
			 <div class="row">
				<fieldset class="layui-elem-field layui-field-title" style=""><legend>邀请码管理</legend>
				
				<br>
				<br>
				关于推广邀请码的说明：<br>
				1:推广邀请码只是为了方便代理用户推广下级代理<br>
				2:避免无效用户进入平台。<br>
				
				<br>
				推广邀请码收费说明:<br>
				<br>
				收费为<?php echo config("yqmjiage"); ?> 元。总营业额达 <?php echo config("yqmjiage"); ?> 元的代理可以售卖

				</fieldset>
			 
			 </div>
			 <div class="hr-line-dashed"></div>
			 <div class="row">
                <div class="col-sm-12">  
				<div  class="col-sm-2" style="width: 100px">
                    <div class="input-group" >  
                        <a href="<?php echo url('yqmbuy'); ?>"><button class="btn btn-outline btn-primary" type="button">购买邀请码</button></a> 
                    </div>
                </div>     				
                    <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url('yqm'); ?>">               
                        <div class="col-sm-3">
                            <div class="input-group">
                                 <select class="form-control m-b chosen-select" name="key" id='key'>
                                    
                                    
                                        <option value="0" <?php if(0 == $key): ?>selected<?php endif; ?>>全部邀请码</option>
										<option value="1" <?php if(1 == $key): ?>selected<?php endif; ?>>所有已激活</option>
										<option value="2" <?php if(2 == $key): ?>selected<?php endif; ?>>所有未激活</option>
                                </select>
                                <span class="input-group-btn"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button> 
                                </span>
                            </div>
                        </div>
                    </form>                         
                </div>
            </div>
            <!--搜索框结束-->
			
			
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
								
								
                               
                                <th>邀请码</th>
                               
                                <th>生成时间</th>
								
                                <th>状态</th>
								<th>激活人</th>
								
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                          
								
                               
                                <td>{{d[i].yqm}}</td>
                               <td>{{d[i].shijian}}</td>
                                <td>{{d[i].zt}}</td>
							  
								 <td>{{# if (d[i].name!=null){ }}{{d[i].name}}{{# } }}</td>
								
                            </tr>
                            {{# } }}
                        </script>
                        <tbody id="list-content"></tbody>
                    </table>
                    <div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: right;"></div>
                </div>
				
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
        $.getJSON('<?php echo url("yqm"); ?>', {page: curr || 1,key:key}, function(data){
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