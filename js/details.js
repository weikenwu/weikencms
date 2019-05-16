
//验证评论
function checkComment(){
	var fm=document.comment;
	if(fm.content.value=='' || fm.content.value.length>255){
		alert("JS警告：用户名不能为空或者小于2位并且不能大于255位！");
		fm.content.focus();
		return false;
	}
	
	if(fm.code.value.length!=4){
		alert("JS警告：验证码必须是4位！");
		fm.code.focus();
		return false;
	}
	return true;
}