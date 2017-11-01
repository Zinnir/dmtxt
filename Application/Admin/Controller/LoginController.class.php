<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    //后台登录页面
    public function index()
    {
    	$this->display(':login');
    }

    //检验管理员登录是否正确
    public function check()
    {
        $admin_name     = I('admin_name', '');
        $admin_password = I('admin_password', '');

        $admin_password = md5($admin_password);

        $filter = array(
        	'admin_name'     => $admin_name,
        	'admin_password' => $admin_password
        );

        $admin_info = M('Admin')->where($filter)->find();

        if($admin_info){
            // 获取上次登录ip
            $ip = get_client_ip();
            M('Admin')->where(array('id' => $admin_info['id']))->save(array('last_login_ip' => $ip));

            session('admin_id',$admin_info['id']);
            session('admin_name',$admin_name);
            session('role_group_id',$admin_info['role_group_id']);


            $callback = U('admin/index/index');

            $data = array(
            	'info' => 'ok',
            	'callback' => $callback
            );
        }else{
            $data = array(
                    'info' => '登录失败，请检查登录名和密码是否正确'
            );
        }

        $this->ajaxReturn($data);
    }

}