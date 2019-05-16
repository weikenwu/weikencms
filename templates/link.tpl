<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"> 
<script type="text/javascript" src="../js/admin_link.js"></script>
</head>
	<body id="main">
		<div class="map">
			管理首页 &gt;&gt;内容管理&gt;&gt;<strong id="title">{$title}</strong>
		</div>
		<ol>
			<li><a href="link.php?action=show" class="selected">友情链接列表</a></li>
			<li><a href="link.php?action=add">新增友情链接</a></li>
			{if $update}
			<li><a href="link.php?action=update">修改友情链接</a></li>
			{/if}
		
		</ol>
		
		{if $show}
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>网站名称</th><th>网站地址</th><th>Logo地址</th><th>站长名称</th><th>类型</th><th>状态</th><th>操作</th></tr>
		{foreach $AllLink(key,value)}
		<tr>
			<td><script type="text/javascript">document.write({@key}+1+{$num});</script></td>
			<td>{@value->webname}</td>
			<td title="{@value->fullweburl}">{@value->weburl}</td>
			<td title="{@value->fulllogourl}">{@value->logourl}</td>
			<td>{@value->user}</td>
			<td>{@value->type}</td>
			<td>{@value->state}</td>
			<td><a href="link.php?action=update&id={@value->id}">修改</a> | <a href="link.php?action=delete&id={@value->id}" onclick="return confirm('真的要删除这个链接吗?')?true:false">删除</a></td>
		</tr>
		{/foreach}
		
		</table>
		<div id="page">{$page}</div>
	
		{/if}
		
		
		{if $add}
		<form action="" method="post" name="friendlink">
		<input type="hidden" name="state" value="1"/>
			<table cellspacing="0" class="left">
				
				<tr><td>网站类型：<input type="radio" name="type" value="1" onclick="link(1)" checked="checked"/>文字链接
						<input type="radio" name="type" value="2" onclick="link(2)"/>LOGO链接</td></tr>
				<tr><td>网站名称：<input type="text" name="webname" class="text"/><span class="red">【必填】</span>(*网站名称不能为空，不大于20位)</td></tr>
				<tr><td>网站地址：<input type="text" name="weburl" class="text"/><span class="red">【必填】</span>(*网站的地址不能为空，不大于100位)</td></tr>
				<tr><td id="logo" style="display:none;">Logo地址：<input type="text" name="logourl" class="text"/><span class="red">【必填】</span>(*LOGO地址不能为空，不大于100位)</td></tr>
				<tr><td>站长名：<input type="text" name="user" class="text"/></td></tr>
				<tr><td><input type="submit" name="send" value="新增友情链接" onclick="return checkLink()" class="submit level" />[<a href="{$PREV_URL}">返回列表</a>]</td></tr>
			</table>
		</form>
		{/if}
		

		
		{if $update}
		<form action="" method="post" name="content">
		<input type="hidden" name="id" value="{$id}">
		<input type="hidden" name="state" value="{$state}">
		<input type="hidden" name="PREV_URL" value="{$PREV_URL}">
			<table cellspacing="0" class="left">
				
				<tr><td>网站类型：<input type="radio" name="type" value="1" {$text_type} onclick="link(1)" checked="checked"/>文字链接
						<input type="radio" name="type" value="2" {$logo_type} onclick="link(2)"/>LOGO链接</td></tr>
				<tr><td>网站名称：<input type="text" name="webname" value="{$webname}" class="text"/><span class="red">【必填】</span>(*网站名称不能为空，不大于20位)</td></tr>
				<tr><td>网站地址：<input type="text" name="weburl" value="{$weburl}" class="text"/><span class="red">【必填】</span>(*网站的地址不能为空，不大于100位)</td></tr>
				<tr><td id="logo" style="{$logo};">Logo地址：<input type="text" name="logourl" value="{$logourl}" class="text"/><span class="red">【必填】</span>(*LOGO地址不能为空，不大于100位)</td></tr>
				<tr><td>站长名：<input type="text" name="user" value="{$user}" class="text"/></td></tr>
				<tr><td><input type="submit" name="send" value="修改友情链接" onclick="return checkLink()" class="submit level" />[<a href="{$PREV_URL}">返回列表</a>]</td></tr>
			</table>
		</form>
		{/if}
		

		
	</body>
</html>