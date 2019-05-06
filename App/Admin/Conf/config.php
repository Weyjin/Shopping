<?php
return array(
	//'配置项'=>'配置值'

  '__PUBLIC__'=>__ROOT__.'/Public',

    'DB_TYPE'=>'mysql',
    'DB_HOST'=>'127.0.0.1',
    'DB_USER'=>'root',
    'DB_PWD'=>'.12345678',
    'DB_NAME'=>'shoppingdb',
    'DB_PORT'=>3306,//数据库的端口默认为3306
    '__PUBLIC__' => __ROOT__ . '/Public',
    'DB_FIELDTYPE_CHECK'=>true,  // 开启字段类型验证

    'ADMIN_AUTH_KEY'=>'admin',

    'URL_HTML_SUFFIX'=> '',  // URL伪静态后缀设置,去除html后缀

    //Auth权限设置
    'AUTH_CONFIG' => array(
        'AUTH_ON' => true,  // 认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为实时认证；2为登录认证。
        'AUTH_GROUP' => 'auth_group', // 用户组数据表名
        'AUTH_GROUP_ACCESS' => 'auth_group_access', // 用户-用户组关系表
        'AUTH_RULE' => 'auth_rule', // 权限规则表
        'AUTH_USER' => 'user', // 用户信息表
    ),
);