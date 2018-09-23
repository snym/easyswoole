<?php
/**
 * Created by IntelliJ IDEA.
 * Users: qymeng
 * Date: 2018/9/19
 * Time: 0:15
 */

namespace App\Utility;


use EasySwoole\Config;
use EasySwoole\Core\AbstractInterface\Singleton;

class RedisService
{
    private static $options;

    use Singleton;
    /**
     * 构造函数
     * @access public
     */
    public function __construct()
    {
        if (!\extension_loaded('redis')) {
            throw new \BadFunctionCallException('not support: redis');
        }
        self::$options = Config::getInstance()->getConf('REDIS');
    }

    /**
     * 连接Redis
     * @return void
     */
    protected static function connect(): void
    {
        if (self::$instance instanceof \Redis) {
            return;
        }
        self::$instance = new \Redis;
        if (self::$options['persistent']) {
            self::$instance->pconnect(self::$options['host'], self::$options['port'], self::$options['timeout'], 'persistent_id_' . self::$options['select']);
        } else {
            self::$instance->connect(self::$options['host'], self::$options['port'], self::$options['timeout']);
        }

        if (!empty(self::$options['password'])) {
            self::$instance->auth(self::$options['password']);
        }

        if (!empty(self::$options['select'])) {
            self::$instance->select(self::$options['select']);
        }

    }

    /**
     * @return object Redis
     */
    public static function getInstance()
    {
        if(self::$instance === null){
           new RedisService();
        }
        self::connect();
        return self::$instance;
    }
}