<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta  charset="utf-8">
    <title>管理中心-修改密码</title>
    
    <link  rel="stylesheet"  href="/dmt/Public/Css/admin.css"  type="text/css">
    <link  rel="stylesheet"  href="/dmt/Public/Css/bootstrap.css"  type="text/css">
    <link  rel="stylesheet"  href="/dmt/Public/Css/bootstrap_fix.css"  type="text/css">
    <link  rel="stylesheet"  href="/dmt/Public/Css/jquery-ui.min.css"  type="text/css">
    
    
    <script  type="text/javascript"  src="/dmt/Public/Js/jquery-1.8.3.min.js"></script>
    <script  type="text/javascript"  src="/dmt/Public/Js/Validform_v5.3.2_min.js"></script>
    <script  type="text/javascript"  src="/dmt/Public/Js/jquery-ui.min.js"></script>
    <script  type="text/javascript"  src="/dmt/Public/Js/jquery.cookie.js"></script>
    <script  type="text/javascript"  src="/dmt/Public/Js/jquery.ui.datepicker-zh-CN.js"></script>
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
    .row-fluid > .span2{ width:11%; }
    .row-fluid > .span10{ width:86%; }
    </style>

    
    <script  type="text/javascript">
      $(function(){
        //记录上次菜单折叠状态
        var clickMenu = $.cookie('sMenu');
        if (clickMenu == null) {
          clickMenu = 1;
        }
        $('.main-menu .main-menu-tit').each(function(i) {
          if (i != clickMenu) {
            $(this).next().css('display', 'none');
          }
          $(this).click(function() {
            if ($(this).next().css('display') == 'none') {
              $('.main-menu .main-menu-tit').next().slideUp('fast');
              $(this).next().slideDown('fast');
              $.cookie('sMenu', i, { expires: 3600 * 24 * 30, path: '/' });
            } else {
              $(this).next().slideUp('fast');
            }
          });
        });
      });
    </script>

    
    
  </head> 
  
  <body>
  <div  id="header"  class="navbar navbar-fixed-top">
      <div  class="navbar-inner">
        <div  class="container">
          <div><a  class="brand"  href="<?php echo U('admin/index/index');?>">微部落管理中心</a></div>
          <div>
            <ul  class="nav pull-right">
                <li  id="navUserInfo">
                  <a  href="javascript:void(0);"  style="color:white;">欢迎您，<i  class="icon-user icon-white"></i>超级管理员&nbsp; </a>
                </li>
                <li  class="divider-vertical"  style="margin:0;"></li>
                <li>
                  <a  href="<?php echo U('Admin/Index/index');?>"  style="color:white;">后台首页</a>
                </li>
                <li>
                  <a  href="<?php echo U('Home/Index/index');?>"  target="_blank"  style="color:white;">网站首页</a>
                </li>
                <li  class="dropdown">
                  <a  href="<?php echo U('Admin/logout/index');?>"  class="dropdown-toggle"  data-toggle="dropdown"  style="color:white;">退出</a>
                </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- 主容器 start -->
    <div id="container" class="container-fluid">
      <div class="row-fluid">

<!-- 左侧导航栏 start -->
<div id="sideBar" class="span2">
  <ul class="nav nav-tabs nav-stacked" id="admin-menu-bar">
  	
      <li class="active main-menu">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-list-alt"></i> 产品管理</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Goods/delectbiao');?>" class="noborder">删除所有表</a>
            <a href="<?php echo U('Goods/jinming');?>" class="noborder">金明无课表</a>
            <a href="<?php echo U('Goods/minglun');?>" class="noborder">明伦无课表</a>
            <a href="<?php echo U('Goods/mlshl');?>" class="noborder">明伦10课表</a>
            <a href="<?php echo U('Goods/delectzong');?>" class="noborder">删除总课表</a>
          </li> 
        </ul>
      </li>

      <li class="active main-menu">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-th-large"></i> 品牌管理</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Brand/index');?>" class="noborder">品牌列表</a>
          </li> 
        </ul>
      </li>
	  
      <li class="active main-menu">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-tags"></i> 类别管理</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Category/index');?>" class="noborder">类别列表</a>
          </li> 
        </ul>
      </li>
	  
      <li class="active main-menu">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-random"></i> 机型管理</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Type/index');?>" class="noborder">机型列表</a>
          </li> 
        </ul>
      </li>	  
	  
      <li class="active main-menu ">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-lock"></i>安全管理</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Password/edit');?>" class="noborder">修改用户名/密码</a>
          </li> 
        </ul>
      </li>	
	    	        
      <li class="active main-menu ">
        <a href="javascript:void(0);" class="main-menu-tit"><i class="icon-cog"></i>系统设置</a>
        <ul class="nav nav-list sub-menu">
          <li class=""> 
            <a href="<?php echo U('Config/base');?>" class="noborder">基本设置</a>
          </li> 
        </ul>
      </li>
	  
      
  </ul>
