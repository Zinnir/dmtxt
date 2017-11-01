<?php
/**
 * alltosun.com  function.php
 * ============================================================================
 * 版权所有 (C) 2014-2016 GoCMS内容管理系统
 * 官方网站:   http://www.gouguoyin.cn
 * 联系方式:   QQ:245629560
 * ----------------------------------------------------------------------------
 * 许可声明：这是一个开源程序，未经许可不得将本软件的整体或任何部分用于商业用途及再发布。
 * ============================================================================
 * $Author: 勾国印 (phper@gouguoyin.cn) $
 * $Date: 2015-1-6 下午11:28:51 $
 * $Id$
*/
//通过品牌获取该品牌下的所有机型
function get_types_by_brand_id($brand_id)
{
    $type_array = M('Goods')->where(array('brand_id' => $brand_id))->getField('type_ids', true);

    foreach ($type_array as $v){
    	$type_ids .= ltrim($v,',');
    }

    $ids = explode(',', rtrim($type_ids,','));

    foreach($ids as $k=>$v){
    	$array[$k][id] = $v;
    	$array[$k][title] = get_title('type', $v);
    }


    return $array;



}

