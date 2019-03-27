<?php

namespace app\dsadmin\validate;
use think\Validate;

class KouliangValidate extends Validate
{
    protected $rule = [
        ['userid', 'unique:kou', '已经存在']
    ];

}