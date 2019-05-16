<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"> 
<script type="text/javascript" src="../js/admin_rotatain.js"></script>
</head>
	<body id="main">
		<div class="map">
			管理首页 &gt;&gt;内容管理&gt;&gt;<strong id="title">{$title}</strong>
		</div>
		<ol>
			<li><a href="rotatain.php?action=show" class="selected">轮播器列表</a></li>
			<li><a href="rotatain.php?action=add">新增轮播器</a></li>
			{if $update}
			<li><a href="rotatain.php?action=update&id={$id}">修改轮播</a></li>
			{/if}
		</ol>
		
		{if $show}
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>标题</th><th>链接</th><th>是否首页轮播</th><th>操作</th></tr>
		{if $AllRotatain}
		{foreach $AllRotatain(key,value)}
		<tr>
			<td>{@value->id}</td>
			<td><a href="{@value->fulllink}" target="_blank">{@value->title}</a></td>
			<td>{@value->link}</td>
			<td>{@value->state}</td>
			<td><a href="rotatain.php?action=update&id={@value->id}">查看并修改</a> | <a href="rotatain.php?action=delete&id={@value->id}" onclick="return confirm('真的要删除管理员吗?')?true:false">删除</a></td>
		</tr>
		{/foreach}
		{/if}
		</table>
		<div id="page">{$page}</div>
		<p class="center">[<a href="manage.php?action=add">新增管理员</a>]</p>
		{/if}
		
		{if $add}
		<form action="" method="post" name="rotatain">
			<table cellspacing="0" class="left">
				<tr><td>轮播图：<input type="text" name="thumbnail" class="text" readonly="readonly" />
							<input type="button" value="上传轮播图" onclick="centerWindow('../config/upfile.php?type=rotatain','upfile',400,100)"/>
							<img name="pic" style="display:none;"/> (*最佳大小268*193 必须PNG,JPG,GIF，大小200K内)
				</td></tr>
				<tr><td>链     接：<input type="text" name="link" class="text" />（*不得为空）</td></tr>
				<tr><td>标     题：<input type="text" name="title" class="text" />（*不得大于20位）</td></tr>
				<tr><td><textarea name="info"></textarea>（*描述不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="新增轮播图" onclick="return checkAddRotatain()" class="submit level" />[<a href="{$PREV_URL}">返回列表</a>]</td></tr>
			</table>
		</form>
		{/if}
		
		{if $update}
		<form action="" method="post" name="rotatain">
			<table cellspacing="0" class="left">
				<tr><td>轮播图：<input type="text" name="thumbnail" value="{$thumbnail}" class="text" readonly="readonly" />
							<input type="button" value="上传轮播图" onclick="centerWindow('../config/upfile.php?type=rotatain','upfile',400,100)"/>
							<img name="pic" src="{$thumbnail}" style="display:block;"/> (*最佳大小268*193 必须PNG,JPG,GIF，大小200K内)
				</td></tr>
				<tr><td>链     接：<input type="text" name="link" value="{$link}" class="text" />（*不得为空）</td></tr>
				<tr><td>标     题：<input type="text" name="title" value="{$titlec}" class="text" />（*不得大于20位）</td></tr>
				<tr><td><textarea name="info">{$info}</textarea>（*描述不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="修改轮播图" onclick="return checkAddRotatain()" class="submit level" />[<a href="{$PREV_URL}">返回列表</a>]</td></tr>
			</table>
		</form>
		{/if}
		

		
	</body>
</html>