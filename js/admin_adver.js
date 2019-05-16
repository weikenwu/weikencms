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

function centerWindow(url,name,width,height){
	var left=(screen.width-width)/2;
	var top=(screen.height-height)/2 - 50;
	window.open(url,name,'width='+width+',height='+height+',top='+top+',left='+left);
}

function adver(type){
	var fm=document.content;
	if(fm.adv.value==type) return;
	
	var thumbnail=document.getElementById("thumbnail");
	var up=document.getElementById("up");
	
	fm.thumbnail.value='';
	fm.pic.src='';
	fm.pic.style.display='none';
	
	switch(type){
	case 1:
		fm.adv.value='1';
		thumbnail.style.display='none';
		up.innerHTML='';
		break;
	case 2:
		fm.adv.value='2';
		thumbnail.style.display='block';
		up.innerHTML="<input type=\"button\" value=\"上传头部广告690*80\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=690*80','upfile',400,120)\"/>";
		break;
	case 3:
		fm.adv.value='3';
		thumbnail.style.display='block';
		up.innerHTML="<input type=\"button\" value=\"上传侧栏广告270*200\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=270*200','upfile',400,120)\"/>";
		break;
	}
}

//验证checkAdver
function checkAdver(){
	var fm=document.content;
	if(fm.title.value=='' || fm.title.value.length<2 || fm.title.value.length>20){
		alert("JS警告：标题不能为空或者小于2位或者大于20位！");
		fm.title.focus();
		return false;
	}
	

	if(fm.link.value.length==''){
		alert("JS警告：链接不得为空！");
		fm.link.focus();
		return false;
	}
	if(fm.type[1].checked || fm.type[2].checked){
		if(fm.thumbnail.value.length==''){
			alert("JS警告：图片不得为空！");
			fm.thumbnail.focus();
			return false;
		}
	}
	if(fm.info.value.length>200){
		alert("JS警告：描述不得大于200！");
		fm.info.focus();
		return false;
	}

	
	
	return true;
}