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
			管理首页 &gt;&gt;等级管理&gt;&gt;<strong id="title"><?php echo $this->_vars['title'] ?></strong>
		</div>
		<ol>
			<li><a href="level.php?action=show" class="selected">等级列表</a></li>
			<li><a href="level.php?action=add">新增等级</a></li>
			<?php if($this->_vars['update']){?>
			<li><a href="level.php?action=update">修改等级</a></li>
			<?php } ?>
		</ol>
		
		<?php if($this->_vars['show']){?>
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>等级名称</th><th>描述</th><th>权限标识</th><th>操作</th></tr>
		<?php foreach($this->_vars['AllLevel'] as $key=>$value){ ?>
		<tr>
			<td><script type="text/javascript">document.write(<?php echo $key ?>+1+<?php echo $this->_vars['num'] ?>);</script></td>
			<td><?php echo $value->level_name ?></td>
			<td><?php echo $value->level_info ?></td>
			<td><?php echo $value->premission ?></td>
			<td><a href="level.php?action=update&id=<?php echo $value->id ?>">修改</a> | <a href="level.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('真的要删除等级吗?')?true:false">删除</a></td>
		</tr>
		<?php } ?>
		</table>
		<div id="page"><?php echo $this->_vars['page'] ?></div>
		<p class="center">[<a href="level.php?action=add">新增等级</a>]</p>
		<?php } ?>
		
		<?php if($this->_vars['add']){?>
		<form action="" method="post" name="add">
			<table cellspacing="0" class="left">
				<tr><td>等级名称：<input type="text" name="level_name" class="text" />（*等级名称不得小于2位，不得大于20位）</td></tr>
				<tr><td><textarea name="level_info"></textarea>（*描述不得大于200位）</td></tr>
				<tr><td style="padding-left:80px;padding-right:40%;">
				<?php if($this->_vars['AllPremission']){?>
				<?php foreach($this->_vars['AllPremission'] as $key=>$value){ ?>
				<input type="checkbox" name="premission[]" value="<?php echo $value->id ?>" /><?php echo $value->name ?> 
				<?php } ?>
				<?php } ?>
				</td></tr>
				<tr><td><input type="submit" name="send" value="新增等级" onclick="return checkForm()" class="submit level" />[<a href="<?php echo $this->_vars['PREV_URL'] ?>">返回列表</a>]</td></tr>
			</table>
		</form>
		<?php } ?>
		
		<?php if($this->_vars['update']){?>
		<form action="" method="post" name="add">
			<input type="hidden" name="id" value="<?php echo $this->_vars['id'] ?>"/>
			<table cellspacing="0" class="left">
				<tr><td>等级名称：<input type="text" name="level_name" value="<?php echo $this->_vars['level_name'] ?>" class="text" /></td></tr>
				<tr><td><textarea name="level_info"><?php echo $this->_vars['level_info'] ?></textarea></td></tr>
				<tr><td style="padding-left:80px;padding-right:40%;">
				<?php echo $this->_vars['premission'] ?>
				</td></tr>
				<tr><td><input type="submit" name="send" value="修改等级" onclick="return checkForm()" class="submit level" />[<a href="<?php echo $this->_vars['PREV_URL'] ?>">返回列表</a>]</td></tr>
				
			</table>
		</form>
		<?php } ?>
		

		
	</body>
</html>