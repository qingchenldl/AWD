<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"D:\wwwroot\154.48.235.148/application/daili/view/siyou/index.html";i:1532793960;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/header.html";i:1530177288;s:67:"D:\wwwroot\154.48.235.148/application/daili/view/public/footer.html";i:1529869102;}*/ ?>
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
            <h5>代理片库(<?php echo $count; ?>个)</h5>
        </div>
        <div class="ibox-content">
           
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
							<th width="3%">影片ID</th>
                               
								
                                <th width="40%">影片名称<?php if($ismobile==0): if(\think\Config::get('dlyulan')==1): ?>（点击预览）<?php endif; endif; ?></th>
								<?php if($ismobile==0): ?>
								 <th width="5%">缩略图</th>
								 <th>价格设置(点击可编辑)</th>
								 
                                <th>创建时间</th>
                               
                                <th>打赏人数</th>
                                <th>短链接</th>
								<?php endif; ?>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                                <tr class="long-td">
								 <td>
									<label class="demo--label"><input class="demo--radio" type="checkbox"   name="ids[]" id="ck-{{d[i].id}}" value="{{d[i].id}}" data-title="{{d[i].name}}" data-url="{{d[i].dwz}}"><span class="demo--checkbox demo--radioInput"></span>{{d[i].id}}</label>
								 
								 </td>
                                  
                                   
                                   <td>
								   <?php if($ismobile==0): ?>
								   <input type="text" name="title[]" class="title  layui-input" data-id="{{d[i].id}}" value="{{d[i].name}}" style="width: 95%;">
<?php if(\think\Config::get('dlyulan')==1): ?><a class="btn2"  onClick="play('{{d[i].url}}')" style="width:5%;"><i class="fa fa-play-circle-o"></i></a><?php endif; else: ?>
									{{d[i].name}}	
									<?php endif; ?>
</td>  
									<?php if($ismobile==0): ?>
									<td><img src="{{d[i].photo}}" onerror="this.src='/static/admin/images/head_default.gif'" style="max-width:100px"></td>
									<td>
									
									<input type="text" class="price price-{{d[i].id}} layui-input" value="{{# if(d[i].money==d[i].sj){ }}{{d[i].money}}{{# }else{ }}{{d[i].sj}}-{{d[i].money}}{{# } }}" data-id="{{d[i].id}}"  style="width: 120px;text-align:center;" data-toggle="tooltip" data-placement="right" title=""> 
									
									</td>  								   
                                   <td>{{d[i].shijian}}</td>      
                                    <td>{{d[i].cs}}</td>
                                   <td><a href='{{d[i].dwz}}'  target='_blank'>{{d[i].dwz}}</a>   <img  onClick="ewm('{{d[i].dwz}}')" src='http://qr.liantu.com/api.php?text={{d[i].dwz}}' width='30px' height='30px' title='点击弹出二维码'></td>
                                    
                                   <?php endif; ?>
                                                         
                                    <td>
                                       
                                        <a href="javascript:;" onclick="del_siyou({{d[i].id}})" class="btn btn-danger btn-xs btn-outline">
                                            <i class="fa fa-trash-o"></i> 删除</a>
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
                <div class="spiner-example">
    <div class="sk-spinner sk-spinner-three-bounce">
        <div class="sk-bounce1"></div>
        <div class="sk-bounce2"></div>
        <div class="sk-bounce3"></div>
    </div>
</div>
				<div class="row">
					<div class="col-sm-12">   
					<div  class="col-sm-12" >
						<div class="input-group" >
						<a class="btn btn-success btn-xs chk-all" href="#" role="button">全选</a><a class="btn btn-danger btn-xs unchk-all" href="#" role="button">全不选</a>
