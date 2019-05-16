function link(type){
	var logo=document.getElementById('logo');
	switch(type){
	case 1:
		logo.style.display='none';
		break;
	case 2:
		logo.style.display='block';
		break;
	}
}


function checkLink(){
	var fm=document.friendlink;
	if(fm.webname.value=='' || fm.webname.value.length>20){
		alert("JS警告：网站名不能为空并且不能大于20位！");
		fm.webname.focus();
		return false;
	}
	if(fm.weburl.value=='' || fm.weburl.value.length>100){
		alert("JS警告：网站地址不能为空并且不能大于100位！");
		fm.weburl.focus();
		return false;
	}
	if(fm.type[1].checked){
		if(fm.logourl.value=='' || fm.logourl.value.length>100){
			alert("JS警告：logo地址不得为空且不能大于100位！");
			fm.logourl.focus();
			return false;
		}
	}
	if(fm.user.value.length>20){
		alert("JS警告：站长名不能大于20位！");
		fm.user.focus();
		return false;
	}

	if(fm.code.value.length!=4){
		alert("JS警告：验证码必须是4位！");
		fm.code.focus();
		return false;
	}
	return true;
}