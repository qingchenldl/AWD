var dashang = {

	//成功弹出层
	success: function(message,url){
		layer.msg(message, {icon: 6,time:2000}, function(index){
            layer.close(index);
            window.location.href=url;
        });
	},

	// 错误弹出层
	error: function(message) {
        layer.msg(message, {icon: 5,time:2000}, function(index){
            layer.close(index);
        });       
    },

	// 确认弹出层
    confirm : function(id,url) {
        layer.confirm('确认删除吗?', {icon: 3, title:'提示'}, function(index){
	        $.getJSON(url, {'id' : id}, function(res){
	            if(res.code == 1){
	                layer.msg(res.msg,{icon:1,time:1500,shade: 0.1},function(){
                        location.reload();
                    });
					
	            }else{
	                layer.msg(res.msg,{icon:0,time:1500,shade: 0.1});
	            }
	        });
	        layer.close(index);
	    })
    },

    //状态
    status : function(id,url){
	    $.post(url,{id:id},function(data){	         
	        if(data.code==1){
	            var a='<span class="label label-danger">禁用</span>'
	            $('#zt'+id).html(a);
	            layer.msg(data.msg,{icon:2,time:1500,shade: 0.1,});
	            return false;
	        }else{
	            var b='<span class="label label-info">开启</span>'
	            $('#zt'+id).html(b);
	            layer.msg(data.msg,{icon:1,time:1500,shade: 0.1,});
	            return false;
	        }         	        
	    });
	    return false;
	},
	 
	fangwen : function(url){
	    $.getJSON(url,function(data){	         
	        if(data.code==1){
	            layer.msg(data.msg,{icon:1,time:1500,shade: 0.1},function(){
                        location.reload();
                    });
	          
	        }else{
	            layer.msg(data.msg,{icon:0,time:1500,shade: 0.1});
	        }         	        
	    });
	    return false;
	},
	
	zhixing : function(id,url){
	    $.getJSON(url,{id:id},function(data){	         
	        if(data.code==1){
	            layer.msg(data.msg,{icon:1,time:1500,shade: 0.1},function(){
                        location.reload();
                    });
	           
	        }else{
	            layer.msg(data.msg,{icon:0,time:1500,shade: 0.1});
	        }         	        
	    });
	    return false;
	}


}