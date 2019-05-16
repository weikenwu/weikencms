<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"> 
<script type="text/javascript" src="../js/admin_adver.js"></script>
</head>
	<body id="main">
		<div class="map">
			管理首页 &gt;&gt;内容管理&gt;&gt;<strong id="title">{$title}</strong>
		</div>
		<ol>
			<li><a href="adver.php?action=show" class="selected">广告列表</a></li>
			<li><a href="adver.php?action=add">新增广告</a></li>
			{if $update}
			<li><a href="adver.php?action=update">修改广告</a></li>
			{/if}
		</ol>
		
		{if $show}
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>广告标题</th><th>广告链接</th><th>广告类型</th><th>是否前台广告</th><th>操作</th></tr>
		{foreach $AllAdver(key,value)}
		<tr>
			<td><script type="text/javascript">document.write({@key}+1+{$num});</script></td>
			<td>{@value->title}</td>
			<td>{@value->link}</td>
			<td>{@value->type}</td>
			<td>{@value->state}</td>
			<td><a href="adver.php?action=update&id={@value->id}">查看并修改</a> | <a href="adver.php?action=delete&id={@value->id}" onclick="return confirm('真的要删除广告吗?')?true:false">删除</a></td>
		</tr>
		{/foreach}
		<tr><td colspan="6" style="color:blue">(*任何广告都必须生成JS文件，方可在前台显示)</td></tr>
		<tr><td colspan="6">
			<input type="button" value="生成文字广告JS" onclick="javascript:location.href='?action=text'"/>
			<input type="button" value="生成头部广告JS" onclick="javascript:location.href='?action=header'"/>
			<input type="button" value="生成侧栏广告JS" onclick="javascript:location.href='?action=sidebar'"/>
		</td></tr>
		</table>
		<div id="page">{$page}</div>
	
		{/if}
		
		{if $add}
		<form action="" method="post" name="content">
		<input type="hidden" name="adv">
			<table cellspacing="0" class="left">
				<tr><td>广告类型：<input type="radio" name="type" value="1" onclick="adver(1)" checked="checked"/>文字广告
								<input type="radio" name="type" value="2" onclick="adver(2)" />头部广告690*80
								<input type="radio" name="type" value="3" onclick="adver(3)" />侧栏广告270*200
				</td></tr>
				<tr><td>广告标题：<input type="text" name="title" class="text" />（*广告标题不得小于2位，不得大于20位）</td></tr>
				<tr><td>广告链接：<input type="text" name="link" class="text" />（*广告链接不得为空）</td></tr>
				<tr id="thumbnail" style="display:none;"><td>广告图片：<input type="text" name="thumbnail" class="text" readonly="readonly">
						<span id="up"></span>
						<img name="pic" style="display:none;"/> (*必须PNG,JPG,GIF，大小200K内)
				</td></tr>
				<tr><td><textarea name="info"></textarea>（*描述不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="新增广告" onclick="return checkAdver()" class="submit level" />[<a href="{$PREV_URL}">返回列表</a>]</td></tr>
			</table>
		</form>
		{/if}
		
		{if $update}
		<form action="" method="post" name="content">
		<input type="hidden" name="adv">
			<table cellspacing="0" class="left">
				<tr><td>广告类型：<input type="radio" name="type" value="1" onclick="adver(1)" checked="checked"/>文字广告
								<input type="radio" name="type" value="2" onclick="adver(2)" />头部广告690*80
								<input type="radio" name="type" value="3" onclick="adver(3)" />侧栏广告270*200
				</td></tr>
				<tr><td>广告标题：<input type="text" name="title" value="{$titlec}" class="text" />（*广告标题不得小于2位，不得大于20位）</td></tr>
				<tr><td>广告链接：<input type="text" name="link" value="{$link}" class="text" />（*广告链接不得为空）</td></tr>
				<tr id="thumbnail" style="display:none;"><td>广告图片：<input type="text" name="thumbnail" class="text" readonly="readonly">
						<span id="up"></span>
						<img name="pic" style="display:none;"/> (*必须PNG,JPG,GIF，大小200K内)
				</td></tr>
				<tr><td><textarea name="info">{$info}</textarea>（*描述不得大于200位）</td></tr>
				<tr><td><input type="submit" name="send" value="修改广告" onclick="return checkAdver()" class="submit level" />[<a href="{$PREV_URL}">返回列表</a>]</td></tr>
			</table>
		</form>
		{/if}
		

		
	</body>
</html>