<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/basic.css"> 
<link rel="stylesheet" type="text/css" href="style/index.css"> 
<link rel="stylesheet" href="style/main.css" />
<script type="text/javascript" src="js/reg.js"></script>
<script type="text/javascript" src="config/static.php?type=index"></script>
</head>
    <body>
{include file="header.tpl"}
<div id="user">
{if $cache}
{$member}
{else}
{if $login}
<h2>会员登录</h2>
<form method="post" name="login" action="register.php?action=login">
	<label>用户名：<input type="text" name="user" class="text" /></label>
	<label>密- -码：<input type="password" name="pass" class="text" /></label>
	<label class="yzm">验证码：<input type="text" name="code" class="text code" /> <img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/></label>
	
	<p><input type="submit" name="send" value="登录" onclick="return checkLogin();" class="submit" />
		<a href="register.php?action=reg">注册会员</a> <a href="###">忘记密码</a>
	</p>
</form>
{else}
<h2>会员信息</h2>
<div class="a">您好，<strong>{$user}</strong> 欢迎登录!</div>
<div class="b">
	<img src="images/{$face}" alt="{$user}" width="80"/>
	<a href="###">个人中心</a>
	<a href="###">我的评论</a>
	<a href="register.php?action=logout">退出登录</a>
</div>
{/if}
{/if}
<h3>最近登录的会员<span>———————————</span></h3>
{if $AllLaterUser}
{foreach $AllLaterUser(key,value)}
<dl>
	<dt><img src="images/{@value->face}" alt="{@value->user}" width="72" height="72"/></dt>
	<dd>{@value->user}</dd>
</dl>
{/foreach}
{/if}
</div>
<div id="news">
	
	<h3><a href="details.php?id={$TopId}" target="_blank">{$TopTitle}</a></h3>
	<p>核心提示：{$TopInfo}<a href="details.php?id={$TopId}">[查看全文]</a></p>
	
	<p class="link">
		{if $NewTopList}
		{foreach $NewTopList(key,value)}
		<a href="details.php?id={@value->id}" target="_blank">{@value->title}</a> {@value->line}
		{/foreach}
		{/if}
	</p>
	<ul>
		{if $NewList}
		{foreach $NewList(key,value)}
		<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}
	
	</ul>
</div>
<div id="pic">
	<div class="banner" id="b04">
	<ul>
		{if $NewRotatain}
		{foreach $NewRotatain(key,value)}
		<li class="slider-item"><a href="{@value->link}" target="_blank"><img src="{@value->thumbnail}" alt="{@value->title}" width="268" height="193"><span class="slider-title"><em>{@value->title}</em></span></a></li>
		{/foreach}
		{/if}
	</ul>
	<div class="progress"></div>
	<a href="javascript:void(0);" class="unslider-arrow04 prev"><img class="arrow" id="al" src="images/arrowl.png" alt="prev" width="20" height="35"></a>
	<a href="javascript:void(0);" class="unslider-arrow04 next"><img class="arrow" id="ar" src="images/arrowr.png" alt="next" width="20" height="37"></a>
</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/unslider.min.js"></script>
<script>
$(document).ready(function(e) {
	var progress = $(".progress"),li_width = $("#b04 li").length;
    var unslider04 = $('#b04').unslider({
		dots: true,
		complete:function(index){//自己添加的，官方没有
			progress.animate({"width":(100/li_width)*(index+1)+"%"});
		}
	}),

	data04 = unslider04.data('unslider');
	$('.unslider-arrow04').click(function() {
        var fn = this.className.split(' ')[1];
        data04[fn]();
    });
});
</script>
</div>
<div id="rec">
	<h2>特别推荐</h2>
	<ul>
		{if $NewRecList}
		{foreach $NewRecList(key,value)}
		<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
</div>
<div id="sidebar-right">
	<div class="adver"><script type="text/javascript" src="js/sidebar_adver.js"></script></div>
	<div class="hot">
		<h2>本月热点</h2>
		<ul>
		{if $MonthHotList}
		{foreach $MonthHotList(key,value)}
		<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
	</div>
	<div class="comm">
		<h2>本月评论</h2>
		<ul>
		{if $MonthCommentList}
		{foreach $MonthCommentList(key,value)}
		<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
	</div>
	<div class="vote">
		<h2>调查投票</h2>
		<h3>{$vote_title}</h3>
		<form method="post" action="cast.php" target="_blank">
			{if $vote_item}
			{foreach $vote_item(key,value)}
			<label><input type="radio" name="vote" value="{@value->id}" />{@value->title}</label>
			{/foreach}
			{/if}
			<p><input type="submit" name="send" value="投票"/> <input type="button" onclick="javascript:window.open('cast.php')" value="查看"/></p>
		</form>
	</div>
</div>
<div id="picnews">
	<h2>图文资讯</h2>
	{if $PicList}
	{foreach $PicList(key,value)}
	<dl>
		<dt><a href="details.php?id={@value->id}" target="_blank"><img src="{@value->thumbnail}"/></a></dt>
		<dd><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></dd>
	</dl>
	{/foreach}
	{/if}
</div>
<div id="newslist">
	{if $FourNav}
	{foreach $FourNav(key,value)}
	<div class="{@value->class}">
		<h2><a href="list.php?id={@value->id}" target="_blank">更多</a>{@value->nav_name}</h2>
		<ul>
		{iff  @value->list}
		{for @value->list(key,value)}
		<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/for}
		{else}
		此类没有任何信息
		{/iff}
		</ul>
	</div>
	{/foreach}
	{/if}
</div>

{include file="footer.tpl"}

    </body>
</html>