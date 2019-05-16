<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"> 
<script type="text/javascript" src="../js/admin_level.js"></script>
</head>
	<body id="main">
		<div class="map">
			管理首页 &gt;&gt;系统配置&gt;&gt;<strong class="title">系统配置文件</strong>
		</div>
		
		
<form method="post">
		<table cellspacing="0" class="content">
		<tr><th style="text-align:center;"><strong>系统配置信息</strong></th></tr>
		<tr><td>网站名称：<input type="text" class="text" name="webname" value="<?php echo $this->_vars['webname'] ?>"/></td></tr>
		<tr><td>常规分页：<input type="text" class="text" name="page_size" value="<?php echo $this->_vars['page_size'] ?>"/></td></tr>
		<tr><td>文章分页：<input type="text" class="text" name="article_size" value="<?php echo $this->_vars['article_size'] ?>"/></td></tr>
		<tr><td>导航个数：<input type="text" class="text" name="nav_size" value="<?php echo $this->_vars['nav_size'] ?>"/></td></tr>
		<tr><td>图片上传目录：<input type="text" class="text" name="updir" value="<?php echo $this->_vars['updir'] ?>"/></td></tr>
		<tr><td>轮播数：<input type="text" class="text" name="ro_num" value="<?php echo $this->_vars['ro_num'] ?>"/></td></tr>
		<tr><td>文字广告个数：<input type="text" class="text" name="adver_text_num" value="<?php echo $this->_vars['adver_text_num'] ?>"/></td></tr>
		<tr><td>图片广告个数：<input type="text" class="text" name="adver_pic_num" value="<?php echo $this->_vars['adver_pic_num'] ?>"/></td></tr>
	</table>
	<p style="margin:20px;text-align:center;"><input name="send" type="submit" value="修改配置"></p>
</form>
		
		

		
	</body>
</html>