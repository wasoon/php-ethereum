# php-ethereum
用PHP语言编写的以太坊客户端

## 开发流程：
1、安装go环境（请参考官方对安装go的各环境教程）

2、安装以太坊节点：

    brew tap ethereum/ethereum
    brew install ethereum

3、在当前节点上创建一个帐户
    
    geth account new

4、以开发方式启动 `geth`（这个是ethereum默认自带的golang版本的客户端工具）
    
    geth --rpc --rpccorsdomain "http://localhost:8545" --datadir "~/data" --dev
    
5、然后再用客户端连接管理即可，至于用什么客户端看个人喜欢，因为看到官方貌似没正式发布PHP版本的JSON-RPC客户端（虽然有几个链接，但感觉自己不太喜欢），所以自己写了个，方便大家使用，并且也记录了下开发流程，希望大家对以太坊的区块链开发少走点弯路。

6、安装 php-ethereum 客户端
    
    composer require wasoon/php-ethereum
    
7、