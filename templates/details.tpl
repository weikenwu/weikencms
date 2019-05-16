<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/basic.css"> 
<link rel="stylesheet" type="text/css" href="style/details.css"> 
<script type="text/javascript" src="js/details.js"></script>
<script type="text/javascript" src="config/static.php?id={$id}&type=details"></script>
</head>
    <body>
{include file="header.tpl"}
<div id="details">
	<h2>当前位置 &gt; {$nav}</h2>
	<h3>{$titlec}</h3>
	<div class="d1">时间：{$date} 来源：{$source} 作者：{$author} 点击量：{$count}</div>
	<div class="d2">{$info}</div>
	<div class="d3">{$content}</div>
	<div class="d4">TAB标签：{$tag}</div>
	<div class="d6">
		<h2><a href="feedback.php?cid={$id}" target="_blank">已有<span>{$comment}</span>人参与评论</a>最新评论</h2>
	{if $NewThreeComment}
	{foreach $NewThreeComment(key,value)}
	<dl>
		<dt><img src="images/{@value->face}" alt="{@value->user}"/></dt>
		<dd><em>{@value->date} 发表</em><span>[{@value->user}]</span></dd>
		<dd class="info">[{@value->manner}]{@value->content}</dd>
		<dd class="bottom"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain" target="_blank">支持[{@value->sustain}]</a> <a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose" target="_blank">反对[{@value->oppose}]</a></dd>
	</dl>
	{/foreach}
	{/if}
	
	</div>
	<div class="d5">
		<form method="post" name="comment" action="feedback.php?cid={$id}" target="_blank">
			<p>您对本文的态度：<input type="radio" name="manner" value="1" checked="checked"/> 支持
							<input type="radio" name="manner" value="0" /> 中立
							<input type="radio" name="manner" value="-1" /> 反对
			</p>
			<p class="red">请不要发表，关于政治、色情、反动的评论。</p>
			<p><textarea name="content"></textarea></p>
			<p style="position:relative;top:-5px;">
			验证码：<input type="text" class="text" name="code" />
			<img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/>
			<input type="submit" class="submit" onclick="return checkComment();" name="send" value="提交评论"/>	
			</p>
		</form>	
	</div>
	
</div>
<div id="sidebar">
	
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