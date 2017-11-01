<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>产品列表-微部落</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<meta name="keywords" content="gocms,勾国磊" />
<meta name="description" content="哈哈哈哈" />
<link rel="stylesheet" type="text/css" href="/dmt/Template/default/css/reset.css" /> 
<link rel="stylesheet" type="text/css" href="/dmt/Template/default/css/root.css" /> 
<script type="text/javascript" src="/dmt/Template/default/js/jquery.min.js"></script>
<script type="text/javascript" src="/dmt/Template/default/js/toogle.js"></script>	
</head>
<body>
   
    <!-- start header -->
        <div id="header">
         <a href="<?php echo U('index/index');?>"><img src="/goods/Uploads/2014-12-29/54a02abc7b454.png" width="120" height="40" alt="logo" class="logo" /></a>
            
			<a href="javascript:void(0);" onclick="history.back();" class="button back"><img src="/dmt/Template/default/images/back-button.png" width="15" height="16" alt="icon" /></a>
            <a href="#" class="button search"><img src="/dmt/Template/default/images/search.png" width="16" height="16" alt="icon"/></a>
        <div class="clear"></div>
</div>
    <!-- end header -->
    
    <!-- start searchbox -->
    <div class="searchbox">
   	  <form id="searchForm" method="post" action="<?php echo U('Home/Index/index');?>">
      	<input type="text" name="search" id="textfield" class="txtbox" placeholder="请输入关键字" value="<?php echo ($search); ?>"/>
		<input type="submit" value="搜索" />
		<input type="button" id="adsearch" value="高级搜索" />
   	  </form>
    </div>
    <!-- end searchbox -->
<script>
	$("#adsearch").click(function(){
		window.location.href = "<?php echo U('Home/Search/index');?>";
	});
</script>    
  
    <!-- start page -->
    <div class="page">
    
    
            <!-- start list menu -->
                		
            <div class="simplebox">
            	
                		
           	 <ul class="list-menu">
           	 	<?php if($goods_list): if(is_array($goods_list)): $i = 0; $__LIST__ = $goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U("home/goods/$vo[id]");?>.html"><b><?php echo ($vo["title"]); ?></b></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
				<li><a href="javascript:void(0);"><b>暂无产品</b></a></li><?php endif; ?>
             </ul>
             
             </div>
             
            <!-- end list menu -->

            <!-- start top button -->
            <div class="topbutton"><a href="#header"><span>Top</span></a></div>
            <!-- end top button -->
            
            
            
            <!-- start footer -->
            <div class="footer">
            Copyright ©2014-2016 GoCMS版权所有
			</div>
            <!-- end footer -->
            
            
            
    
    <div class="clear"></div>
    </div>
</body>
</html>