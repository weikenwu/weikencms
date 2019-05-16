function checkLogin(){
	var fm=document.login;
	if(fm.admin_user.value=='' || fm.admin_user.value.length<2 || fm.admin_user.value.length>20){
		alert("JS警告：用户名不能为空或者小于2位并且不能大于20位！");
		fm.admin_user.focus();
		return false;
	}
	if(fm.admin_pass.value==''){
		alert("JS警告：密码不能为空！");
		fm.admin_pass.focus();
		return false;
	}
	if(fm.code.value.length!=4){
		alert("JS警告：验证码必须是4位！");
		fm.admin_pass.focus();
		return false;
	}
	
	return true;
}