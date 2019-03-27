<?php
/**
 * Created by PhpStorm.
 * Power By Mikkle
 * Email：776329498@qq.com
 * Date: 2017/8/30
 * Time: 9:21
 */
namespace mikkle\tp_wxpay;

class  SDKRuntimeException extends \think\Exception {
	public function errorMessage()
	{
		return $this->getMessage();
	}

}

