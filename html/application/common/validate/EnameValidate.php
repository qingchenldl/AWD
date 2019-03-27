<?php

namespace app\common\validate;

use think\Validate;

class EnameValidate extends Validate
{
    protected $rule = [
        ['ename', 'require', '域名不能为空']
    ];

}