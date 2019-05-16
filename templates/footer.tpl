<div id="link">
	<h2><span><a href="friendlink.php?action=frontshow" target="_blank">所有链接</a> | <a href="friendlink.php?action=frontadd" target="_blank">申请加入</a></span>友情链接</h2>
	<ul>
		{if $text}
		{foreach $text(key,value)}
		<li><a href="{@value->weburl}" target="_blank">{@value->webname}</a></li>
		{/foreach}
		{/if}

	</ul>
	<dl>
		{if $logo}
		{foreach $logo(key,value)}
		<dd>
			<a href="{@value->weburl}" title="{@value->webname}" target="_blank"><img src="{@value->logourl}" /></a>
		</dd>
		{/foreach}
		{/if}
	</dl>
</div>
<div id="footer">
	<p>© 2019 DesDev Inc. All rights reserved Powered by <span>WeikenCMS</span></p>
</div>