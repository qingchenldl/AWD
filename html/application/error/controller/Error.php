<?php
namespace app\error\controller;
use think\Controller;
class Error extends Controller
{
	
	public function _empty($name)
    {
        return $this->fetch('/Public/404');
    }
    public function index()
    {
        return $this->fetch('/Public/404');
    }
	
}
