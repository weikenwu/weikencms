<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_vars['webname'] ?></title>
<link rel="stylesheet" type="text/css" href="style/basic.css"> 
<link rel="stylesheet" type="text/css" href="style/list.css"> 

</head>
    <body>
<?php $_tpl->create('header.tpl') ?>
<div id="list">
	<h2>当前位置 &gt; 搜索</h2>
	<?php if($this->_vars['SearchContent']){?>
	<?php foreach($this->_vars['SearchContent'] as $key=>$value){ ?>
	<!-- <script type="text/javascript" src="config/static.php?id=<?php echo $value->id ?>&type=list"></script> -->
	<dl>
		<dt><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><img src="<?php echo $value->thumbnail ?>" width="150px" height="100px" alt="<?php echo $value->t ?>"></a></dt>
		<dd>[<strong><?php echo $value->nav_name ?></strong>]<a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?></a></dd>
		<dd>日期：<?php echo $value->date ?> 点击率：<?php echo $value->count ?> 关键字：[<?php echo $value->keyword ?>]</dd>
		<dd><?php echo $value->info ?></dd>
	</dl>
	<?php } ?>
	<?php }else{ ?>
	<p>没有任何数据！</p>
	<?php } ?>
	<div id="page"><?php echo $this->_vars['page'] ?></div>
</div>
<div id="sidebar">
	
	<div class="right">
	<h2>本月总推荐</h2>
	<ul>
		<?php if($this->_vars['MonthNavRec']){?>
		<?php foreach($this->_vars['MonthNavRec'] as $key=>$value){ ?>
		<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?></a></li>
		<?php } ?>
		<?php } ?>
	</ul>
	</div>
	<div class="right">
	<h2>本月总热点</h2>
	<ul>
		<?php if($this->_vars['MonthNavHot']){?>
		<?php foreach($this->_vars['MonthNavHot'] as $key=>$value){ ?>
		<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?></a></li>
		<?php } ?>
		<?php } ?>
	</ul>
	</div>
	<div class="right">
	<h2>本月总图文</h2>
	<ul>
		<?php if($this->_vars['MonthNavPic']){?>
		<?php foreach($this->_vars['MonthNavPic'] as $key=>$value){ ?>
		<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?></a></li>
		<?php } ?>
		<?php } ?>

	</ul>
	</div>
</div>
<?php $_tpl->create('footer.tpl') ?>

    </body>
</html>