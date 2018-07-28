# php-ethereum
用PHP语言编写的以太坊客户端

## 开发流程：
1、安装go环境（请参考官方对安装go的各环境教程）

2、安装以太坊节点（MAC环境下安装）：

    brew tap ethereum/ethereum
    brew install ethereum

3、在当前节点上创建一个帐户
    
    geth account new

4、以开发方式启动 `geth`（这个是ethereum默认自带的golang版本的客户端工具）
    
    geth --rpc --rpccorsdomain "http://localhost:8545" --datadir "~/data" --dev
    
5、然后再用客户端连接管理即可，至于用什么客户端看个人喜欢，因为看到官方貌似没正式发布PHP版本的JSON-RPC客户端（虽然有几个链接，但感觉自己不太喜欢），所以自己写了个，方便大家使用，并且也记录了下开发流程，希望大家对以太坊的区块链开发少走点弯路。

6、安装 php-ethereum 客户端
    
    composer require wasoon/php-ethereum
    
7、调用范例(API手册：https://github.com/ethereum/wiki/wiki/JSON-RPC)

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