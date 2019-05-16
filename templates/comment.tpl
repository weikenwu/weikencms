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
			评论管理 &gt;&gt;查看评论列表&gt;&gt;<strong id="title">{$title}</strong>
		</div>
		<ol>
			<li><a href="comment.php?action=show" class="selected">评论列表</a></li>

		</ol>
		
		{if $show}
		<form action="?action=states" method="post">
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>评论内容</th><th>评论者</th><th>所属文档</th><th>状态</th><th>批审</th><th>操作</th></tr>
		{foreach $CommentList(key,value)}
		<tr>
			<td><script type="text/javascript">document.write({@key}+1+{$num});</script></td>
			<td title="{@value->full}">{@value->content}</td>
			<td>{@value->user}</td>
			<td><a href="../details.php?id={@value->cid}" target="_blank" title="{@value->title}">查看</a></td>
			<td>{@value->state}</td>
			<td><input type="text" value="{@value->num}" name="states[{@value->id}]" class="text sort"></td>
			<td> <a href="comment.php?action=delete&id={@value->id}" onclick="return confirm('真的要删除文档吗?')?true:false">删除</a></td>
		</tr>
		{/foreach}
		<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="批审" name="send" style="cursor:pointer"></td><td></td></tr>
		</table>
		</form>
		{/if}
		
		<div id="page">{$page}</div>
		
		

		
	</body>
</html>