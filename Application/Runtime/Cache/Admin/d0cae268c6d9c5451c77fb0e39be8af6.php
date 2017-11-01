<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta  charset="utf-8">
    <title>管理中心-添加机型</title>
    
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
            <a href="<?php echo U('Goods/index');?>" class="noborder">产品列表</a>
            <a href="<?php echo U('Goods/export');?>" class="noborder">导出产品</a>
            <a href="<?php echo U('Goods/import');?>" class="noborder">导入产品</a>
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
    <h1><?php if($type_info): ?>编辑<?php else: ?>添加<?php endif; ?>机型 </h1>
    <div class="opt">
      <a class="btn btn-info" href="<?php echo U('admin/type/index');?>">返回机型列表</a>
    </div>
  </div>
  <!-- 标题 end -->
  <!-- 内容区块 start -->
  <div class="formBox">
      <form id="addform" action="<?php echo U('admin/type/save');?>" method="post" enctype="multipart/form-data">
      <input name="id" type="hidden" value="<?php echo ($type_info["id"]); ?>" />
        <!-- 标题 -->
        <div class="control-group">
          <label>机型名称：(<font color="red">最少2个最多50个汉字</font>)</label>
          <input type="text" name="title" value="<?php echo ($type_info["title"]); ?>" <?php if(empty($type_info)): ?>ajaxurl="<?php echo U("admin/type/check_title");?>"<?php endif; ?> datatype="*2-50" nullmsg="请填写机型名称！" errormsg="机型名称至少2最多50个汉字！" />
          <span class="Validform_checktip"></span>
        </div>
        
         <!-- 显示排序(view_sort) -->
        <div class="control-group">
          <label>显示排序：（数字越大越靠前）</label>
          <input type="text" name="sort" value="<?php echo ($type_info["sort"]); ?>" datatype="n1-2" nullmsg="请输入排序号！" errormsg="排序号只能为1-2位数字！"/>
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
<script>
$(function(){
  //提交表单合法性验证 
    $("#addform").Validform({ 
    tiptype:function(msg,o,cssctl){ 
      if(!o.obj.is("form")){ 
          var objtip=o.obj.siblings(".Validform_checktip");
          cssctl(objtip,o.type);
          objtip.text(msg); 
      }
    },
	label:"label",
    ajaxPost:true,
    callback:function(data){
      if(data.status=="ok"){
          alert(data.info);
		  window.location.href = "<?php echo U('admin/type/index');?>";
      }else{
        alert(data.info);
      }
    }
  });
})
</script>
   
      </div>
    </div>
    <!-- 主容器 end -->
﻿    <!-- 脚部 start -->
    <div id="footer">
        Copyright ©2014-2016 GoCMS版权所有
    </div>
    <!-- 脚部 end -->
  </body>
</html>