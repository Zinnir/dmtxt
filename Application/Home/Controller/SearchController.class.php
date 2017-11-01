<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {
    public function index(){

        $this->display(':search');
    }

    public function all(){
        $filter['status'] = 1;

        $title  = I('title', '');
        $pno  = I('PNO', '');
        $old_pno  = I('old_PNO', '');
        $brand_id  = I('brand_id', 0);
        $category_id  = I('category_id', 0);
        $type_id      = I('type_id', 0);

        if($title && isset($title)){
            $filter['title'] = array('like',"%{$title}%");
        }

        if($pno && isset($pno)){
            $filter['PNO'] = array('like',"%{$pno}%");
        }

        if($old_pno && isset($old_pno)){
            $filter['old_PNO'] = array('like',"%{$old_pno}%");
        }

        if($brand_id && isset($brand_id)){
            $filter['brand_id'] = $brand_id;
        }

        if($category_id && isset($category_id)){
            $filter['category_id'] = $category_id;
        }

        if($type_id && isset($type_id)){
            $type_id = ','.$type_id.',';
            //$filter['type_ids LIKE'] = "%{$type_id}%";
            $filter['type_ids'] = array('like',"%{$type_id}%");
        }

        //print_r($filter);

        $goods_list = M('Goods')->where($filter)->select();

        $this->assign('title', $title);
        $this->assign('pno', $pno);
        $this->assign('old_pno', $old_pno);
        $this->assign('goods_list',$goods_list);
        $this->display(':goods_list');
    }

    //获取机型下拉列表
    public function get_option()
    {
        $brand_id = I('brand_id', 0);

        if($brand_id){
            $type_list = get_types_by_brand_id($brand_id);
        }

        if($type_list){
            foreach ($type_list as $v) {
                $id[] = $v['id'];
                if($v['title']){
                    $str .=  "<option value='{$v['id']}' selected>{$v[title]}</option>";
                }

            }

        }

        if(!empty($id[0])){
        	$status = 'ok';
        }else{
        	$status ='no';
        }

        $this->ajaxReturn(array('status' => $status, 'info' => $str));

    }

    public function test(){
        $brand_id = 14;

        if($brand_id){
            $type_list = get_types_by_brand_id($brand_id);
        }

        if($type_list){
            foreach ($type_list as $v) {
                $id[] = $v['id'];
                $str .=  "<option value='{$v['id']}' selected>{$v[title]}</option>";
            }

        }

        if(!empty($id[0])){
        	$status = 'ok';
        }else{
        	$status ='no';
        }

        print_r($status);


    }

}