</div>
<!-- 左侧导航栏 end -->
<!-- 主内容 start -->
<div id="content" class="span10">
  <!-- 标题 start -->
  <div class="pageTit page-header">
    <h1>修改管理员信息</h1>
  <!-- 标题 end -->
  <!-- 内容区块 start -->
  <div class="formBox">
  <form id="editform" action="<?php echo U('Admin/Password/save');?>" method="post" >
  	<input type="hidden" name="admin_id" value="<?php echo ($admin_info["id"]); ?>" />
        <!-- 登录名 -->
        <div class="control-group">
          <label>登录名：</label>
          <input id="admin_name" type="text" name="admin_name" placeholder="登录名为5-10位字符串" value="<?php echo ($admin_info["admin_name"]); ?>" datatype="s5-10" nullmsg="请填写登录名！" errormsg="登录名不能少于5个字符"/>
          <span class="Validform_checktip"></span>
        </div>
		
		<!-- 原始密码 -->
        <div class="control-group">
          <label>原始密码：</label>
          <input type="password" name="old_admin_password" placeholder="请输入原始密码" datatype="*6-16" nullmsg="请输入原始密码！" errormsg="密码范围在6~16位之间！"/>
          <span class="Validform_checktip"></span>
        </div>
		
        <!-- 新密码 -->
        <div class="control-group">
          <label>更改密码：</label>
          <input type="password" name="admin_password" placeholder="密码为6-16位字符串" datatype="*6-16"  nullmsg="请设置密码！" errormsg="密码范围在6~16位之间！"/>
          <span class="Validform_checktip"></span>
        </div>
        
        <!-- 确认密码 -->
        <div class="control-group">
          <label>确认密码：</label>
          <input type="password" name="re_admin_repassword" placeholder="再次输入密码" datatype="*" ignore="ignore" recheck="admin_password" nullmsg="请再输入一次密码！" errormsg="您两次输入的账号密码不一致！" />
          <span class="Validform_checktip"></span>
        </div>
   
        <div class="control-group">
          <img style="display:none;" src="images/loading.gif" />
          <input type="submit" class="btn btn-primary Sub" value="保存" />
        </div>
  </form>
  </div>
  <!-- 内容区块 end -->
</div>
<!-- 主内容 end -->
<script type="text/javascript">
$(function(){
  <!-- 提交表单合法性验证 -->
  $("#editform").Validform({ 
    tiptype:function(msg,o,cssctl){ 
      if(!o.obj.is("form")){ 
          var objtip=o.obj.siblings(".Validform_checktip");
          cssctl(objtip,o.type);
          objtip.text(msg); 
      }
    },
    ajaxPost:true,
    callback:function(data){
      if(data.status=="ok"){
          alert('密码修改成功，请退出重新登录！');
          window.location.href = "<?php echo U('Admin/Logout/index');?>";
        }else{
            alert(data.info);
        }
    }
  });

});
</script>
   
      </div>
    </div>
    <!-- 主容器 end -->
    <!-- 脚部 start -->
    <div id="footer">
        Copyright © 日日顺微社区版权所有
    </div>
    <!-- 脚部 end -->
  </body>
</html>