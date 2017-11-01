<?php
$configDB=include 'config.db.php';
$config = array(
	//SESSION设置
	'SESSION_EXPIRE'  =>'600',   // 默认Session有效期（10分钟）

	//模块配置
    'DEFAULT_MODULE'  => 'Home',
    //'URL_MODULE_MAP'  =>    array("test"=>'admin'),

	/*调试配置*/
	'SHOW_PAGE_TRACE' => ture,//开启页面Trace

	'URL_CASE_INSENSITIVE' => true,//url不区分大小写

    'TAGLIB_BEGIN'=>'{',
    'TAGLIB_END'=>'}',

    //预加载自定义标签
    'TAGLIB_PRE_LOAD'    =>    'Common\\LibTag\\Go',

    // URL伪静态后缀设置
    'URL_HTML_SUFFIX'   => '',

    //统一生成小写的URL地址
    'URL_CASE_INSENSITIVE' => true,


);
	return array_merge($configDB,$config);
?>