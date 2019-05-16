<script type="text/javascript" src="config/static.php?type=header"></script>
<div id="top">
{$header}
<script type="text/javascript" src="js/test_adver.js"></script>
</div>
<div id="header">
<h1><a href="###">{$webname}</a></h1>
<div class="adver"><script type="text/javascript" src="js/header_adver.js"></script></div>
</div>
<div id="nav">
<ul>
	<li><a href="./">首页</a></li>
	{if $FrontNav}
	{foreach $FrontNav(key,value)}
	<li><a href="list.php?id={@value->id}">{@value->nav_name}</a></li>
	{/foreach}
	{/if}
</ul>
</div>
<div id="search">
<form method="get" action="search.php">
	<select name="type">
		<option select="selected" value="1">按标题</option>
		<option value="2">按关键字</option>
	</select>
	<input type="text" name="inputkeyword" class="text">
	<input type="submit" class="submit" value="搜索">
	
</form>
<strong>TAG标签：</strong>
<ul>
	{if $FiveTag}
	{foreach $FiveTag(key,value)}
	<li><a href="search.php?type=3&inputkeyword={@value->tagname}">{@value->tagname}({@value->count})</a></li>
	{/foreach}
	{/if}
</ul>
</div>