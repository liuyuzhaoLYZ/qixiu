<?php
return array(
	//'配置项'=>'配置值'

	//模版常量
	'TMPL_PARSE_STRING' => array(
						'__ADMIN__' => __ROOT__.'/Public/Admin'
					),

	/* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'db_oa',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '123456',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sp_',    // 数据库表前缀
    'DEFAULT_FILTER' => 'trim,htmlspecialchars',

        //RBAC权限数据信息
    //角色数组
    'RBAC_ROLES'            =>      array(
                                1   =>  '高层管理',
                                2   =>  '中层领带',
                                3   =>  '普通职员'
                            ),
    //权限数组（关联角色数组）
    'RBAC_ROLE_AUTHS'       =>      array(
                                1   =>  '*/*',//拥有全部的权限
                                2   =>  array('index/*','email/*','doc/*','knowledge/*'),
                                3   =>  array('index/*','email/*','knowledge/*','doc/add')
                            ),
);