<?php
/**
 * Created by PhpStorm.
 * User: wilson
 * Date: 2018/7/28
 * Time: 下午6:21
 */

use phpEthereum\phpEthereum;

require './autoload.php';

$phpEthereum = new phpEthereum('http://localhost:8545/');
$eth = $phpEthereum->eth();
// 获取余额
$balance = $eth->getBalance();
var_dump($balance);