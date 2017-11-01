<?php
namespace Mytag\TagLib;
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
        'list'  => array(
                'attr' => 'name,limit'
        ),
    );

    public function _include($tag, $content)
    {
        $filename = $tag ['filename'];
        $filepath = C('VIEW_PATH').C('DEFAULT_THEME').'/'.$filename;
        $parseStr = "<?php include '".$filepath."'; ?>";

        return $parseStr;
    }

    public function _arclist($tag, $content)
    {
        $name   = $tag['name'];
		$limit   = $tag['limit'];

		$parse  = '<?php ';
		$parse .= "$__LIST__ = M('Article')->limit(10)->select()";
		$parse .= ' ?>';
		$parse .= '<volist name="__LIST__" id="'. $name .'">';
		$parse .= $content;
		$parse .= '</volist>';
		return $parse;}
}

