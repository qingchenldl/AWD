<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"/www/wwwroot/ds/application/dsadmin/view/pay/hedui.html";i:1530125186;s:59:"/www/wwwroot/ds/application/dsadmin/view/public/header.html";i:1484102488;s:59:"/www/wwwroot/ds/application/dsadmin/view/public/footer.html";i:1529869102;}*/ ?>
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
            <h5><?php echo $userid; ?>核对订单 </h5>
        </div>
        <div class="ibox-content">
            
           
			 <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
								<th>待支付笔数</th>
                                <th>待支付金额 </th>
                                <th>已支付笔数 </th>
								<th>已支付金额 </th>
								<th>总订单笔数 </th>
								<th>总订单金额 </th>
								<th>实际得款(扣除费率后) </th>
								<th>账户余额 </th>
								<th>历史提款金额记录 </th>
								
                            </tr>
                        </thead>
                       
                          
                           
                        <tbody >  
							
							<tr class="long-td">
								 <td><?php echo $dzfbs; ?></td>
                                <td><?php echo $money1; ?>元</td>
                               <td><?php echo $yzfbs; ?></td>
                                <td><?php echo $money2; ?>元</td>
							   <td><?php echo $zddbs; ?></td>
                                <td><?php echo $money3; ?>元</td>
                               <td><?php echo $sjmoney; ?>元</td>
							    <td><?php echo $member['money']; ?>元</td>
								<td><?php echo $member['txmoney']; ?>元</td>
                            </tr>
						</tbody>
                    </table>
                  
                </div>
				
				<div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
								<th>今天订单笔数</th>
                                <th>今天订单金额 </th>
                                <th>昨日订单笔数 </th>
								<th>昨日订单金额 </th>
								<th>最近七天订单笔数 </th>
								<th>最近七天订单金额 </th>
								<th>最近一月订单笔数</th>
								<th>最近一月订单金额 </th>
								
								
                            </tr>
                        </thead>
                       
                          
                           
                        <tbody >  
							
							<tr class="long-td">
								 <td><?php echo $jrddbs; ?></td>
                                <td><?php echo $jrddje; ?>元</td>
                               <td><?php echo $zrddbs; ?></td>
                                <td><?php echo $zrddje; ?>元</td>
							   <td><?php echo $qrddbs; ?></td>
                                <td><?php echo $qrddje; ?>元</td>
                               <td><?php echo $ssrddbs; ?></td>
							    <td><?php echo $ssddje; ?>元</td>
								
                            </tr>
						</tbody>
                    </table>
                  
                </div>
				
				
            </div>
			
			
            
            
            <!-- End Example Pagination -->
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
</body>
</html>