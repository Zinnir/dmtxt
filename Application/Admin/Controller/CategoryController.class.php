<?php
/**
 * alltosun.com  SiteController.class.php
 * ============================================================================
 * 版权所有 (C) 2009-2014 北京互动阳光科技有限公司，并保留所有权利。
 * 网站地址:   http://www.alltosun.com
 * ----------------------------------------------------------------------------
 * 许可声明：这是一个开源程序，未经许可不得将本软件的整体或任何部分用于商业用途及再发布。
 * ============================================================================
 * $Author: 勾国印 (gougy@alltosun.com) $
 * $Date: 2014-11-22 上午12:24:54 $
 * $Id$
*/
namespace Admin\Controller;
use Think\Controller;

class CategoryController extends AuthController {

    public function index()
    {
        $Category = M('Category');

        $total      = $Category->where('status=1')->count();
        if($total){
            $Page       = new \Think\Page($total,25);
            $show       = $Page->show();
            $this->assign('total',$total);
            $this->assign('page',$show);
        }

        $category_list = $Category->where(array('status' => 1))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('category_list', $category_list);

        $this->display('category_list');
    }

    //添加类别
    public function add()
    {
        $this->display('category_add');
    }

    //检测类别是否存在
    public function check_title()
    {
        $title = I('param');
        $result = check_title('category', $title);

        if($result){
            $this->ajaxReturn(array('status' => 'n', 'info' => '该类别已经存在'));
        }else{
            $this->ajaxReturn(array('status' => 'y', 'info' => ''));
        }
    }

    //编辑类别
    public function edit()
    {
        $category_id = I('id');
        $category_info = M('Category')->where(array('id' => $category_id))->find();

        $this->assign('category_info', $category_info);
        $this->display('category_add');
    }

    //保存数据
    public function save()
    {
        $id = I('id', 0);
        $info = M('Category')->where(array('id' => $id))->find();

        $data['title']  = I('title', '');
        $data['sort']   = I('sort', 999);

        if($info){
            //更新操作
            $result = M('Category')->where(array('id' => $id))->save($data);
            if($result || $result === 0){
                $this->ajaxReturn(array('status' => 'ok', 'info' => '类别修改成功,正在转跳到类别列表'));
            }else if($result === FALSE){
                $this->ajaxReturn(array('status' => 'error', 'info' => '类别修改失败'));
            }
        }else{
        	//入库操作
            $data['add_time'] = date('Y-m-d H:i:s', time());
            $result = M('Category')->add($data);
            if($result){
                $this->ajaxReturn(array('status' => 'ok', 'info' => '类别添加成功,正在转跳到类别列表'));
            }else if($result){
                $this->ajaxReturn(array('status' => 'error', 'info' => '类别添加失败'));
            }
        }

    }

    public function del()
    {
        $id = I('id');
        $result = M('Category')-> delete($id);
        if($result){
            $this->success('类别删除成功,正在转跳到类别列表');
        }else if($result){
            $this->erroe('类别删除失败');
        }
    }


}
