<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_vars['webname'] ?></title>
<link rel="stylesheet" type="text/css" href="style/basic.css"> 
<link rel="stylesheet" type="text/css" href="style/friendlink.css"> 
<script type="text/javascript" src="js/link.js"></script>
</head>
    <body>
<?php $_tpl->create('header.tpl') ?>
<?php if($this->_vars['frontadd']){?>
<div id="friendlink">
<h2>申请加入链接</h2>
<form method="post" action="" name="friendlink">
<input type="hidden" name="state" value="0"/>
		<dl>
			<dd>网站类型：<input type="radio" name="type" value="1" onclick="link(1)" checked="checked"/>文字链接
						<input type="radio" name="type" value="2" onclick="link(2)"/>LOGO链接
				</dd>
			<dd>网站名称：<input type="text" name="webname" class="text"/><span class="red">【必填】</span>(*网站名称不能为空，不大于20位)</dd>
			<dd>网站地址：<input type="text" name="weburl" class="text"/><span class="red">【必填】</span>(*网站的地址不能为空，不大于100位)</dd>
			<dd id="logo" style="display:none;">Logo地址：<input type="text" name="logourl" class="text"/><span class="red">【必填】</span>(*LOGO地址不能为空，不大于100位)</dd>
			<dd>站长名：<input type="text" name="user" class="text"/></dd>

			<dd>验证码：<input type="text" name="code" class="text"/><span class="red">【必填】</span></dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/></dd>
			<dd><input type="submit" class="submit" value="申请友情链接" name="send" onclick="return checkLink();"></dd>
		</dl>
	</form>
</div>
<?php } ?>
<?php if($this->_vars['frontshow']){?>
<div id="friendlink">
<h2>所有链接</h2>
<h3>文字链接</h3>
<div>
		<?php if($this->_vars['Alltext']){?>
		<?php foreach($this->_vars['Alltext'] as $key=>$value){ ?>
		<a href="<?php echo $value->weburl ?>" target="_blank"><?php echo $value->webname ?></a> 
		<?php } ?>
		<?php } ?>
</div>
<h3>LOGO链接</h3>
<div>
		<?php if($this->_vars['Alllogo']){?>
		<?php foreach($this->_vars['Alllogo'] as $key=>$value){ ?>
			<a href="<?php echo $value->weburl ?>" title="<?php echo $value->webname ?>" target="_blank"><img src="<?php echo $value->logourl ?>" /></a> 
		<?php } ?>
		<?php } ?>
</div>
</div>
<?php } ?>

<?php $_tpl->create('footer.tpl') ?>

    </body>
</html>