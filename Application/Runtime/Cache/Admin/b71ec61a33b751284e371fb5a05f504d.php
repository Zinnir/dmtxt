<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta  charset="utf-8">
    <title>管理中心-添加产品</title>
    
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
<style>
.tag .select_side{ float:left; width:200px } 
.tag select{ width:180px; height:120px } 
.tag .select_opt{ float:left; width:40px; height:100%; margin-top:60px } 
.tag .select_opt p{ width:26px; height:26px; margin-top:6px; background:url(images/admin/arr.gif) no-repeat; 
 cursor:pointer; text-indent:-999em } 
.tag .select_opt p#toright{ background-position:2px 0 } 
.tag .select_opt p#toleft{ background-position:2px -22px } 

</style>
<!-- 主内容 start -->
<div id="content" class="span10">
  <!-- 标题 start -->
  <div class="pageTit page-header">
    <h1><?php if($goods_info): ?>编辑<?php else: ?>添加<?php endif; ?>产品</h1>
    <div class="opt">
      <a class="btn btn-info" href="<?php echo U('Admin/Goods/index');?>">返回产品列表</a>
    </div>
  </div>
  <!-- 标题 end -->
  <!-- 内容区块 start -->
  <div class="formBox">
  <form id="addform" action="<?php echo U('Admin/Goods/save');?>" method="post" enctype="multipart/form-data">
  <input name="id" type="hidden" value="<?php echo ($goods_info["id"]); ?>" />
        <div class="control-group">
          <label>产品名称：(<font color="red">必填，至少4个最多50个汉字</font>)</label>
                <input type="text" name="title" value="<?php echo ($goods_info["title"]); ?>" <?php if(empty($goods_info)): ?>ajaxurl="<?php echo U("admin/goods/check_title");?>"<?php endif; ?> datatype="*4-50"  nullmsg="请填写产品！" errormsg="不能少于4个字符大于50个汉字"/>
                <span class="Validform_checktip"></span>
        </div>
 
        <div class="control-group">
          <label>零件号：(<font color="red">必填，不能重复</font>)</label>
                <input type="text" name="PNO" value="<?php echo ($goods_info["PNO"]); ?>" datatype="*4-50"  nullmsg="请填写零件号！" errormsg="不能少于4个字符大于250个字符"/>
                <span class="Validform_checktip"></span>
        </div>
 
        <div class="control-group">
          <label>原厂参考零件号：</label>
                <input type="text" name="old_PNO" value="<?php echo ($goods_info["old_PNO"]); ?>" datatype="*4-50" errormsg="不能少于4个字符大于50个字符"/>
                <span class="Validform_checktip"></span>
        </div>
		
        <div class="control-group">
          <label>含税面价：</label>
                <input type="text" name="price" value="<?php echo ($goods_info["price"]); ?>" datatype="*1-20" nullmsg="请填写含税面价！" errormsg="标题不能少于1个字符大于20个字符"/>
                <span class="Validform_checktip"></span>
        </div>
				
        <div class="control-group">
          <label>品牌：</label>
                    <select name="brand_id">
                        <?php echo ($brand_list = get_list('brand')); ?>
                        <?php if(is_array($brand_list)): $i = 0; $__LIST__ = $brand_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo[id] == $goods_info[brand_id]): ?>selected<?php endif; ?>><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?> 
                      </select>
        </div>
		
        <div class="control-group">
          <label>类别：</label>
                    <select name="category_id">
                    	<?php echo ($category_list = get_list('category')); ?>
						<?php if(is_array($category_list)): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo[id] == $goods_info[category_id]): ?>selected<?php endif; ?>><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>  
                      </select>
        </div>
						
		<div class="control-group tag">
            <label>机型：</label>
            <input id="type_ids" type="hidden" name="type_ids" value="" />
            
            <div class="tag-box">
            <div class="select_side"> 
               <p>可选区(<font color="red">双击即可选择</font>)</p> 
               <select id="selectL" name="selectL" multiple="multiple">
                    <?php echo ($rest_type_list = array_filter(get_rest_type_ids($goods_info['id']))); ?>
					
	                <?php if(is_array($rest_type_list)): $i = 0; $__LIST__ = $rest_type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>" ><?php echo get_title('type',$vo);?></option><?php endforeach; endif; else: echo "" ;endif; ?>  
                                   
               </select> 
            </div> 
            <div class="select_opt"> 
               <p id="toright" title="添加">></p> 
               <p id="toleft" title="移除"><</p> 
            </div> 
            <div class="select_side"> 
               <p>已选区(<font color="red">双击即可移除</font>)</p> 
               <select id="selectR" name="selectR" multiple="multiple">
               	<?php echo ($type_list = array_filter(get_type_list($goods_info[id]))); ?>
                <?php if(is_array($type_list)): $i = 0; $__LIST__ = $type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" ><?php echo get_title('type',$vo);?></option><?php endforeach; endif; else: echo "" ;endif; ?> 
               </select> 
            </div> 
            <div class="sub_btn hidden"><input type="button" class="tag-sure" value="保存" /></div> 
            </div>
        </div>
        <div style="clear:both;"></div>

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
        //提交表单合法性验证 
        $("#addform").Validform({ 
            tiptype:function(msg,o,cssctl){ 
              if(!o.obj.is("form")){ 
                  var objtip=o.obj.siblings(".Validform_checktip");
                  cssctl(objtip,o.type);
                  objtip.text(msg); 
              }
            },
            beforeSubmit:function(curform){
                $(".tag-sure").trigger("click");
            },
			label:"label",
		    ajaxPost:true,
		    callback:function(data){
		      if(data.status=="ok"){
		          alert(data.info);
		          window.location.href = "<?php echo U('admin/goods/index');?>";
		      }else{
		        alert(data.info);
		      }
		    }
            
        });

        //双向选择
        var leftSel = $("#selectL");
        var rightSel = $("#selectR");
        $("#toright").bind("click",function(){      
            leftSel.find("option:selected").each(function(){
                $(this).remove().appendTo(rightSel);
            });
        });
        $("#toleft").bind("click",function(){       
            rightSel.find("option:selected").each(function(){
                $(this).remove().appendTo(leftSel);
            });
        });
        leftSel.dblclick(function(){
            $(this).find("option:selected").each(function(){
                $(this).remove().appendTo(rightSel);
            });
        });
        rightSel.dblclick(function(){
            $(this).find("option:selected").each(function(){
                $(this).remove().appendTo(leftSel);
            });
        });
        $(".tag-sure").click(function(){
            var selVal = [];
            rightSel.find("option").each(function(){
                selVal.push(this.value);
            });
            selVals = selVal.join(",");
            if(selVals==""){
                //alert("没有选择任何项！");
            }else{
                $("#type_ids").val(selVals);
            }
        });

    });
</script>
﻿    <!-- 脚部 start -->
    <div id="footer">
        Copyright ©2014-2016 GoCMS版权所有
    </div>
    <!-- 脚部 end -->
  </body>
</html>