<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        //$filter['status'] = 1;

        //搜索条件
        $search  = I('search', '');

        if($search && isset($search)){
            $filter['title'] = array('like',"%{$search}%");
            $filter['PNO']    = array('like',"%{$search}%");
            $filter['old_PNO']    = array('like',"%{$search}%");

            $filter1['title'] = array('like',"%{$search}%");
            $brand_ids = M('Brand')->where($filter1)->getField('id', true);
            if($brand_ids){
                $filter['brand_id']  = array('in', $brand_ids);
            }

            $filter2['title'] = array('like',"%{$search}%");
            $category_ids = M('Category')->where($filter2)->getField('id', true);
            if($category_ids){
                $filter['category_id']  = array('in', $category_ids);
            }

            $filter3['title'] = array('like',"%{$search}%");
            $type_ids = M('Type')->where($filter3)->getField('id', true);

            foreach ($type_ids as $type_id){
                $filter['type_ids'] = array('like',"%{$type_id}%");
            }



            $filter['_logic'] = 'OR';

        }

        $goods_list = M('Goods')->where($filter)->limit(50)->select();

        $this->assign('search', $search);
        $this->assign('goods_list',$goods_list);
        $default_theme = get_config_value('site_style');
        $this->theme($default_theme)->display(':goods_list');
    }

}