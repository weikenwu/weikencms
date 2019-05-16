<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/basic.css"> 
<link rel="stylesheet" type="text/css" href="style/list.css"> 

</head>
    <body>
{include file="header.tpl"}
<div id="list">
	<h2>当前位置 &gt; {$nav}</h2>
	{if $AllListContent}
	{foreach $AllListContent(key,value)}
	<!-- <script type="text/javascript" src="config/static.php?id={@value->id}&type=list"></script> -->
	<dl>
		<dt><a href="details.php?id={@value->id}" target="_blank"><img src="{@value->thumbnail}" width="150px" height="100px" alt="{@value->title}"></a></dt>
		<dd>[<strong>{@value->nav_name}</strong>]<a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></dd>
		<dd>日期：{@value->date} 点击率：{@value->count} 关键字：[{@value->keyword}]</dd>
		<dd>{@value->info}</dd>
	</dl>
	{/foreach}
	{else}
	<p>改类下没有任何数据！</p>
	{/if}
	<div id="page">{$page}</div>
</div>
<div id="sidebar">
	<div class="nav">
		<h2>子栏目列表</h2>
		{if $childnav}
		{foreach $childnav(key,value)}
		<strong><a href="list.php?id={@value->id}">{@value->nav_name}</a></strong>
		{/foreach}
		{else}
		<strong>该栏目没有子类</strong>
		{/if}
	</div>
	<div class="right">
	<h2>本月本类推荐</h2>
	<ul>
		{if $MonthNavRec}
		{foreach $MonthNavRec(key,value)}
		<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
	</div>
	<div class="right">
	<h2>本月本类热点</h2>
	<ul>
		{if $MonthNavHot}
		{foreach $MonthNavHot(key,value)}
		<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
	</div>
	<div class="right">
	<h2>本月本类图文</h2>
	<ul>
		{if $MonthNavPic}
		{foreach $MonthNavPic(key,value)}
		<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}

	</ul>
	</div>
</div>
{include file="footer.tpl"}

    </body>
</html>