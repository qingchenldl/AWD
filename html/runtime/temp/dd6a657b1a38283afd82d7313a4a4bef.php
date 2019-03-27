<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"/www/wwwroot/ds/application/dsadmin/view/siyou/index.html";i:1530695224;s:59:"/www/wwwroot/ds/application/dsadmin/view/public/header.html";i:1484102488;s:59:"/www/wwwroot/ds/application/dsadmin/view/public/footer.html";i:1529869102;}*/ ?>
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
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>代理片库(<?php echo $count; ?>个)</h5>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->           
            <div class="row">
                <div class="col-sm-12">   
                                                      
                    <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url('index'); ?>">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="<?php echo $val; ?>" placeholder="输入需查询的名称" />   
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
							<th width="3%"><input type="checkbox" name="mmAll" onclick="All(this, 'del_id[]')" style="position:relative;clip: rect(6 15 15 6)"></th>
                                <th width="3%">ID</th>
								 <th width="3%">代理ID</th>
                                <th width="15%">影片名称</th>
								<th width="5%">缩略图</th>
								 <th width="15%">价格设置(点击可编辑)</th>
                                <th width="10%">创建时间</th>
                               
                                <th width="5%">打赏人数</th>
                                <th width="5%">视频地址</th>
								<th width="5%">唯一标识</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                                <tr class="long-td">
								 <td><input type="checkbox" title="1" name="del_id[]" value="{{d[i].id}}" id="del_id"></td>
                                    <td>{{d[i].id}}</td>
                                    <td>{{d[i].userid}}</td>
                                   <td><span id="name{{d[i].id}}">******</span> <a onclick="show('{{d[i].id}}','{{d[i].name}}')" id='show{{d[i].id}}' style="color:#ff0000">点击显示</a></td>  
								   <td><img src="{{d[i].photo}}" onerror="this.src='/static/admin/images/head_default.gif'" style="max-width:100px"></td>   
									<td class="price">{{# if(d[i].money==d[i].sj){ }}{{d[i].money}}{{# }else{ }}{{d[i].sj}}-{{d[i].money}}{{# } }}</td>  								   
                                   <td>{{d[i].shijian}}</td>      
                                    <td>{{d[i].cs}}</td>
                                   <td>{{d[i].url}}</td>
                                    
                                    <td>{{d[i].zykey}}</td>
                                                         
                                    <td>
                                       
                                        <a href="javascript:;" onclick="del_siyou({{d[i].id}})" class="btn btn-danger btn-xs btn-outline">
                                            <i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            {{# } }}
                        </script>
                        <tbody id="list-content"></tbody>
                    </table>
                    <div id="AjaxPage" style="text-align:right;"></div>
                    <div style="text-align: right;">
                       <span id="allpage"></span>
                    </div>
                </div>
				<div class="row">
					<div class="col-sm-12">   
					<div  class="col-sm-2" style="width: 100px">
						<div class="input-group" >  
							<a href="javascript:;"><button class="btn btn-outline btn-primary" id="plqr" type="button">批量删除</button></a> 
						</div>
					</div>                                            
                                   
                </div>
            </div>
        </div>
    </div>
</div>
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
$(function(){        
$(document).on('click',".price",function(){    
if(!$(this).is('.input')){    
$(this).addClass('input').html('<input   class="layui-input" type="text" value="'+ $(this).text() +'" />').find('input').focus().blur(function(){    
var thisid = $(this).parent().siblings("td:eq(1)").text();    
var thisvalue=$(this).val();   
var thisclass = $(this).parent().attr("class");   
$.ajax({
type : "post",
url : "<?php echo url('editprice'); ?>",
dataType: "json",  
async: true,
data: {id: thisid, neirong : thisvalue},
timeout: 10000 ,
success : function(data){
if(data.zt=='1'){  
layer.msg("设置成功");
} 
},
error:function(){
}
});
$(this).parent().removeClass('input').html($(this).val() || 0);    
});                        
}    
}).hover(function(){    
$(this).addClass('hover');    
},function(){    
$(this).removeClass('hover');    
});    
});    
</script> 
<script type="text/javascript">
   
    /**
     * [Ajaxpage laypage分页]
     * @param {[type]} curr [当前页]
     */
    Ajaxpage();

    function Ajaxpage(curr){
        var key=$('#key').val();
        $.getJSON('<?php echo url("siyou/index"); ?>', {
            page: curr || 1,key:key
        }, function(data){      //data是后台返回过来的JSON数据
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
 

function edit_siyou(id){
    location.href = './edit/id/'+id+'.html';
}


function del_siyou(id){
    dashang.confirm(id,'<?php echo url("del"); ?>');
}




function All(e, itemName){
	var aa = document.getElementsByName(itemName);
	for (var i=0; i<aa.length; i++)
	aa[i].checked = e.checked; 
	}
	function checkdel(delid,formname){
	var flag = false;
	for(i=0;i<delid.length;i++){
	if(delid[i].checked == true){
	flag = true;
	break;
	}
	}
	if(!flag){
	return true;
	}else{
	formname.submit();
	}
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

 $("#plqr").click(function(){
	
	var aa = document.getElementsByName('del_id[]');
	var n=0;
	var ids="";
	for (var i=0; i<aa.length; i++){
		
		if(aa[i].checked == true){
			
			if(n>0){
                ids += ',';
            }
            ids += aa[i].value;
			n++;
		}
		
	}
	
	if(ids==''){
		layer.msg("请选择视频",{icon:0,time:1500,shade: 0.1});
	}else{
		 dashang.confirm(ids,'<?php echo url("del"); ?>');
	}
	
}) 
</script>
</body>
</html>