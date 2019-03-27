<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Loader;
class Pay extends Controller
{
	public function _initialize()
    {
		$config = cache('db_config_data');

        if(!$config){            
            $config = api('Config/lists');                          
            cache('db_config_data',$config);
        }
        config($config); 
	}
	public function _empty($name)
    {
        return $this->fetch('/Public/404');
    }
	
	public function zidong(){
		$data=input("post.");
		$ip=getIP();
		$ippd=Db::name("ip")->where(['zyid'=>$data['zyid'],"ddh2"=>$data['tradeNo'],"ip"=>$ip,'zt'=>"已付"])->find();
		if(!empty($ippd)){
			echo "success";
		}else{
			echo "fail";
		}
	}
	
	public function wxhuidiao(){
		global $content;
		
		$zhifu=Db::name("zhifu")->where('id',1)->find();
		
		$content=unserialize($zhifu['content']);
		

		Loader::import('com.wxpay.WxPayPubHelper');
		$notify = new \Notify_pub();
		$xml = file_get_contents('php://input');	
		$notify->saveData($xml);
		if($notify->checkSign() == FALSE){
		$notify->setReturnParameter("return_code","FAIL");//返回状态码
		$notify->setReturnParameter("return_msg","签名失败");//返回信息
		}else{
		$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
		}
		$returnXml = $notify->returnXml();
		echo $returnXml;
		
		$log_name="wx.log";//log文件路径
		
		writefile($log_name,"【接收到的notify通知】:\n".$xml."\n"); 
		
		
		if($notify->checkSign() == TRUE){
		if ($notify->data["return_code"] == "FAIL") {
		
		writefile($log_name,"【通信出错】:\n".$xml."\n"); 
		}elseif($notify->data["result_code"] == "FAIL"){
		
		writefile($log_name,"【业务出错】:\n".$xml."\n"); 
		}else{
		$shijian=date('Y-m-d H:i:s' ,time());
		$out_trade_no=$notify->data["out_trade_no"];//
		$weixin=$notify->data["transaction_id"];//微信订单号
		$cymoney=$notify->data["total_fee"]/100;
		$orderNo=$notify->data["attach"];//我提交的订单号
		$order=Db::name("order")->where(['orderid'=>$orderNo])->find();

			

			
			$userid=$order['userid'];	
			$zyid=$order['zyid'];
			$ip=$order['ip'];
		
		$ddh = $orderNo;
		$qudao=$ddh;
		
		if (config("dsklsz") == "1")
			{
				
				$kl = Db::name("kou")->where(['userid'=>$userid])->find();
				
				
				$ns = $kl['ns'];
				if (!empty($kl))
				{
					$cs = $kl['cs'] - 1;
					if ($cs == "0")
					{
						
						$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
						$zymc = $shipin['name'];
						
						$user = Db::name("member")->where(['id'=>$userid])->find();
						$name = $user['name'];
						
						$data=[];
						$data['name']=$name;
						$data['userid']=$userid;
						$data['ddh']=$ddh;
						$data['qudao']=$qudao;
						$data['money']=$cymoney;
						$data['shijian']=$shijian;
						$data['zymc']=$zymc;
						Db::name("kl")->insert($data);
						
						Db::name("kou")->where(['userid'=>$userid])->update(['cs'=>$ns]);
						
						
						//不扣量
						//Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
						Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
						
						////
						$ddh2 = substr($ddh, 0, 10);
						
						
						$data=[];
						$data['ip']=$ip;
						$data['userid']=$userid;
						$data['ddh']=$ddh2;
						$data['zyid']=$zyid;
						$data['ddh2']=$ddh;
						$data['zt']="已付";
						$data['shijian']=time();
						Db::name("ip")->insert($data);
						
						
					}
					else
					{
						
						
						Db::name("kou")->where(['userid'=>$userid])->setDec("cs");
						
						//写自己的数据库
						
						
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$weixin;
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
						//写自己的数据库
					}
					//不扣量
					//代理ID没添加扣量参数
				}
				else
				{
					//写自己的数据库
					
					
					
					
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$weixin;
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
					
					
					
					
					
					
					
					//写自己的数据库

				}
				//代理ID没添加扣量参数
				//扣量开关关闭
			}
			else
			{
				
						
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$weixin;
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
					
				//写自己的数据库
			}
			//扣量开关关闭
		
		}
		}
		
	}
	
