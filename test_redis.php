<?php
/* 这里替换为连接的实例host和port */
$host = "";
$port = 6379;

/* 这里替换为实例id和实例password */
$user = "";
$pwd = "";

$redis = new Redis();
if ($redis->connect($host, $port) == false) {
    die($redis->getLastError());
}
/* user:password 拼接成AUTH的密码 */
if ($redis->auth($user . ":" . $pwd) == false) {
    die($redis->getLastError());
}
/* 认证后就可以进行数据库操作，详情文档参考https://github.com/phpredis/phpredis */
// if ($redis->set("foo2", "weiwei") == false) {
//     die($redis->getLastError());
// }

// $value = $redis->get("foo");
// echo $value;

//模拟数字扣减过程
//$redis->set('test',"123");
// var_dump($redis->decr("test"));  //结果：int(122)
// var_dump($redis->decr("test"));  //结果：int(121)  

//插入库存
// $store=1000;
// $res=$redis->llen('goods_store');
// echo $res;
// $count=$store-$res;
// for($i=0;$i<$count;$i++){
//     $redis->lpush('goods_store',1);
// }
// echo $redis->llen('goods_store');
//下单模拟扣库存
// $count=$redis->lpop('goods_store');
// if(!$count){
//     insertLog('error:no store redis');
//     return;
// }


// //$redis->hSet('user:1000:message:notice', 'system', 1);
// //设置1条未读系统消息
// $redis->hIncrBy('user:1000:message:notice', 'system', 1);
// //未读系统消息+1
// //$redis->hSet('user:1000:message:notice', 'comment', 1);
// //设置1条未读评论
// $redis->hIncrBy('user:1000:message:notice', 'comment', 1);
// //未读评论+1

// $_user=$redis->hGetAll('user:1000:message:notice');
// //查看所有消息通知数量
// print_r($_user);

//list数据结构
// $redis->lPush('user:1000:product:like', '3002');
// $redis->lPush('user:1000:product:like', '3001');
// $redis->lPush('user:1000:product:like', '3004');
// $redis->lPush('user:1000:product:like', '3003');

// $redis->lRange('user:1000:product:like', 0, -1);

//$redis->lPush('stock:002:product:E6371A', '105');
// $redis->rPushX('stock:002:product:E6371A', '1');
// $rs=$redis->lRange('stock:002:product:E6371A', 0, -1);
// var_dump($rs);
?>