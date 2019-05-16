window.onload=function(){
	var level=document.getElementById("level");
	var options=document.getElementsByTagName('option');
	
	if(level){
		for(i=0;i<options.length;i++){
			if(options[i].value==level.value){
				options[i].setAttribute('selected','selected');
			}
		}
	}
	
	var title=document.getElementById("title");
	var ol=document.getElementsByTagName('ol');
	var a=ol[0].getElementsByTagName('a')
	
	for(i=0;i<a.length;i++){	
		a[i].className=null;
		if(title.innerHTML==a[i].innerHTML){
			a[i].className='selected';
		}
	}
}

//头像选择
function sface(){
	var fm=document.reg;
	var index=fm.face.selectedIndex;
	fm.faceimg.src='../images/'+fm.face.options[index].value;
}
//验证修改
function checkUpdate(){
	var fm=document.reg;
	if(fm.pass.value!=''){
		if(fm.pass.value.length<6){
			alert("JS警告：密码不得小于6位！");
			fm.pass.focus();
			return false;
		}
	}
	
	if(fm.pass.value!=fm.notpass.value){
		alert("JS警告：密码不一致！");
		fm.notpass.focus();
		return false;
	}
	if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)){
		alert('邮件格式不正确');
		fm.email.value='';
		fm.email.focus();
		return false;
	}
	
	return true;
}

function checkReg(){
	var fm=document.reg;
	if(fm.user.value=='' || fm.user.value.length<2 || fm.user.value.length>20){
		alert("JS警告：用户名不能为空或者小于2位并且不能大于20位！");
		fm.user.focus();
		return false;
	}
	if(fm.pass.value.length<6){
		alert("JS警告：密码不得小于6位！");
		fm.pass.focus();
		return false;
	}
	if(fm.pass.value!=fm.notpass.value){
		alert("JS警告：密码不一致！");
		fm.notpass.focus();
		return false;
	}
	if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)){
		alert('邮件格式不正确');
		fm.email.value='';
		fm.email.focus();
		return false;
	}
	if(fm.code.value.length!=4){
		alert("JS警告：验证码必须是4位！");
		fm.code.focus();
		return false;
	}
	return true;
}
