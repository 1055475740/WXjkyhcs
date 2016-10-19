<?php
header('content-type:text/html;charset=utf-8');
include './autoload.php';
session_start();
use Overtrue\Wechat\Payment;
use Overtrue\Wechat\Payment\Order;
use Overtrue\Wechat\Payment\Business;
use Overtrue\Wechat\Payment\UnifiedOrder;
use Overtrue\Wechat\Auth;

ini_set('display_errors', 1);
$appId = 'wx90cab26b92c74141';
$secret = 'a8b7550168513c5a2a9b39715597ae9d';
/**
 * 第 1 步：定义商户
 */
 $business = new Business(
	 $appId,
	 $secret,
     '1238008402',
     'DWO8ompBEEzxMMoaUXvDu4rk5v0yf6bE'
 );
$auth = new Auth($appId, $secret);

$auth->authorize($to = null, $scope = 'snsapi_userinfo', $state = 'STATE');
if (empty($_SESSION['logged_user'])) {
	$user = $auth->authorize(); // 返回用户 Bag
	$_SESSION['logged_user'] = $user->all();
	// 跳转到其它授权才能访问的页面
} else {
	$user = $_SESSION['logged_user'];
}

var_dump($user['openid']);

//$business = new Business(
//    'wx426b3015555a46be',
//    '7813490da6f1265e4901ffb80afaa36f',
//    '1900009851',
//    '8934e7d15453e97507ef794cf7b0519d'
//);

/**
 * 第 2 步：定义订单
 */
$order = new Order();
$order->body = 'test body';
$order->out_trade_no = md5(uniqid().microtime());
$order->total_fee = '1';    // 单位为 “分”, 字符串类型
$order->openid = $user['openid'];
$order->notify_url = 'http://www.17joke.cn/wxpay/notify.php';//这个url改改

/**
 * 第 3 步：统一下单
 */
$unifiedOrder = new UnifiedOrder($business, $order);

/**
 * 第 4 步：生成支付配置文件
 */
$payment = new Payment($unifiedOrder);
include './a.html';

