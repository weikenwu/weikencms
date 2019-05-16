<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/basic.css"> 
<link rel="stylesheet" type="text/css" href="style/reg.css"> 
<script type="text/javascript" src="js/reg.js"></script>
</head>
    <body>
{include file="header.tpl"}
{if $reg}
<div id="reg">
	<h2>会员注册</h2>
	<form method="post" action="?action=reg" name="reg">
		<dl>
			<dd>用 户 名：<input type="text" name="user" class="text"/><span class="red">【必填】</span>(*用户名在2-20位之间)</dd>
			<dd>密     码：<input type="password" name="pass" class="text"/><span class="red">【必填】</span>(*密码不得小于6位)</dd>
			<dd>密码确认：<input type="password" name="notpass" class="text"/><span class="red">【必填】</span>(*密码确认和密码一致)</dd>
			<dd>电子邮件：<input type="text" name="email" class="text"/><span class="red">【必填】</span>(*每个电子邮件只能注册一个ID)</dd>
			<dd>选择头像：<select name="face" onchange="sface();">
							{foreach $OptionFaceOne(key,value)}
							<option value="0{@value}.gif">0{@value}.gif</option>
							{/foreach}
							{foreach $OptionFaceTwo(key,value)}
							<option value="{@value}.gif">{@value}.gif</option>
							{/foreach}
					</select></dd>
			<dd><img name="faceimg" src="images/01.gif" class="face" alt="01.gif"/></dd>
			<dd>安全问题：
						<select name="question">
							<option value="">没有任何安全问题</option>
							<option value="您父亲的姓名？">您父亲的姓名？</option>
							<option value="您母亲的职业？">您母亲的职业？</option>
							<option value="您配偶的性别？">您配偶的性别？</option>
						</select>
				</dd>
			<dd>问题答案：<input type="text" name="answer" class="text"/></dd>
			<dd>验证码：<input type="text" name="code" class="text"/><span class="red">【必填】</span></dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/></dd>
			<dd><input type="submit" class="submit" value="注册会员" name="send" onclick="return checkReg();"></dd>
		</dl>
	</form>
</div>
{/if}
{if $login}
<div id="reg">
	<h2>会员登录</h2>
	<form method="post" action="?action=login" name="login">
		<dl>
			<dd>用 户 名：<input type="text" name="user" class="text"/><span class="red">【必填】</span>(*用户名在2-20位之间)</dd>
			<dd>密     码：<input type="password" name="pass" class="text"/><span class="red">【必填】</span>(*密码不得小于6位)</dd>
			<dd>登录保留：<input type="radio" name="time" checked="checked" value="0"> 不保留 
						<input type="radio" name="time" value="86400"> 一天
						<input type="radio" name="time" value="604800"> 一周
						<input type="radio" name="time" value="2592000"> 一月	
			</dd>
			<dd>验证码：<input type="text" name="code" class="text"/><span class="red">【必填】</span></dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/></dd>
			<dd><input type="submit" class="submit" value="登录" name="send" onclick="return checkLogin();"></dd>
		</dl>
	</form>
</div>
{/if}
{include file="footer.tpl"}

    </body>
</html>