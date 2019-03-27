<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"D:\wwwroot\154.48.235.148/application/dsadmin/view/tousu/index.html";i:1530708872;s:69:"D:\wwwroot\154.48.235.148/application/dsadmin/view/public/header.html";i:1484102488;s:69:"D:\wwwroot\154.48.235.148/application/dsadmin/view/public/footer.html";i:1529869102;}*/ ?>
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
<div class="wrapper wrapper-content animated ftousueInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>投诉列表</h5>
        </div>
        <div class="ibox-content">        
           
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thetousu>
                            <tr class="long-tr">
                                <th>ID</th>
                                <th>ip</th>
                               
                               
                               
                                
                                <th>内容</th>
								
                                <th>状态</th>
								 <th>时间</th>
                                <th width="15%">操作</th>
                            </tr>
                        </thetousu>
                        <script id="arlist" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}

                            <tr class="long-td">
                                <td>{{d[i].id}}</td>
                                <td>{{d[i].ip}}</td>
                                <td>{{d[i].neirong}}</td>
                                                      
                               
                                
                                
                                         <td>{{d[i].zt}}</td> 
<td>{{d[i].shijian}}</td>   										 
                                <td>	
									<a href="javascript:;" onclick="yx_tousu({{d[i].id}})" class="btn btn-primary btn-xs btn-outline">
                                            <i class="fa fa-paste"></i> 允许访问</a>&nbsp;&nbsp;		
									 <a href="javascript:;" onclick="jz_tousu({{d[i].id}})" class="btn btn-danger btn-xs btn-outline">
                                        <i class="fa fa-trash-o"></i> 禁止访问</a>&nbsp;&nbsp;		
									
                                    <a href="javascript:;" onclick="del_tousu({{d[i].id}})" class="btn btn-danger btn-xs btn-outline">
                                        <i class="fa fa-trash-o"></i> 删除</a>
                                </td>
                            </tr>
                            {{# } }}
                        </script>
                        <tbody id="article_list"></tbody>
                    </table>
                    <div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: right;"></div>
                </div>
            </div>
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
   
    /**
     * [Ajaxpage laypage分页]
     * @param {[type]} curr [当前页]
     */ 
    function Ajaxpage(curr){

        var key=$('#key').val();
        $.getJSON('<?php echo url("tousu/index"); ?>', {
            page: curr || 1,key:key
        }, function(data){      //data是后台返回过来的JSON数据

            $(".spiner-example").css('display','none'); //数据加载完关闭动画           
            if(data==''){
                $("#article_list").html('<td colspan="20" style="ptousuding-top:10px;ptousuding-bottom:10px;font-size:16px;text-align:center">暂无数据</td>');
            }else{
                article_list(data); //模板赋值
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

    Ajaxpage();

/**
 * [article_list 接收异步获取的数据渲染到模板]

 */
function article_list(list){

    var tpl = document.getElementById('arlist').innerHTML;
    laytpl(tpl).render(list, function(html){
        document.getElementById('article_list').innerHTML = html;
    });
}


/**
 * [edit_tousu 编辑投诉]

 */ 
function edit_tousu(id){

    location.href = './edit_tousu/id/'+id+'.html';
}


/**
 * [del_tousu 删除投诉]

 */
function del_tousu(id){
    layer.confirm('确认删除此投诉?', {icon: 3, title:'提示'}, function(index){
        $.getJSON('./del', {'id' : id}, function(res){
            if(res.code == 1){
                layer.msg(res.msg,{icon:1,time:1500,shtousue: 0.1});
                Ajaxpage(1,5)
            }else{
                layer.msg(res.msg,{icon:0,time:1500,shtousue: 0.1});
            }
        });

        layer.close(index);
    })

}

function jz_tousu(id){
   
        $.getJSON('./jz_tousu', {'id' : id}, function(res){
            if(res.code == 1){
                layer.msg(res.msg,{icon:1,time:1500,shtousue: 0.1});
                Ajaxpage(1,5)
            }else{
                layer.msg(res.msg,{icon:0,time:1500,shtousue: 0.1});
            }
        });

        layer.close(index);
    

}

function yx_tousu(id){
   
        $.getJSON('./yx_tousu', {'id' : id}, function(res){
            if(res.code == 1){
                layer.msg(res.msg,{icon:1,time:1500,shtousue: 0.1});
                Ajaxpage(1,5)
            }else{
                layer.msg(res.msg,{icon:0,time:1500,shtousue: 0.1});
            }
        });

        layer.close(index);
    

}


</script>
</body>
</html>