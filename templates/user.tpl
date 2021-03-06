<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"> 
<script type="text/javascript" src="../js/admin_user.js"></script>
</head>
	<body id="main">
		<div class="map">
			管理首页 &gt;&gt;会员管理&gt;&gt;<strong id="title">{$title}</strong>
		</div>
		<ol>
			<li><a href="user.php?action=show" class="selected">会员列表</a></li>
			<li><a href="user.php?action=add">新增会员</a></li>
			{if $update}
			<li><a href="user.php?action=update">修改会员</a></li>
			{/if}
		</ol>
		
		{if $show}
		<table cellspacing="0">
		<tr>
		<th>编号</th><th>会员名称</th><th>电子邮件</th><th>状态</th><th>操作</th></tr>
		{foreach $AllUser(key,value)}
		<tr>
			<td>{@value->id}</td>
			<td>{@value->user}</td>
			<td>{@value->email}</td>
			<td>{@value->state}</td>
			<td><a href="user.php?action=update&id={@value->id}">修改</a> | <a href="user.php?action=delete&id={@value->id}" onclick="return confirm('真的要删除会员吗?')?true:false">删除</a></td>
		</tr>
		{/foreach}
		</table>
		<div id="page">{$page}</div>
		{/if}
		
		{if $add}
		<form action="" method="post" name="reg" action="">
			<table cellspacing="0" class="user">
		
			<tr><td>用 户 名：<input type="text" name="user" class="text"/><span class="red">【必填】</span>(*用户名在2-20位之间)</td></tr>
			<tr><td>密     码：<input type="password" name="pass" class="text"/><span class="red">【必填】</span>(*密码不得小于6位)</td></tr>
			<tr><td>密码确认：<input type="password" name="notpass" class="text"/><span class="red">【必填】</span>(*密码确认和密码一致)</td></tr>
			<tr><td>电子邮件：<input type="text" name="email" class="text"/><span class="red">【必填】</span>(*每个电子邮件只能注册一个ID)</td></tr>
			<tr><td>选择头像：<select name="face" onchange="sface();">
							{foreach $OptionFaceOne(key,value)}
							<option value="0{@value}.gif">0{@value}.gif</option>
							{/foreach}
							{foreach $OptionFaceTwo(key,value)}
							<option value="{@value}.gif">{@value}.gif</option>
							{/foreach}
					</select></td></tr>
			<tr><td><img name="faceimg" src="../images/01.gif" class="face" alt="01.gif"/></td></tr>
			<tr><td>安全问题：
						<select name="question">
							<option value="">没有任何安全问题</option>
							<option value="您父亲的姓名？">您父亲的姓名？</option>
							<option value="您母亲的职业？">您母亲的职业？</option>
							<option value="您配偶的性别？">您配偶的性别？</option>
						</select>
				</td></tr>
			<tr><td>问题答案：<input type="text" name="answer" class="text"/></td></tr>
			<tr><td>设置权限：<input type="radio" name="state" value="0" />被封杀的会员
							<input type="radio" name="state" value="1" />待审核的会员
							<input type="radio" name="state" value="2" checked="checked" />初级会员
							<input type="radio" name="state" value="3" />中级会员
							<input type="radio" name="state" value="4" />高级会员
							<input type="radio" name="state" value="5" />VIP会员	
								</td></tr>
			<tr><td><input type="submit" class="submit" value="注册会员" name="send" onclick="return checkReg();"></td></tr>

			</table>
		</form>
		{/if}
		
		{if $update}
		<form action="" method="post" name="reg">
			<input type="hidden" name="id" value="{$id}"/>
			<input type="hidden" name="prev_url" value="{$PREV_URL}"/>
			<input type="hidden" name="ppass" value="{$pass}"/>
			<table cellspacing="0" class="user">
		
			<tr><td>用 户 名：{$user}</td></tr>
			<tr><td>密     码：<input type="password" name="pass" class="text"/>(*留空则不修改)</td></tr>
			
			<tr><td>电子邮件：<input type="text" name="email" class="text" value="{$email}"/><span class="red">【必填】</span>(*每个电子邮件只能注册一个ID)</td></tr>
			<tr><td>选择头像：<select name="face" onchange="sface();">
							{$face}
					</select></td></tr>
			<tr><td><img name="faceimg" src="../images/{$facesrc}" class="face" /></td></tr>
			<tr><td>安全问题：
						<select name="question">							
							{$question}
						</select>
				</td></tr>
			<tr><td>问题答案：<input type="text" name="answer" class="text" value="{$answer}"/></td></tr>
			<tr><td>设置权限：{$state}
								</td></tr>
			<tr><td><input type="submit" class="submit" value="修改会员" name="send" onclick="return checkUpdate();"><a href="{$PREV_URL}">[返回上一层]</a></td></tr>

			</table>
		</form>
		{/if}
		

		
	</body>
</html>