<?php
use phpEthereum\phpEthereum;

require './autoload.php';

$phpEthereum = new phpEthereum('http://localhost:8545/');
const PASSWORD = "";
// test personal
$personal = $phpEthereum->personal();

// 列出所有账户
$listAccounts = $personal->setId(1)->listAccounts();
var_dump($listAccounts);

/*
// 新增账户
$account = $personal->setParams(["test"])
    ->newAccount();
var_dump($account); */

// 账户解锁（参数1为账户名，参数2为账户密码）
$unlockStatus = $personal->setParams([$listAccounts['result'][0], PASSWORD])
    ->unlockAccount();
var_dump('unlockAccount: ', $unlockStatus);


// 账户授权
$signInfo = $personal->setParams(["0xdeadbeaf", $listAccounts['result'][0], ""])
    ->setId(1)
    ->sign();
var_dump($signInfo);

// test web3
$web3 = $phpEthereum->web3();
// 获取客户端信息
$clientVersion = $web3->setId(67)
    ->clientVersion();
var_dump($clientVersion);

// test eth
$eth = $phpEthereum->eth();
// 获取余额
$balance = $eth->setParams([$listAccounts['result'][0], "latest"])
               ->setId(1)
               ->getBalance();
var_dump('getBalance: ', $balance);

// 透过 eth API 的交易函数将 ether balance 数值转移
$weiValue = $web3->setParams([10, "ether"])->toWei();
$transactionStatus = $eth->setParams([
        'from' => $listAccounts['result'][0],
        'to' => $listAccounts['result'][1],
        'value' => $weiValue
    ])
    ->setId(1)
    ->sendTransaction();
var_dump('sendTransaction:', $weiValue, $transactionStatus);

// 查看以太币
var_dump($web3->setParams([$balance, "ether"])->fromWei());

// test miner
$miner = $phpEthereum->miner();

// 账户设定
$setStatus = $miner->setParams([$listAccounts['result'][0]])
                   ->setId(1)
                   ->setEtherbase();
var_dump('setEtherbase:', $setStatus);

// 开始採扩（可过一段时间产生DAG后停止採护再用web3.fromWei查看以太币数量）
$minerStartStatus = $miner->setParams([1])
                          ->setId(1)
                          ->start();
var_dump('miner start:', $minerStartStatus);

// 停止採扩
$minerStopStatus = $miner->setId(1)->stop();
var_dump('miner stop:', $minerStopStatus);

// test net
$net = $phpEthereum->net();
$version = $net->setId(67)
               ->version();
var_dump($version);

// 获取已连接的节点数量
var_dump('peerCount:', $net->setId(1)->peerCount());

// test admin
$admin = $phpEthereum->admin();

// 获取节点信息
$nodeInfo = $admin->setId(1)->nodeInfo();
var_dump($nodeInfo);

// 连接节点（如果有多个节点时可以使用该方法连接各节点）
$peerStatus = $admin->setParams([$nodeInfo['result']['enode']])->addPeer();
var_dump($peerStatus);

// 获取已连接的节点状态信息
var_dump($admin->peers());

/*
// test db
$db = $phpEthereum->db();
$string = $db->setParams(["testDB","myKey"])
             ->setId(73)
             ->getString();
var_dump($string);

// test shh
$shh = $phpEthereum->shh();
$messages = $shh->setParams(["0x7"])
                ->setId(73)
                ->getMessages();
var_dump($messages);
*/