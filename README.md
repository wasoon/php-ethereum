# php-ethereum
用PHP语言（5.4以上版本）编写的以太坊客户端SDK

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
    
    // 开始採扩（可过一段时间产生DAG后停止採扩再用$web3->fromWei()查看以太币数量）
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
