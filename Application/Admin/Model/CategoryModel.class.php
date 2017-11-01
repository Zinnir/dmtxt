<?php
namespace Common\Model;
use Think\Model;

//视图模型
class CategoryModel extends Model {

	public function get_category_list($limit=0, $order='sort desc'){
	    $filter = array(
	    	'status' => 1,
	    	'is_show' => 1,
	    );
	    if($limit){
	        $category_list = $this->where($filter)->order($order)->limit($limit)->select();
	    }else{
	        $category_list = $this->where($filter)->order($order)->select();
	    }

	    return $category_list;
	}
}

?>