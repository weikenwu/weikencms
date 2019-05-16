<div id="link">
	<h2><span><a href="friendlink.php?action=frontshow" target="_blank">所有链接</a> | <a href="friendlink.php?action=frontadd" target="_blank">申请加入</a></span>友情链接</h2>
	<ul>
		<?php if($this->_vars['text']){?>
		<?php foreach($this->_vars['text'] as $key=>$value){ ?>
		<li><a href="<?php echo $value->weburl ?>" target="_blank"><?php echo $value->webname ?></a></li>
		<?php } ?>
		<?php } ?>

	</ul>
	<dl>
		<?php if($this->_vars['logo']){?>
		<?php foreach($this->_vars['logo'] as $key=>$value){ ?>
		<dd>
			<a href="<?php echo $value->weburl ?>" title="<?php echo $value->webname ?>" target="_blank"><img src="<?php echo $value->logourl ?>" /></a>
		</dd>
		<?php } ?>
		<?php } ?>
	</dl>
</div>
<div id="footer">
	<p>© 2019 DesDev Inc. All rights reserved Powered by <span>WeikenCMS</span></p>
</div>