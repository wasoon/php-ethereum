<?php
use phpEthereum\phpEthereum;

require './autoload.php';

$phpEthereum = new phpEthereum('http://localhost:8545/');
$eth = $phpEthereum->eth();
// 获取余额
$balance = $eth->setParams(["0xc94770007dda54cF92009BFF0dE90c06F603a09f", "latest"])
               ->setId(1)
               ->getBalance();
var_dump($balance);