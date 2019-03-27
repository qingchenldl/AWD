<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"D:\wwwroot\154.48.235.148/application/daili/view/gongyou/index.html";i:1532793956;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/header.html";i:1530177288;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
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

<body class="gray-bg">
<div class="<?php if($ismobile==0): ?>wrapper wrapper-content<?php endif; ?> animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>公共片库</h5>
        </div>
        <div <?php if($ismobile==0): ?>class="ibox-content"<?php endif; ?>>
           
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
							<th width="3%"><input type="checkbox" name="mmAll" onclick="All(this, 'del_id[]')" style="position:relative;clip: rect(6 15 15 6)"></th>
								<?php if($ismobile==0): ?>
                                <th width="3%">影片ID</th>
								<?php endif; ?>
                                <th>影片名称<?php if($ismobile==0): if(\think\Config::get('dlyulan')==1): ?>（点击预览）<?php endif; endif; ?></th>
								
                                <th width="10%">创建时间</th>
                               <?php if($ismobile==0): ?>
							   <th width="5%">缩略图</th>
                                <th width="5%">打赏人数</th>
                               <?php endif; ?>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                                <tr class="long-td">
								 <td>
								 {{# if(d[i].fabu==1){ }} <input type="checkbox" title="1" name="del_id[]" value="{{d[i].id}}" id="del_id">{{# } }} 
								
								 
								 </td>
								 <?php if($ismobile==0): ?>
                                    <td>{{d[i].id}}</td>
                                   <?php endif; ?>
                                    <td><?php if(\think\Config::get('dlyulan')!=1||$ismobile==1): ?><span>{{d[i].name}}</span><?php else: ?><a  onClick="play('{{d[i].url}}')" ><span style="color:#676a6c">{{d[i].name}}</span></a ><?php endif; ?></td>                                 
                                   <td>{{d[i].shijian}}</td>  
								<?php if($ismobile==0): ?>		
									<td><img src="{{d[i].photo}}" onerror="this.src='/static/admin/images/head_default.gif'" style="max-width:100px"></td>   
                                    <td>{{d[i].cs}}</td>
                                   <?php endif; ?>
                                   
                                    
                                                         
                                    <td>
									
									 {{# if(d[i].fabu==1){ }}
                                       <button   class="layui-btn layui-btn-small layui-btn-normal publish_btn" data-id="{{d[i].id}}"  data-name="{{d[i].name}}">发布</button >
											
										{{# }else { }}
										<span   class="layui-btn layui-btn-small layui-btn-normal layui-btn-danger">已发布</span>
										{{# } }} 	
											<br />
                                       <?php if(\think\Config::get('dlyulan')==1): if($ismobile==1): ?>  <button   class="layui-btn layui-btn-small layui-btn-normal" onClick="read({{d[i].id}})">查看</button >	<?php endif; endif; ?>
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
							<a href="javascript:;"><button class="btn btn-outline btn-primary" id="plqr" type="button" >批量发布</button></a> 
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
<div class="modal fade" id="myPublic" tabindex="-1" role="dialog" aria-labelledby="myPublicLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">发布视频</h4>
</div>
<div class="modal-body">
<input type="hidden" name="id" class="form-control" id="recipient-id">
<div class="form-group">
<label for="recipient-name" class="control-label">标题</label>
<input type="text" name="title" class="layui-input" id="recipient-name">
</div>
<div class="form-group">
        <div class="layui-form-item" id='jg' <?php if(config("sfkqsims")==1): ?>style="display:none;"<?php endif; ?>>
                            <div class="layui-inline">
                            <label class="layui-form-label">打赏</label>
                            <div class="layui-input-inline" style="width: 100px;">
                            <input type="tel"  name="start"  oninput="gais()" id="s" lay-verify="phone"  class="layui-input" value="3" >
                            </div>
                            <div class="layui-form-mid">元 -</div>
                            <div class="layui-input-inline" style="width: 100px;">
                            <input type="text" id="e" name="end"  oninput="gaie()"  class="layui-input" value="5" >
                            </div>
                            <div class="layui-form-mid">元</div>
                            </div>
                            </div>
                            <div class="layui-form-item" id='gd' <?php if(config("sfkqsims")==0): ?>style="display:none;"<?php endif; ?>>
                            <label class="layui-form-label">固定</label>
                            <div class="layui-input-inline">
                            <input type="text"  name="guding" oninput="gaiguding()"  id="g" value="3"  class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">元</div>
                            </div>
                            <div class="foot4" <?php if(config("sfkqsims")==1): ?>style="display:none;"<?php endif; ?>>
                            <input  <?php if(config("sfkqsims")==0): ?>checked<?php endif; ?>  type="checkbox" onChange="dochange()" id="checkbox1" style="margin-right:5px;background:0;border:1px solid #333;" /><span id="suiji1">随机（<span id="start">3</span>到<span id="end">5</span>元)</span>
                            
                            </div>
                            <input type="hidden" name="issuiji" value="<?php if(config("sfkqsims")==0): ?>0<?php else: ?>1<?php endif; ?>" id="issuiji"/>


<input type="hidden" name="isduoge" value="0" id="isduoge"/>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
<button type="button" id="publish_btn" class="btn btn-primary">确认</button>
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








<script type="text/javascript" src="/ckplayer/ckplayer.js" charset="utf-8"></script>


<script type="text/javascript">


   
   
   function dochange(){
if(document.getElementById("checkbox1").checked){
$('#issuiji').val('0');
$('#gd').css('display',"none");
$('#jg').css('display',"block");
}else{
$('#issuiji').val('1');
$('#jg').css('display',"none");
$('#gd').css('display',"block");
}
}
function gais(){
var zuidi=<?php echo config("zuidijiage"); ?>;
var s=$('#s').val();
if(s<zuidi && s!=''){
layer.msg('最低价格不能小于'+zuidi, {icon: 5,time:2000});
return;
}
$('#start').html(s);
}
function gaie(){
var s=$('#s').val();
var e=$('#e').val();
var zuigao=<?php echo config("zuidajiage"); ?>;
if(e>zuigao && e!=""){
layer.msg('最高价格不能大于'+zuigao+'元', {icon: 5,time:2000});
return;
}
$('#end').html(e);
}
function gaiguding(){
var zuidi=<?php echo config("zuidijiage"); ?>;
var zuigao= <?php echo config("zuidajiage"); ?>;
var val=$('#g').val();
var g = parseInt(val);
if(g!="" && g<zuidi){
layer.msg('固定价格不能小于'+zuidi, {icon: 5,time:2000});
$('#g').val(zuidi);
return;
}
if(g!="" && g>zuigao){
layer.msg('固定价格不能大于'+zuigao, {icon: 5,time:2000});
$('#g').val(zuigao);
return;
}
$('#gudingmoney').html(g+"元");
}
    
$(function () {
$("#publish_btn").click(function () {
var id = $("#recipient-id").val();
var guding = $("#g").val();
var title = $("#recipient-name").val();
var start = $("#s").val();
var end = $("#e").val();
var issuiji = $("#issuiji").val();
var isduoge= $("#isduoge").val();
layer.msg('正在处理中', {icon: 1,time:10000});

$.ajax({
type:'POST',
url:'<?php echo url("index"); ?>',
data: {id:id,guding:guding,title:title,start:start,end:end,issuiji:issuiji,isduoge:isduoge},
dataType:'json',
success:function(result){
if(result.code == '1'){
layer.msg(result.msg, {icon: 5,time:2000});
window.location.reload();


}else{
layer.msg(result.msg, {icon: 5,time:2000});
$('#myPublic').modal('hide')
}
}	 
});
});
})



$(document).on('click','.publish_btn', function () {

$('#recipient-id').val($(this).attr('data-id'));

$('#recipient-name').val($(this).attr('data-name'));
$('#recipient-name').show();
$('#isduoge').val('0');
  $('#myPublic').modal('show')
})
$('.ypbtn').on('click', function () {
$('#shipinid').val($(this).attr('data-id'));
})
   
   
   
   
   
   
   
   
   
   
   
    /**
     * [Ajaxpage laypage分页]
     * @param {[type]} curr [当前页]
     */
    Ajaxpage();

    function Ajaxpage(curr){
        var key=$('#key').val();
        $.getJSON('<?php echo url("gongyou/index"); ?>', {
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
 

function edit_gongyou(id){
    location.href = './edit/id/'+id+'.html';
}


function del_gongyou(id){
    dashang.confirm(id,'<?php echo url("del"); ?>');
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
		$('#isduoge').val('1');
		$('#recipient-id').val(ids);
		$('#recipient-name').hide();
		$('#myPublic').modal('show')
	}
	
}) 






	
function play(url) {

var index1=url.lastIndexOf(".");
var index2=url.length;
var suffix=url.substring(index1+1,index2);
if(suffix==""||suffix=="m3u8"){

layer.alert('<div id="a1"  style="width:580px;height:360px;"></div>\
', {
skin: 'layui-layer-molv' ,
area: ['620px', '510px'] 
,closeBtn: 0,btn:['关闭'],
title:"视频预览",
}); 

var flashvars={
		f:'/ckplayer/m3u8.swf',
		a:url,
		s:4,
		c:0
};
	
	var videoObject = {
		container: '#a1',//“#”代表容器的ID，“.”或“”代表容器的class
		variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
		autoplay:true,//自动播放
		video:url//视频地址
	};
	var player=new ckplayer(videoObject);

}else{
layer.alert('<video preload="auto"  controls  style="width:580px;height:430px;"><source src="'+url+'" type="video/mp4"></video>\
', {
skin: 'layui-layer-molv' ,
area: ['620px', '510px'] 
,closeBtn: 0,btn:['关闭'],
title:"视频预览",
}); 
}
$('.layui-layer').css('top','20%');  
}
<?php if($ismobile==1): ?>
function read(id){
	
	window.location="<?php echo url('gongyou/read'); ?>"+"?id="+id;

}
<?php endif; ?>










</script>





</body>
</html>