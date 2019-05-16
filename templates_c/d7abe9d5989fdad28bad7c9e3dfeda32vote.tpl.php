<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"> 
<script type="text/javascript" src="../js/admin_vote.js"></script>
</head>
	<body id="main">
		<div class="map">
			管理首页 &gt;&gt;内容管理&gt;&gt;<strong id="title"><?php echo $this->_vars['title'] ?></strong>
		</div>
		<ol>
			<li><a href="vote.php?action=show" class="selected">投票主题列表</a></li>
			<li><a href="vote.php?action=add">新增投票主题</a></li>
			<?php if($this->_vars['update']){?>
			<li><a href="vote.php?action=update">修改投票主题</a></li>
			<?php } ?>
			<?php if($this->_vars['showchild']){?>
			<li><a href="vote.php?action=showchild&id=<?php echo $this->_vars['id'] ?>">投票项目列表</a></li>
			<?php } ?>
			<?php if($this->_vars['addchild']){?>
			<li><a href="vote.php?action=addchild&id=<?php echo $this->_vars['id'] ?>">新增投票项目</a></li>
			<?php } ?>
		</ol>
		
		<?php if($this->_vars['show']){?>
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>投票主题</th><th>投票项目</th><th>是否前台首选</th><th>参与人数</th><th>操作</th></tr>
		<?php foreach($this->_vars['AllVote'] as $key=>$value){ ?>
		<tr>
			<td><script type="text/javascript">document.write(<?php echo $key ?>+1+<?php echo $this->_vars['num'] ?>);</script></td>
			<td><?php echo $value->title ?></td>
			<td><a href="?action=showchild&id=<?php echo $value->id ?>">查看</a> | <a href="?action=addchild&id=<?php echo $value->id ?>">增加项目</a></td>
			<td><?php echo $value->state ?></td>
			<td><?php echo $value->pcount ?></td>
			<td><a href="vote.php?action=update&id=<?php echo $value->id ?>">修改</a> | <a href="vote.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('真的要删除这个投票吗?')?true:false">删除</a></td>
		</tr>
		<?php } ?>
		
		</table>
		<div id="page"><?php echo $this->_vars['page'] ?></div>
	
		<?php } ?>
		
		<?php if($this->_vars['showchild']){?>
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>投票项目</th><th>投票数</th><th>操作</th></tr>
		<?php foreach($this->_vars['AllVoteChild'] as $key=>$value){ ?>
		<tr>
			<td><script type="text/javascript">document.write(<?php echo $key ?>+1+<?php echo $this->_vars['num'] ?>);</script></td>
			<td><?php echo $value->title ?></td>
			<td><?php echo $value->count ?></td>
			<td><a href="vote.php?action=update&id=<?php echo $value->id ?>">修改</a> | <a href="vote.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('真的要删除这个投票吗?')?true:false">删除</a></td>
		</tr>
		<?php } ?>
		<tr><td colspan="3">所属主题：<strong><?php echo $this->_vars['titlec'] ?></strong> <a href="vote.php?action=addchild&id=<?php echo $this->_vars['id'] ?>">[增加本项目]</a> <a href="<?php echo $this->_vars['PREV_URL'] ?>">[返回列表]</a></td></tr>
		</table>
		<div id="page"><?php echo $this->_vars['page'] ?></div>
	
		<?php } ?>
		
		<?php if($this->_vars['add']){?>
		<form action="" method="post" name="content">
		
			<table cellspacing="0" class="left">
				
				<tr><td>投票主题：<input type="text" name="title" class="text" />（*投票主题不得小于2位，不得大于20位）</td></tr>
				<tr><td><textarea name="info"></textarea>（*简介不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="新增投票主题" onclick="return checkAdver()" class="submit level" />[<a href="<?php echo $this->_vars['PREV_URL'] ?>">返回列表</a>]</td></tr>
			</table>
		</form>
		<?php } ?>
		
		<?php if($this->_vars['addchild']){?>
		<form action="" method="post" name="content">
			<input type="hidden" name="id" value="<?php echo $this->_vars['id'] ?>">
			<table cellspacing="0" class="left">
				<tr><td>所属主题：<strong><?php echo $this->_vars['titlec'] ?></strong></td></tr>
				<tr><td>投票项目：<input type="text" name="title" class="text" />（*投票项目不得小于2位，不得大于20位）</td></tr>
				<tr><td><textarea name="info"></textarea>（*投票项目简介不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="新增投票项目" onclick="return checkAdver()" class="submit level" />[<a href="<?php echo $this->_vars['PREV_URL'] ?>">返回列表</a>]</td></tr>
			</table>
		</form>
		<?php } ?>
		
		<?php if($this->_vars['update']){?>
		<form action="" method="post" name="content">
		<input type="hidden" name="id" value="<?php echo $this->_vars['id'] ?>">
		<input type="hidden" name="PREV_URL" value="<?php echo $this->_vars['PREV_URL'] ?>">
			<table cellspacing="0" class="left">
				
				<tr><td>投票主题：<input type="text" name="title" value="<?php echo $this->_vars['titlec'] ?>" class="text" />（*投票主题不得小于2位，不得大于20位）</td></tr>
				<tr><td><textarea name="info"><?php echo $this->_vars['info'] ?></textarea>（*简介不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="修改投票主题" onclick="return checkAdver()" class="submit level" />[<a href="<?php echo $this->_vars['PREV_URL'] ?>">返回列表</a>]</td></tr>
			</table>
		</form>
		<?php } ?>
		

		
	</body>
</html>