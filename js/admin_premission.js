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

//验证Manage add update
function checkForm(){
	var fm=document.add;
	if(fm.name.value=='' || fm.name.value.length<2 || fm.name.value.length>100){
		alert("JS警告：权限名称不能为空或者小于2位或者大于100位！");
		fm.name.focus();
		return false;
	}
	
	if(fm.info.value.length>200){
		alert("JS警告：描述不能大于200位！");
		fm.info.focus();
		return false;
	}
	
	return true;
}