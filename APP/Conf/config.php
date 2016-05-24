<?php
return array(
	//'配置项'=>'配置值'
    'DB_HOST' => '127.0.0.1',   //数据库地址
    'DB_USER' => 'root',   //数据库用户名
    'DB_PWD' => '',   //数据库密码
    'DB_NAME' => 'thinkblog',   //数据库名
    'DB_PREFIX' => 'thinkblog_',   //数据库表前缀

    'APP_GROUP_LIST' => 'Index,Admin',     //分组列表
    'DEFAULT_GROUP' => 'Index',     //默认分组
    'APP_GROUP_MODE' => 1,      //开启独立分组
    'APP_GROUP_PATH' => 'Modules',   //默认path路径
    'LOAD_EXT_CONFIG' => 'verify,water',  //加载多个扩展配置文件

    //'SHOW_PAGE_TRACE' => true,  //开启显示调试模式
);
?>