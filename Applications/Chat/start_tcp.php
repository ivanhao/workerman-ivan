<?php
use \Workerman\Worker;
use \GatewayWorker\Gateway;
use \Workerman\Autoloader;

// 自动加载类
require_once __DIR__ . '/../../Workerman/Autoloader.php';
Autoloader::setRootPath(__DIR__);

// ##########新增端口支持Text协议 开始##########
// 新增8283端口，开启Text文本协议
$gateway_tcp = new Gateway("tcp://0.0.0.0:9999");
// 进程名称，主要是status时方便识别
$gateway_tcp->name = 'TcpWorker';
// 开启多少text协议的gateway进程
$gateway_tcp->count = 4;
// 本机ip（分布式部署时需要设置成内网ip）
$gateway_tcp->lanIp = '127.0.0.1';
// 设置服务注册地址(注意：这个地址是start_register.php中监听的地址)
$gateway_tcp->registerAddress = '127.0.0.1:1236';
// gateway内部通讯起始端口，起始端口不要重复
$gateway_tcp->startPort = 2500;
// 也可以设置心跳，这里省略
// 心跳间隔
$gateway_tcp->pingInterval = 10;
// 心跳数据
$gateway_tcp->pingData = '{"type":"tcp-ping"}';
// ##########新增端口支持Text协议 结束##########

if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}