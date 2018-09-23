<?php
/**
 * Created by PhpStorm.
 * Users: yf
 * Date: 2017/12/30
 * Time: 下午10:59
 */

return [
    'SERVER_NAME' => 'EasySwoole',
    'MAIN_SERVER' => [
        'HOST' => '0.0.0.0',
        'PORT' => 9501,
        'SERVER_TYPE' => \EasySwoole\Core\Swoole\ServerManager::TYPE_WEB_SOCKET_SERVER,
        'SOCK_TYPE' => SWOOLE_TCP,//该配置项当为SERVER_TYPE值为TYPE_SERVER时有效
        'RUN_MODEL' => SWOOLE_PROCESS,
        'SETTING' => [
            'task_worker_num' => 8, //异步任务进程
            'task_max_request' => 10,
            'max_request' => 5000,//强烈建议设置此配置项
            'worker_num' => 8
        ],
    ],
    'DEBUG' => true,
    'TEMP_DIR' => null,//若不配置，则默认框架初始化
    'LOG_DIR' => null,//若不配置，则默认框架初始化
    'EASY_CACHE' => [
        'PROCESS_NUM' => 1,//若不希望开启，则设置为0
        'PERSISTENT_TIME' => 0//如果需要定时数据落地，请设置对应的时间周期，单位为秒
    ],
    'CLUSTER' => [
        'enable' => false,
        'token' => null,
        'broadcastAddress' => ['255.255.255.255:9556'],
        'listenAddress' => '0.0.0.0',
        'listenPort' => '9556',
        'broadcastTTL' => 5,
        'nodeTimeout' => 10,
        'nodeName' => 'easySwoole',
        'nodeId' => null
    ],
    'DATABASE' => [
        'driver' => 'mysql',
        'host' => '192.168.1.107',
        'database' => 'chat',
        'username' => 'qymeng',
        'password' => '090401',
        'charset' => 'utf8',
        'collation' => 'utf8_general_ci',
        'prefix' => ''
    ],
    'REDIS' => [
        'host' => '192.168.1.107',
        'port' => 6379,
        'password' => '',
        'select' => 0,
        'timeout' => 0,
        'expire' => 0,
        'persistent' => false,
        'prefix' => '',
    ]
];