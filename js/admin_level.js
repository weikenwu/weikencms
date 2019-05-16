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
	if(fm.level_name.value=='' || fm.level_name.value.length<2 || fm.level_name.value.length>20){
		alert("JS警告：等级名称不能为空或者小于2位或者大于20位！");
		fm.level_name.focus();
		return false;
	}
	
	if(fm.level_info.value.length>200){
		alert("JS警告：等级描述不能大于200位！");
		fm.level_info.focus();
		return false;
	}
	
	return true;
}