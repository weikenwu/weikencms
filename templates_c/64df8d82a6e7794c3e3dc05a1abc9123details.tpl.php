<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_vars['webname'] ?></title>
<link rel="stylesheet" type="text/css" href="style/basic.css"> 
<link rel="stylesheet" type="text/css" href="style/details.css"> 
<script type="text/javascript" src="js/details.js"></script>
<script type="text/javascript" src="config/static.php?id=<?php echo $this->_vars['id'] ?>&type=details"></script>
</head>
    <body>
<?php $_tpl->create('header.tpl') ?>
<div id="details">
	<h2>当前位置 &gt; <?php echo $this->_vars['nav'] ?></h2>
	<h3><?php echo $this->_vars['titlec'] ?></h3>
	<div class="d1">时间：<?php echo $this->_vars['date'] ?> 来源：<?php echo $this->_vars['source'] ?> 作者：<?php echo $this->_vars['author'] ?> 点击量：<?php echo $this->_vars['count'] ?></div>
	<div class="d2"><?php echo $this->_vars['info'] ?></div>
	<div class="d3"><?php echo $this->_vars['content'] ?></div>
	<div class="d4">TAB标签：<?php echo $this->_vars['tag'] ?></div>
	<div class="d6">
		<h2><a href="feedback.php?cid=<?php echo $this->_vars['id'] ?>" target="_blank">已有<span><?php echo $this->_vars['comment'] ?></span>人参与评论</a>最新评论</h2>
	<?php if($this->_vars['NewThreeComment']){?>
	<?php foreach($this->_vars['NewThreeComment'] as $key=>$value){ ?>
	<dl>
		<dt><img src="images/<?php echo $value->face ?>" alt="<?php echo $value->user ?>"/></dt>
		<dd><em><?php echo $value->date ?> 发表</em><span>[<?php echo $value->user ?>]</span></dd>
		<dd class="info">[<?php echo $value->manner ?>]<?php echo $value->content ?></dd>
		<dd class="bottom"><a href="feedback.php?cid=<?php echo $value->cid ?>&id=<?php echo $value->id ?>&type=sustain" target="_blank">支持[<?php echo $value->sustain ?>]</a> <a href="feedback.php?cid=<?php echo $value->cid ?>&id=<?php echo $value->id ?>&type=oppose" target="_blank">反对[<?php echo $value->oppose ?>]</a></dd>
	</dl>
	<?php } ?>
	<?php } ?>
	
	</div>
	<div class="d5">
		<form method="post" name="comment" action="feedback.php?cid=<?php echo $this->_vars['id'] ?>" target="_blank">
			<p>您对本文的态度：<input type="radio" name="manner" value="1" checked="checked"/> 支持
							<input type="radio" name="manner" value="0" /> 中立
							<input type="radio" name="manner" value="-1" /> 反对
			</p>
			<p class="red">请不要发表，关于政治、色情、反动的评论。</p>
			<p><textarea name="content"></textarea></p>
			<p style="position:relative;top:-5px;">
			验证码：<input type="text" class="text" name="code" />
			<img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/>
			<input type="submit" class="submit" onclick="return checkComment();" name="send" value="提交评论"/>	
			</p>
		</form>	
	</div>
	
</div>
<div id="sidebar">
	
	<div class="right">
	<h2>本月本类推荐</h2>
	<ul>
		<?php if($this->_vars['MonthNavRec']){?>
		<?php foreach($this->_vars['MonthNavRec'] as $key=>$value){ ?>
		<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?></a></li>
		<?php } ?>
		<?php } ?>
	</ul>
	</div>
	<div class="right">
	<h2>本月本类热点</h2>
	<ul>
		<?php if($this->_vars['MonthNavHot']){?>
		<?php foreach($this->_vars['MonthNavHot'] as $key=>$value){ ?>
		<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?></a></li>
		<?php } ?>
		<?php } ?>
	</ul>
	</div>
	<div class="right">
	<h2>本月本类图文</h2>
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