<?php
namespace Home\Controller;
use Think\Controller;
class BrandController extends Controller {
    //文章详情页
    public function _empty($action){
        if(is_numeric($action)){
            $brand_id = $action;
            $goods_list = M('Goods')->where(array('brand_id' => $brand_id, 'status' => 1))->select();


            $this->assign('brand_id',$brand_id);
            $this->assign('goods_list',$goods_list);
            $this->display(':goods_list');
        }

    }

}