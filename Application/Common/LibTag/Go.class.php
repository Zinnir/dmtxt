<?php
namespace Common\LibTag;
use Think\Template\TagLib;

/**
 * Class Green
 * @package Think\Template\TagLib
 */
class Go extends TagLib
{


    // 标签定义
    /**
     * @var array
     */
    protected $tags = array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'include' => array(
                'attr' => 'filename,title,keyword',
                'close'=>0
        ),
        //全局属性
        'global' => array(
                'attr' => 'name',
                'close'=>0
        ),
        //栏目
        'nav'	=> array(
                'attr'	=> 'model_id,alias,type,orderby,limit',
                'close'	=> 1,
        ),

    );

    public function _include($tag, $content)
    {
        $filename = $tag ['filename'];
        $filepath = C('VIEW_PATH').C('DEFAULT_THEME').'/'.$filename;
        $parseStr = "<?php include '".$filepath."'; ?>";

        return $parseStr;
    }

    public function _global($tag, $content)
    {
        $name = $tag ['name'];
        if($name == 'theme_path'){
            $value = get_theme_path();
        }else if ($name == 'css_path'){
            $value = get_theme_path().'/css';
        }else if ($name == 'js_path'){
            $value = get_theme_path().'/js';
        }else if ($name == 'images_path'){
            $value = get_theme_path().'/images';
        }else if ($name == 'index_url'){
            $value = __ROOT__;
        }else{
            $value = get_config_value($name);
        }

        return $value;
    }

}

