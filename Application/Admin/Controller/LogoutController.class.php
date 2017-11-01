<?php
namespace Admin\Controller;
use Think\Controller;
class LogoutController extends AuthController {
    //退出登录
    public function index()
    {
        session(null); // 清空当前的session
        $this->redirect('admin/login/index');
    }

}