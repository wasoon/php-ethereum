<?php
use phpEthereum\phpEthereum;

require './autoload.php';

$phpEthereum = new phpEthereum('http://localhost:8545/');
$eth = $phpEthereum->eth();
// test eth
$balance = $eth->setParams(["0xc94770007dda54cF92009BFF0dE90c06F603a09f", "latest"])
               ->setId(1)
               ->getBalance();
var_dump($balance);

// test web3
$web3 = $phpEthereum->web3();
$clientVersion = $web3->setId(67)
    ->clientVersion();
var_dump($clientVersion);

// test net
$net = $phpEthereum->net();
$version = $net->setId(67)
               ->version();
var_dump($version);

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