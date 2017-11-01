<?php
return array(
        // 设置默认的模板主题
        'TMPL_CACHE_ON' => false,
        'DEFAULT_THEME'     =>  get_config_value('site_style'),
        'TMPL_DETECT_THEME' =>  true,
        "THEME_LIST"=>get_all_tpl_theme('string'),
		//更改前台模块目录结构
		'VIEW_PATH' => './Template/',

        'URL_MODEL'=>'1', //URL模式

);