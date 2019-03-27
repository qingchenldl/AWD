<?php

namespace app\dsadmin\validate;
use think\Validate;

class YqmValidate extends Validate
{
    protected $rule = [
        ['yqm', 'unique:yqm', '已经存在']
    ];

}