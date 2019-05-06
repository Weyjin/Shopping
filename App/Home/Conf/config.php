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
    'URL_HTML_SUFFIX'=> '',  // URL伪静态后缀设置,去除html后缀
    'TMPL_EXCEPTION_FILE'   =>  './Public/exception.html'// 异常页面的模板文件
);