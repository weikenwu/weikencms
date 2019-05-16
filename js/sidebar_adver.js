var sidebar=[];
sidebar[1]={
'title':'侧边栏广告测试2',
'pic':'/default1/CMS0.2/uploads/20190505/20190505170636481.jpg',
'link':'http://weibo.com'
};
sidebar[2]={
'title':'侧边栏广告测试1',
'pic':'/default1/CMS0.2/uploads/20190505/20190505170534833.jpg',
'link':'http://www.qq.com'
};
var i=Math.floor(Math.random()*2+1);
document.write('<a href="'+sidebar[i].link+'" title="'+sidebar[i].title+'" target="_blank"><img border="0" src="'+sidebar[i].pic+'"></a>');