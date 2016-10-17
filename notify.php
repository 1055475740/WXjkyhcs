<?php

include './autoload.php';
use Overtrue\Wechat\Payment\Notify;

//$notify = new Notify(
//   'wx426b3015555a46be',
//    '7813490da6f1265e4901ffb80afaa36f',
//    '1900009851',
//    '8934e7d15453e97507ef794cf7b0519d'
//);
$notify = new Notify(
	'wx90cab26b92c74141',
	'a8b7550168513c5a2a9b39715597ae9d',
	'1238008402',
	'DWO8ompBEEzxMMoaUXvDu4rk5v0yf6bE'
);

$transaction = $notify->verify();

if (!$transaction) {
    $notify->reply('FAIL', 'verify transaction error');
}

// var_dump($transaction);

echo $notify->reply();