<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"> 
<script type="text/javascript" src="../js/admin_nav.js"></script>
</head>
	<body id="main">
		<div class="map">
			内容管理 &gt;&gt;设置网站导航&gt;&gt;<strong id="title">{$title}</strong>
		</div>
		<ol>
			<li><a href="nav.php?action=show" class="selected">导航列表</a></li>
			<li><a href="nav.php?action=add">新增导航</a></li>
			{if $update}
			<li><a href="nav.php?action=update">修改导航</a></li>
			{/if}
			{if $addchild}
			<li><a href="nav.php?action=addchild&id={$id}">新增子导航</a></li>
			{/if}
			{if $showchild}
			<li><a href="nav.php?action=showchild&id={$id}">查看子导航</a></li>
			{/if}
		</ol>
		
		{if $show}
		<form action="nav.php?action=sort" method="post">
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>导航名称</th><th>描述</th><th>子类</th><th>操作</th><th>排序</th></tr>
		{if $AllNav}
		{foreach $AllNav(key,value)}
		<tr>
			<td>{@value->id}</td>
			<td>{@value->nav_name}</td>
			<td>{@value->nav_info}</td>
			<td><a href="nav.php?action=showchild&id={@value->id}">查看</a> | <a href="nav.php?action=addchild&id={@value->id}">添加子类</a></td>
			<td><a href="nav.php?action=update&id={@value->id}">修改</a> | <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('真的要删除导航吗?')?true:false">删除</a></td>
			<td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort"/></td>
		</tr>
		{/foreach}
		{else}
		<td colspon="6">没有数据！</td>
		{/if}
		<td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="排序" name="send" style="cursor:pointer"></td>
		</table>
		</form>
		<div id="page">{$page}</div>
		<p class="center">[<a href="nav.php?action=add">新增导航</a>]</p>
		{/if}
		
		{if $showchild}
		<form action="nav.php?action=sort" method="post">
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>导航名称</th><th>描述</th><th>操作</th><th>排序</th></tr>
		{if $AllChildNav}
		{foreach $AllChildNav(key,value)}
		<tr>
			<td>{@value->id}</td>
			<td>{@value->nav_name}</td>
			<td>{@value->nav_info}</td>
			<td><a href="nav.php?action=update&id={@value->id}">修改</a> | <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('真的要删除导航吗?')?true:false">删除</a></td>
			<td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort"/></td>
		</tr>
		{/foreach}
		{else}
		<tr><td colspan="5">没有任何数据</td></tr>
		{/if}
		<tr><td></td><td></td><td></td><td></td><td><input type="submit" value="排序" name="send" style="cursor:pointer"></td></tr>
		<tr><td colspan="5">本类隶属：<strong>{$prev_name}</strong>[<a href="nav.php?action=addchild&id={$id}">添加本类</a>] [ <a href="{$PREV_URL}">返回列表</a> ]</td></tr>
		
		</table>
		</form>
		<div id="page">{$page}</div>
		
		{/if}
		
		{if $add}
		<form action="" method="post" name="add">
		<input type="hidden" name="pid" value="0"/>
			<table cellspacing="0" class="left">
				<tr><td>导航名称：<input type="text" name="nav_name" class="text" />（*导航名称不得小于2位，不得大于20位）</td></tr>
				<tr><td><textarea name="nav_info"></textarea>（*描述不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="新增导航" onclick="return checkForm()" class="submit level" />[<a href="{$PREV_URL}">返回列表</a>]</td></tr>
			</table>
		</form>
		{/if}
		{if $update}
		<form action="" method="post" name="add">
		<input type="hidden" name="id" value="{$id}"/>
		<input type="hidden" name="prev_url" value="{$PREV_URL}"/>
			<table cellspacing="0" class="left">
				<tr><td>导航名称：<input type="text" name="nav_name" class="text" value="{$nav_name}" />（*导航名称不得小于2位，不得大于20位）</td></tr>
				<tr><td><textarea name="nav_info">{$nav_info}</textarea>（*描述不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="修改导航" onclick="return checkForm()" class="submit level" />[<a href="{$PREV_URL}">返回列表</a>]</td></tr>
			</table>
		</form>
		{/if}
		{if $addchild}
		<form action="" method="post" name="add">
		<input type="hidden" name="pid" value="{$id}"/>
			<table cellspacing="0" class="left">
				<tr><td>上级导航：<strong>{$prev_name}</strong></td></tr>
				<tr><td>子导航名称：<input type="text" name="nav_name" class="text" />（*导航名称不得小于2位，不得大于20位）</td></tr>
				<tr><td><textarea name="nav_info"></textarea>（*描述不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="新增子导航" onclick="return checkForm()" class="submit level" />[<a href="{$PREV_URL}">返回列表</a>]</td></tr>
			</table>
		</form>
		{/if}

		
	</body>
</html>