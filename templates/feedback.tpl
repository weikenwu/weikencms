<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/basic.css"> 
<link rel="stylesheet" type="text/css" href="style/feedback.css"> 
<script type="text/javascript" src="js/details.js"></script>
</head>
    <body>
{include file="header.tpl"}
<div id="feedback">
	<h2>评论列表</h2>
	<h3>{$titlec}</h3>
	<p class="info">{$info} <a href="details.php?id={$id}" target"_blank">[详情]</a></p>
	{if $HotThreeComment}
	{foreach $HotThreeComment(key,value)}
		<dl>
		<dt><img src="images/{@value->face}" alt="{@value->user}"/></dt>
		<dd><em>{@value->date} 发表</em><span>[{@value->user}]</span><img src="images/hot.gif" alt="hot"/></dd>
		<dd class="info">[{@value->manner}]{@value->content}</dd>
		<dd class="bottom"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain">支持[{@value->sustain}]</a> <a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose">反对[{@value->oppose}]</a></dd>
		</dl>
	{/foreach}	
	{/if}
	<h4>最新评论</h4>
	{if $AllComment}
	{foreach $AllComment(key,value)}
	<dl>
		<dt><img src="images/{@value->face}" alt="{@value->user}"/></dt>
		<dd><em>{@value->date} 发表</em><span>[{@value->user}]</span></dd>
		<dd class="info">[{@value->manner}]{@value->content}</dd>
		<dd class="bottom"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain">支持[{@value->sustain}]</a> <a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose">反对[{@value->oppose}]</a></dd>
	</dl>
	{/foreach}
	{else}
	<dl>
		<dd>此文档当前没有任何评论。</dd>
	</dl>
	{/if}
	<div id="page">{$page}</div>
</div>
<div id="sidebar">
	<h2>热评文档总排行</h2>
	<ul>
		{if $HotTwentyComment}
		{foreach $HotTwentyComment(key,value)}
		<li><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
</div>
<div class="d5">
		<form method="post" name="comment" action="feedback.php?cid={$cid}">
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
{include file="footer.tpl"}

    </body>
</html>