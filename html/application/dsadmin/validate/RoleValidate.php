<?php

namespace app\dsadmin\validate;
use think\Validate;

class RoleValidate extends Validate
{
    protected $rule = [
        ['title', 'unique:auth_group', '角色已经存在']
    ];

}