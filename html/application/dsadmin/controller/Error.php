<?php
namespace app\dsadmin\controller;
use think\Config;
use think\Loader;
use think\Db;

class Error extends Base
{
    public function index()
    {
		return $this->fetch('/index');	
    }


}