<?php

namespace app\dsadmin\validate;

use think\Validate;

class GonggaoValidate extends Validate
{
    protected $rule = [
       'title|标题'  => 'require',
       

    ];

}