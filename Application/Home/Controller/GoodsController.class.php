<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    //产品详情页
    public function _empty($action){
        if(is_numeric($action)){
            $goods_id = $action;
            $goods_info = M('Goods')->find($goods_id);


            $this->assign('goods_info',$goods_info);
            $this->display(':goods_read');
        }

    }


}