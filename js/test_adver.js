var text=[];
text[1]={
'title':'网易广告请进入',
'link':'http://www.163.com'
};
text[2]={
'title':'新浪微博进军博客',
'link':'http://weibo.com'
};
text[3]={
'title':'腾讯开始进军游戏网络市场',
'link':'http://www.qq.com'
};
var i=Math.floor(Math.random()*3+1);
document.write('<a href="'+text[i].link+'" class="adv" target="_blank">'+text[i].title+'</a>');