	public function uzhifu(){
		$shijian = date('Y-m-d H:i:s', time());


	
	//$itemname = $_REQUEST["itemname"];//订单号
	//$itemname ="8Rg4j0XlWB20180416220105";	

		$zhifu=Db::name("zhifu")->where('id',1)->find();
		
		$content=unserialize($zhifu['content']);

		$qudao = input('ddh')!=''?input('ddh'):0;		
		$Money2		=	input('PayJe')!=''?input('PayJe'):0;			//付款金额
		$cymoney      =   floatval($Money2);
		$itemname		=	input('PayMore')!=''?input('PayMore'):"";//付款说明
		$key		=	input('key')!=''?input('key'):"";			//签名
		$key2 	= $content['ukey'];// 不要随意修改


		$bjsnk = strcmp($key2,$key);

		//-----------------------------------------------------------------
		if ($bjsnk===0)
		{	
			

			
			//读取临时订单号信息	
			
			$order=Db::name("order")->where(['orderid'=>$itemname])->find();

			

			
			$userid=$order['userid'];	
			$zyid=$order['zyid'];
			$ip=$order['ip'];
			
			$ddh = $itemname;
			//$qudao = $_REQUEST["serialno"];  //ddh
			//$qudao ="23423423423423565765675756";
			
			
			//$cymoney = $_REQUEST["amount"];
			//$cymoney =4.4;
			
			//$cymoney = $cymoney/100;

		 
		 //app服务器处理相关事务 TODO
		if (true)
		{
			echo 'success';
			//扣量设置
			
			if (config("dsklsz") == "1")
			{
				
				$kl = Db::name("kou")->where(['userid'=>$userid])->find();
				
				
				$ns = $kl['ns'];
				if (!empty($kl))
				{
					$cs = $kl['cs'] - 1;
					if ($cs == "0")
					{
						
						$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
						$zymc = $shipin['name'];
						
						$user = Db::name("member")->where(['id'=>$userid])->find();
						$name = $user['name'];
						
						$data=[];
						$data['name']=$name;
						$data['userid']=$userid;
						$data['ddh']=$ddh;
						$data['qudao']=$qudao;
						$data['money']=$cymoney;
						$data['shijian']=$shijian;
						$data['zymc']=$zymc;
						Db::name("kl")->insert($data);
						
						Db::name("kou")->where(['userid'=>$userid])->update(['cs'=>$ns]);
						
						
						//不扣量
						//Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
						Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
						
						////
						$ddh2 = substr($ddh, 0, 10);
						
						
						$data=[];
						$data['ip']=$ip;
						$data['userid']=$userid;
						$data['ddh']=$ddh2;
						$data['zyid']=$zyid;
						$data['ddh2']=$ddh;
						$data['zt']="已付";
						$data['shijian']=time();
						Db::name("ip")->insert($data);
						
						
					}
					else
					{
						
						
						Db::name("kou")->where(['userid'=>$userid])->setDec("cs");
						
						//写自己的数据库
						
						
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$qudao;
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
						//写自己的数据库
					}
					//不扣量
					//代理ID没添加扣量参数
				}
				else
				{
					//写自己的数据库
					
					
					
					
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$qudao;
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
					
					
					
					
					
					
					
					//写自己的数据库

				}
				//代理ID没添加扣量参数
				//扣量开关关闭
			}
			else
			{
				
						
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$qudao;
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
					
				//写自己的数据库
			}
			//扣量开关关闭
		}
		else
		{
			echo 'error';
		}

		}
		else
		{ 
		echo "Key";	//钥匙不正确
		//file_put_contents('6post.txt',"Key");
		} 
		
		
	}
    public function dunpay()
    {
		
       $ip= getIP();

		$ubodingdan =input("get.ddh"); //提交订单号 . date("YmdHis")
		$ubomoney = input("get.money");//提交的支付金额
		$userid = input("get.userid");//提交的用户ID
		$zyid = input("get.zyid");
		$code=input("get.code");

		
		$ubodingdannew = $ubodingdan.random(4).$userid.date("YmdHis");
		$order=Db::name("order")->where(['orderid'=>$ubodingdannew])->find();

		if(empty($order)){

		
		 $data=[];
		 $data['orderid']=$ubodingdannew;
		 $data['ip']=$ip;
		 $data['userid']=$userid;
		 $data['zyid']=$zyid;
		 $data['shijian']=time();
		 $data['money']=$ubomoney;
		 Db::name("order")->insert($data);
		}
		
		if(config("zfjk")==1){
			
			$ubomoney=$ubomoney*100;
			
			$zhifu=Db::name("zhifu")->where('id',1)->find();
		
			$content=unserialize($zhifu['content']);
			
			$state = json_encode(array("fee" => "$ubomoney", "ddh" => "$ubodingdannew",'codehou'=>$code.'|'.$ubodingdan));
			
			$xieyi=is_HTTPS()?"https://":"http://";
			$ename=$xieyi.$content['gzhename'];
			

$tzurl='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$content['wxappid'].'&redirect_uri='.urlencode($ename."/index.php/index/pay/wxzhifu.html").'&response_type=code&scope=snsapi_base&state='.$state.'&connect_redirect=1#wechat_redirect';
			
			$this->redirect($tzurl);
			exit;
			
			
		}
		if(config("zfjk")==2){
			echo '<form name="form"  id="payment" accept-charset="UTF-8" action="/ldpay/alipay.php" method="post" ><input name="out_trade_no" id="out_trade_no"  type="hidden" value="'.$ubodingdannew.'" />
	<input name="total_fee" id="total_fee"  type="hidden" value="'.$ubomoney.'" />
	<input name="url" id="url"  type="hidden" value="'.$zyid.'" />

	<input name="tiaozhuan" id="tiaozhuan"  type="hidden" value="/'.config('ffhouzhui').'?code='.$code.'|'.$ubodingdan.'" />

	<input type="submit" class="ui-btn"  onclick="javascript:document.charset=\'UTF-8\';document.getElementById(\'payment\').submit()"  value="hide" style="display:none" align="left" />
	</form><script>document.forms[\'payment\'].submit();</script>';
			exit;
		}
		if(config("zfjk")==3){
			$user_agent=$_SERVER['HTTP_USER_AGENT'];
			if (strpos($user_agent, 'MicroMessenger') === false) {
				$zhifu=Db::name("zhifu")->where('id',1)->find();
		
				$content=unserialize($zhifu['content']);
				$totalMoney=$ubomoney*100;
				//$totalMoney=1;
				$version="1.0";
				$merId=$content['merId'];
				$orderId=$ubodingdannew;
				$tradeType="wechat_app";
				$describe=config("zhifuxianshi");
				$xieyi=is_HTTPS()?"https://":"http://";
				$notify=$xieyi.$_SERVER['HTTP_HOST']."/index.php/index/pay/yunzhifu.html";
				$redirectUrl=$xieyi.$_SERVER['HTTP_HOST']."/index.php/index/pay/notifyyunzhifu/orderId/".$orderId;
				$fromtype="wap2";
				$key=$content['key'];
				$ip=getIP();
				$sign=strtoupper(md5("merId=$merId&orderId=$orderId&totalMoney=$totalMoney&tradeType=$tradeType&$key"));
				$data=['version'=>$version,"merId"=>$merId,"notify"=>$notify,"orderId"=>$orderId,"redirectUrl"=>$redirectUrl,"remark"=>"购买物品","sign"=>$sign,"totalMoney"=>$totalMoney,"tradeType"=>$tradeType,"describe"=>$describe,"fromtype"=>$fromtype,"ip"=>$ip];
				$param=json_encode($data);
				$url="http://mms.teanmar.com:8000/ltPayBusiness/order/prepareOrder";
				$rdata=$this->http_post_data($url,$param);
				$res=json_decode($rdata,true);
				
				$this->redirect($res['object']['wxPayWay']);
				exit;

			}else{
				
				 return $this->fetch("yunpay");
			}

		}


		if(config("zfjk")==4){
			$user_agent=$_SERVER['HTTP_USER_AGENT'];
			if (strpos($user_agent, 'MicroMessenger') === false) {
			$zhifu=Db::name("zhifu")->where('id',1)->find();

			$content=unserialize($zhifu['content']);
			$totalMoney=$ubomoney*100;
			$preorderApi = "http://".$content['wangguan']."/platform/pay/unifiedorder";//下单接口，以文档为准
			$mch_id = $content['mch_id']; //商户号
			$key = $content['key'];
			$body=config("zhifuxianshi");//商品
			$total_fee=$totalMoney;//价格
			$spbill_create_ip=getIP();//客户端ip


			$xieyi=is_HTTPS()?"https://":"http://";
			$notify_url=$xieyi.$_SERVER['HTTP_HOST']."/index.php/index/pay/yinshengzhifu.html";
			$redirect_url=$xieyi.$_SERVER['HTTP_HOST']."/index.php/index/pay/notifyyunzhifu/orderId/".$ubodingdannew;

			
			$trade_type="WX";//支付方式
			$out_trade_no=$ubodingdannew;

			$signstr="body=".$body."&mch_id=".$mch_id."&notify_url=".$notify_url."&out_trade_no=".$out_trade_no."&redirect_url=".$redirect_url."&spbill_create_ip=".$spbill_create_ip."&total_fee=".$total_fee."&trade_type=".$trade_type."&key=".$key;

			$sign = md5($signstr);
			$params=[];
			$params["sign"] = $sign;//签名
			$params["mch_id"] = $mch_id;
			$params["body"] = $body;
			$params["total_fee"] = $total_fee;
			$params["spbill_create_ip"] = $spbill_create_ip;
			$params["notify_url"] = $notify_url;
			$params["redirect_url"] = $redirect_url;
			$params["trade_type"] = $trade_type;
			$params["out_trade_no"] = $out_trade_no;
			
			$wxurl=$preorderApi . "?" . http_build_query($params);


			$this->assign("wxurl",$wxurl);
			$this->redirect($wxurl);
				exit;
			
			


			}else{
				
				 return $this->fetch("yunpay");
			}

		}
    }



    public function paraFilters($para) {
	    $para_filter = array();
	    while (list ($key, $val) = each ($para)) {
	        if($key == "sign" || $val == "")continue;
	        else    $para_filter[$key] = $para[$key];
	    }
	    return $para_filter;
	}

	public function argSorts($para) {
	    ksort($para);
	    reset($para);
	    return $para;
	}

	public function local_sign($datas = array(), $key = ''){
	    $str = http_build_query($this->argSorts($this->paraFilters($datas)));
	    $sign = md5($str."&key=".$key);
	    return $sign;
	}

    public function yinshengzhifu(){
			$data=file_get_contents("php://input");
			
			
			$log_name="yinsheng.log";//log文件路径
			parse_str($data,$res);
		

			$zhifu=Db::name("zhifu")->where('id',1)->find();
		
			$content=unserialize($zhifu['content']);

			

			if($res['total_fee']!=0){

			

				$appkey = $content['notifyKey'];

				$params = array(
				    "mch_id" => $res["mch_id"], 
				    "payment_time" => $res["payment_time"], 
				    "total_fee" => $res["total_fee"],
				    "trade_no" => $res["trade_no"], 
				    "out_trade_no" => $res["out_trade_no"]
				);

				$sign = $this->local_sign($params, $appkey);


				if ($sign != $res["sign"]) {
				    exit("invalid sign");
				}

				
				if($sign==$res['sign']){

					//读取临时订单号信息	
					$itemname=$res['out_trade_no'];
					$order=Db::name("order")->where(['orderid'=>$itemname])->find();

			

			
					$userid=$order['userid'];	
					$zyid=$order['zyid'];
					$ip=$order['ip'];
					
					$ddh = $itemname;
					$cymoney=$res['total_fee']/100;
					$qudao=$ddh;
					$shijian=date('Y-m-d H:i:s' ,time());
					if (config("dsklsz") == "1")
			{
				
				$kl = Db::name("kou")->where(['userid'=>$userid])->find();
				
				
				$ns = $kl['ns'];
				if (!empty($kl))
				{
					$cs = $kl['cs'] - 1;
					if ($cs == "0")
					{
						
						$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
						$zymc = $shipin['name'];
						
						$user = Db::name("member")->where(['id'=>$userid])->find();
						$name = $user['name'];
						
						$data=[];
						$data['name']=$name;
						$data['userid']=$userid;
						$data['ddh']=$ddh;
						$data['qudao']=$qudao;
						$data['money']=$cymoney;
						$data['shijian']=$shijian;
						$data['zymc']=$zymc;
						Db::name("kl")->insert($data);
						
						Db::name("kou")->where(['userid'=>$userid])->update(['cs'=>$ns]);
						
						
						//不扣量
						//Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
						Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
						
						////
						$ddh2 = substr($ddh, 0, 10);
						
						
						$data=[];
						$data['ip']=$ip;
						$data['userid']=$userid;
						$data['ddh']=$ddh2;
						$data['zyid']=$zyid;
						$data['ddh2']=$ddh;
						$data['zt']="已付";
						$data['shijian']=time();
						Db::name("ip")->insert($data);
						
						
					}
					else
					{
						
						
						Db::name("kou")->where(['userid'=>$userid])->setDec("cs");
						
						//写自己的数据库
						
						
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$res['trade_no'];
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
						//写自己的数据库
					}
					//不扣量
					//代理ID没添加扣量参数
				}
				else
				{
					//写自己的数据库
					
					
					
					
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$res['trade_no'];
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
					
					
					
					
					
					
					
					//写自己的数据库

				}
				//代理ID没添加扣量参数
				//扣量开关关闭
			}
			else
			{
				
						
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$res['trade_no'];
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
					
				//写自己的数据库
			}

					echo "success"; 
				}
			}

			
	}
	public function notifyyunzhifu(){
		$itemname=input("orderId");

		$order=Db::name("order")->where(['orderid'=>$itemname])->find();

			

			
			$userid=$order['userid'];	
			$zyid=$order['zyid'];
			$ip=$order['ip'];
			
			$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
			$ddh2 = substr($itemname, 0, 10);

			$xieyi=is_HTTPS()?"https://":"http://";
			$tzurl =$xieyi.$_SERVER['HTTP_HOST']."/".config('ffhouzhui')."?code=".$shipin['zykey']."|".$ddh2;
			$this->assign("zyid",$zyid);
			$this->assign("tradeNo",$itemname);
			$this->assign("urlok",$tzurl);
			return $this->fetch();
	}

	public function yunzhifu(){
			$data=input("get.");
			$res=$data;
			
			$zhifu=Db::name("zhifu")->where('id',1)->find();
		
			$content=unserialize($zhifu['content']);

			

			if($res['code']==0){
				$sign=strtoupper(md5("code".$res['code']."merId".$res['merId']."money".$res['money']."orderId".$res['orderId']."payWay".$res['payWay']."remark".$res['remark']."time".$res['time']."tradeId".$res['tradeId'].$content['notifyKey']));
				if($sign==$res['sign']){

					//读取临时订单号信息	
					$itemname=$res['orderId'];
					$order=Db::name("order")->where(['orderid'=>$itemname])->find();

			

			
					$userid=$order['userid'];	
					$zyid=$order['zyid'];
					$ip=$order['ip'];
					
					$ddh = $itemname;
					$cymoney=$res['money']/100;
					$qudao=$ddh;
					$shijian=date('Y-m-d H:i:s' ,time());
					if (config("dsklsz") == "1")
			{
				
				$kl = Db::name("kou")->where(['userid'=>$userid])->find();
				
				
				$ns = $kl['ns'];
				if (!empty($kl))
				{
					$cs = $kl['cs'] - 1;
					if ($cs == "0")
					{
						
						$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
						$zymc = $shipin['name'];
						
						$user = Db::name("member")->where(['id'=>$userid])->find();
						$name = $user['name'];
						
						$data=[];
						$data['name']=$name;
						$data['userid']=$userid;
						$data['ddh']=$ddh;
						$data['qudao']=$qudao;
						$data['money']=$cymoney;
						$data['shijian']=$shijian;
						$data['zymc']=$zymc;
						Db::name("kl")->insert($data);
						
						Db::name("kou")->where(['userid'=>$userid])->update(['cs'=>$ns]);
						
						
						//不扣量
						//Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
						Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
						
						////
						$ddh2 = substr($ddh, 0, 10);
						
						
						$data=[];
						$data['ip']=$ip;
						$data['userid']=$userid;
						$data['ddh']=$ddh2;
						$data['zyid']=$zyid;
						$data['ddh2']=$ddh;
						$data['zt']="已付";
						$data['shijian']=time();
						Db::name("ip")->insert($data);
						
						
					}
					else
					{
						
						
						Db::name("kou")->where(['userid'=>$userid])->setDec("cs");
						
						//写自己的数据库
						
						
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$res['tradeId'];
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
						//写自己的数据库
					}
					//不扣量
					//代理ID没添加扣量参数
				}
				else
				{
					//写自己的数据库
					
					
					
					
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$res['tradeId'];
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
					
					
					
					
					
					
					
					//写自己的数据库

				}
				//代理ID没添加扣量参数
				//扣量开关关闭
			}
			else
			{
				
						
						$row=Db::name("dingdan")->where(['ddh'=>$qudao])->find();
						
						
						if (empty($row))
						{
							///更新会员金额
							$user = Db::name("member")->where(['id'=>$userid])->find();
							
							if (!empty($user))
							{
								if ($cymoney < 1)
								{
									$money2 = $cymoney;
								}
								else
								{
									$money2 = $cymoney - (($cymoney * $user['txfeilv']) / 100);
								}
								$money = $user['money'] + $money2;
								
								Db::name("member")->where(['id'=>$userid])->update(['money'=>$money]);
							}
							
							$shipin = Db::name("siyou")->where(['id'=>$zyid])->find();
							$zymc = $shipin['name'];
							if (!empty($shipin))
							{
								Db::name("siyou")->where(['id'=>$zyid])->setInc("cs");
								Db::name("gongyou")->where(['id'=>$shipin['pid']])->setInc("cs");
							}
							
							$data=[];
							$data['zyid']=$zyid;
							$data['userid']=$userid;
							$data['zymc']=$zymc;
							$data['ddh']=$ddh;
							$data['money']=$cymoney;
							$data['shijian']=$shijian;
							$data['wxddh']=$res['tradeId'];
							Db::name("dingdan")->insert($data);
							
							
							$ddh2 = substr($ddh, 0, 10);
							
							$data=[];
							$data['ip']=$ip;
							$data['userid']=$userid;
							$data['ddh']=$ddh2;
							$data['zyid']=$zyid;
							$data['ddh2']=$ddh;
							$data['zt']="已付";
							$data['shijian']=time();
							Db::name("ip")->insert($data);
						}
					
				//写自己的数据库
			}

					echo "success"; 
				}
			}

			
	}

	public function http_post_data($url, $data_string) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/json; charset=utf-8",
			"Content-Length: " . strlen($data_string))
		);
		ob_start();
		curl_exec($ch);
		$return_content = ob_get_contents();
		ob_end_clean();
		$return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		return $return_content;
	}

	
    
	public function wxzhifu(){
		global $content;
		Loader::import('com.wxpay.WxPayPubHelper');
		$code=input("code");
		
		$zhifu=Db::name("zhifu")->where('id',1)->find();
		
		$content=unserialize($zhifu['content']);
		
		$jsApi = new \JsApi_pub();
		if (empty($code)){
		$xieyi=is_HTTPS()?"https://":"http://";

		
		$ename=$content['gzhename'];

		
		
		$tzurl="http://".$ename."/index.php/index/pay/wxzhifu.html";
		

		//$tzurl=$ename."/index.php/index/pay/wxzhifu.html";
		
		$url = $jsApi->createOauthUrlForCode($tzurl);
		$state="11";
		$url = str_replace("STATE", $state, $url);
		$this->redirect($url);
		
		}else{
		   
		$jsApi->setCode($code);	
		$openid = $jsApi->getOpenId();
		$state=input("state");		
		$state = str_replace("\\", "", $state);	
		
		
		$param = json_decode($state, true);
		$total_fee= $param['fee'];
		$out=$param['ddh'];
		$codehou=$param['codehou'];

		
		
		$ename=$content['shename'];

		

		$url2="http://".$ename.url('weixinpay').'?money='.$total_fee."&ddh=".$out."&codehou=".$codehou."&openid=".$openid;
		//echo  "<script>location.href='$url2'</script>";  
		$this->redirect($url2);
		}
		
	}
	public function weixinpay(){
		global $content;
      
		Loader::import('com.wxpay.WxPayPubHelper');
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {
		}else{
			
		$zhifu=Db::name("zhifu")->where('id',1)->find();
		
		$content=unserialize($zhifu['content']);
		
		$jsApi = new \JsApi_pub();
		$out=input('ddh'); 
		$total_fee=input('money'); 
		$codehou=input('codehou');
		
		
		$openid =input("openid");
		
		$xieyi=is_HTTPS()?"https://":"http://";

		$ename=Db::name("ename")->where(['status'=>1])->order("id desc")->find();
		
		
		
		if(empty($ename)||config('ksymkg')==0){
			$ename="http://".$_SERVER['HTTP_HOST'];
			
			
		}else{
			$ename="http://".$ename['ename'];
			
		}

		$tzurl =$ename."/".config('ffhouzhui')."?code=".$codehou;




		//$money=$total_fee/100;
		$timeStamp =time();
		$out_trade_no = $content['appid'].random(4)."$timeStamp";
		$body=config("zhifuxianshi");
		$unifiedOrder = new \UnifiedOrder_pub();
		$unifiedOrder->setParameter("openid","$openid");//商品描述
		$unifiedOrder->setParameter("body","$body");//商品描述
		$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
		$unifiedOrder->setParameter("total_fee",$total_fee);//总金额
		$unifiedOrder->setParameter("notify_url",$xieyi.$_SERVER['HTTP_HOST']."/index.php/index/pay/wxhuidiao");//通知地址 
		$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
		$unifiedOrder->setParameter("attach","$out");//附加数据 
		$prepay_id = $unifiedOrder->getPrepayId();
		$jsApi->setPrepayId($prepay_id);
		$jsApiParameters = $jsApi->getParameters();
		
		$this->assign("jsApiParameters",$jsApiParameters);
		$this->assign("tzurl",$tzurl);
		 return $this->fetch();
		}
		
		
		
	}
	
	
}
