<?php
namespace Admin\Controller;
use Think\Controller;
class PasswordController extends Controller {
    //修改密码页面
    public function edit()
    {
        $admin_id = session('admin_id');
        $admin_info = M('Admin')->find($admin_id);

    	$this->assign('admin_info', $admin_info);
    	$this->display(':password');
    }

    //保存修改信息
    public function save()
    {
        $admin_id          = I('admin_id', 0);
        $admin_name          = I('admin_name', '');
        $admin_password      = I('admin_password', '');
        $old_admin_password  = I('old_admin_password', '');
        $re_admin_repassword = I('re_admin_repassword', '');

        //是否一致
        if($admin_password !== $re_admin_repassword){
        	$this->error('两次密码输入不一致');
        }

        //原始用户名和密码是否正确
        $filter = array(
        	'admin_name'     => $admin_name,
        	'admin_password' => md5($old_admin_password)
        );

        $admin_info = M('Admin')->where($filter)->find();

        if(!$admin_info){
            $this->error('原始用户名或密码错误');
        }else{
            //更新管理员信息
            $admin_info = array(
                    'admin'          => $admin_name,
                    'admin_password' => md5($admin_password)
            );
            $result = M('Admin')->where(array('id' => $admin_id))->save($admin_info);

            if($result){
                $this->ajaxReturn(array('status' => 'ok', 'info' => '管理员信息修改成功'));
            }else{
                $this->ajaxReturn(array('status' => 'error', 'info' => '管理员信息修改失败'));
            }
        }

    }

}