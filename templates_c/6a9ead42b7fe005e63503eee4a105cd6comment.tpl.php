<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"> 
<script type="text/javascript" src="../js/admin_content.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
	<body id="main">
		<div class="map">
			评论管理 &gt;&gt;查看评论列表&gt;&gt;<strong id="title"><?php echo $this->_vars['title'] ?></strong>
		</div>
		<ol>
			<li><a href="comment.php?action=show" class="selected">评论列表</a></li>

		</ol>
		
		<?php if($this->_vars['show']){?>
		<form action="?action=states" method="post">
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>评论内容</th><th>评论者</th><th>所属文档</th><th>状态</th><th>批审</th><th>操作</th></tr>
		<?php foreach($this->_vars['CommentList'] as $key=>$value){ ?>
		<tr>
			<td><script type="text/javascript">document.write(<?php echo $key ?>+1+<?php echo $this->_vars['num'] ?>);</script></td>
			<td title="<?php echo $value->full ?>"><?php echo $value->content ?></td>
			<td><?php echo $value->user ?></td>
			<td><a href="../details.php?id=<?php echo $value->cid ?>" target="_blank" title="<?php echo $value->title ?>">查看</a></td>
			<td><?php echo $value->state ?></td>
			<td><input type="text" value="<?php echo $value->num ?>" name="states[<?php echo $value->id ?>]" class="text sort"></td>
			<td> <a href="comment.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('真的要删除文档吗?')?true:false">删除</a></td>
		</tr>
		<?php } ?>
		<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="批审" name="send" style="cursor:pointer"></td><td></td></tr>
		</table>
		</form>
		<?php } ?>
		
		<div id="page"><?php echo $this->_vars['page'] ?></div>
		
		

		
	</body>
</html>