<?php

return [
    
    'type'           => 'mysql',	     // 数据库类型   
    'hostname'       => 'localhost',     // 服务器地址   
    'database'       => 'ship',     // 数据库名
    'username'       => 'root',	 // 用户名  
    'password'       => 'pppwebppp',	 // 密码
    'hostport'       => '3306',	         // 端口
    'dsn'            => '',	             // 连接dsn
    'params'         => [],	             // 数据库连接参数   
    'charset'        => 'utf8',	         // 数据库编码默认采用utf8   
    'prefix'         => 'ds_',	     // 数据库表前缀   
    'debug'          => false,	         // 数据库调试模式  
    'deploy'         => 0,	             // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)   
    'rw_separate'    => false,	         // 数据库读写是否分离 主从式有效   
    'master_num'     => 1,	             // 读写分离后 主服务器数量  
    'slave_no'       => '',	             // 指定从服务器序号   
    'fields_strict'  => true,	         // 是否严格检查字段是否存在   
    'resultset_type' => 'array',	     // 数据集返回类型 array 数组 collection Collection对象   
    'auto_timestamp' => false,	         // 是否自动写入时间戳字段  
    'sql_explain'    => false,	         // 是否需要进行SQL性能分析
	// +----------------------------------------------------------------------
    // | auth配置
    // +----------------------------------------------------------------------
    'auth_config'  => [
        'auth_on'           => 1, // 权限开关
        'auth_type'         => 1, // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        => 'ds_auth_group', // 用户组数据不带前缀表名
        'auth_group_access' => 'ds_auth_group_access', // 用户-用户组关系不带前缀表
        'auth_rule'         => 'ds_auth_rule', // 权限规则不带前缀表
        'auth_user'         => 'ds_admin', // 用户信息不带前缀表
    ],
	'auth_config2'  => [
        'auth_on'           => 1, // 权限开关
        'auth_type'         => 1, // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        => 'ds_dlauth_group', // 用户组数据不带前缀表名
        'auth_group_access' => 'ds_dlauth_group_access', // 用户-用户组关系不带前缀表
        'auth_rule'         => 'ds_dlauth_rule', // 权限规则不带前缀表
        'auth_user'         => 'ds_member', // 用户信息不带前缀表
    ],
];