<button class="btn btn-success btn-xs get-links" role="button" data-clipboard-action="copy" data-clipboard-target="#clip-content">批量复制链接</button>
							<a href="javascript:;"><button class="btn btn-danger btn-xs multipleDelete" id="plqr" type="button">批量删除</button></a> 
						</div>
					</div>                                            
                                   
                </div>
				
				<?php if($count !="0"): ?>
				<blockquote class="layui-elem-quote title">操作说明</blockquote>
				<div class="div-c"><br>
				<p  style="margin-left: 22px">1. 点击链接标题可以预览视频</p>
				  <br>
				<p  style="margin-left: 22px">2. 价格直接修改, 鼠标光标离开即时保存</p>
				  <br>
				<p  style="margin-left: 22px">3. 您可以直接修改右边内容, 然后再点击 <span class="btn btn-success btn-xs get-links">批量复制链接</span> 或 <b>手动复制</b></p>
				</div> 
				<div class="div-d"><textarea id="clip-content" style="height: 138px; padding: 10px;width:100%; max-width: 600px;border:1px solid #ddd;resize:none;" ></textarea></div> 
				<?php endif; ?>
				
				
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
function ewm(url) {
layer.alert('<div class="text-center pd20">\<p><img src="http://qr.liantu.com/api.php?text='+url+'" class="img-responsive wp shoukuan" style="max-width:300px;"></p>\</div>\
', {
skin: 'layui-layer-molv' //样式类名
,closeBtn: 0,btn:['关闭'],
title:"扫描二维码进入链接",
}); 
$('.layui-layer').css('top','20%');  
}
</script>
<?php if(\think\Config::get('dlyulan')==1): ?>
<script type="text/javascript">

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
</script>
<?php endif; ?>
<script src="__JS__/clipboard.min.js"></script>
<script type="text/javascript" src="/ckplayer/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript">

	


   $(document).on('change', '.price', function(event) {
		event.preventDefault();
		var id = $(this).attr('data-id'),
		price = $(this).val();
		$.ajax({
		type : "post",
		url : "<?php echo url('editprice'); ?>",
		dataType: "json",  
		async: true,
		data: {id: id, money : price, cz : 'jiage'},
		timeout: 10000 ,
		success : function(data){
		if(data.zt=='1'){  
		
		layer.msg("设置成功",{icon:1,time:1500,shade: 0.1});
		} 
		},
		error:function(){
		}
		});
	});
	
	$(document).on('change', '.title', function(event) {
		event.preventDefault();
		var id  = $(this).attr('data-id'),
		title  = $(this).val();
		//更新标题
		$.ajax({
		type : "post",
		url : "<?php echo url('edittitle'); ?>",
		dataType: "json",  
		async: true,
		data: {id: id, name : title, cz : 'name'},
		timeout: 10000 ,
		success : function(data){
		if(data.zt=='1'){  
		layer.msg("设置成功",{icon:1,time:1500,shade: 0.1});
		} 
		},
		error:function(){
		}
		});
	});
	
	var changeContent = function() {
	var links = $('input[name="ids[]"]:checked');
	var myDate=new Date();
	var contents = "<?php echo \think\Config::get('tsybt'); ?> \r\n 今日推荐视频更新于 <?php echo date('Y-m-d'); ?>  \r\n------------------------ \r\n";
	$.each(links, function(index, val) {
	contents += $(val).attr('data-title') + "\r\n" + $(val).attr('data-url') + "\r\n\r\n";
	});
	contents += " \r\n------------------------ \r\n  <?php echo \think\Config::get('tsyzbts'); ?> \r\n ++++ <?php echo \think\Config::get('tsyjwts'); ?> ++++";
	$('#clip-content').val(contents);
	var clipboard = new Clipboard('.get-links');
	clipboard.on('success', function(e) {
	
	layer.msg('推广链接已经成功复制到您的黏贴板');
	});
	clipboard.on('error', function(e) {
	
	layer.msg('复制失败 请手动复制');
	});
	}
	
	$(document).on('click', '.chk-all', function(event) {
	event.preventDefault();
	$('input[name="ids[]"]').prop('checked', 'checked');
	changeContent();
	});



	$(document).on('click', '.unchk-all', function(event) {
	event.preventDefault();
	$('input[name="ids[]"]').prop('checked', false);
	changeContent();
	});
	$(document).on('change', 'input[name="ids[]"]', function(event) {
	event.preventDefault();
	changeContent();
	});
	
	
	
	
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


 $("#plqr").click(function(){
	
	var aa = document.getElementsByName('ids[]');
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


<?php if($ismobile==1): ?>
function read(id){
	location="<?php echo url('siyou/read'); ?>"+"?id="+id;

}
<?php endif; ?>
</script>
</body>
</html>