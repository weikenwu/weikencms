var header=[];
header[1]={
'title':'头部广告测试2',
'pic':'/default1/CMS0.2/uploads/20190505/20190505163646316.jpg',
'link':'http://baidu.com'
};
header[2]={
'title':'头部广告测试1',
'pic':'/default1/CMS0.2/uploads/20190505/20190505163519231.jpg',
'link':'http://sian.com.cn'
};
var i=Math.floor(Math.random()*2+1);
document.write('<a href="'+header[i].link+'" title="'+header[i].title+'" target="_blank"><img src="'+header[i].pic+'"></a>');