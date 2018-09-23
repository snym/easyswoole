<?php
/**
 * Created by PhpStorm.
 * Users: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use App\Utility\Logger;
use App\Utility\RedisService;
use \EasySwoole\Core\AbstractInterface\EventInterface;
use EasySwoole\Core\Component\Di;
use EasySwoole\Core\Component\SysConst;
use EasySwoole\Core\Swoole\EventHelper;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;
use Illuminate\Database\Capsule\Manager as Capsule;

Class EasySwooleEvent implements EventInterface {

    public static function frameInitialize(): void
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
        Di::getInstance()->set(SysConst::HTTP_CONTROLLER_MAX_DEPTH, 5);
        Di::getInstance()->set( SysConst::HTTP_EXCEPTION_HANDLER, \App\ExceptionHandler::class );
        Di::getInstance()->set('REDIS', new RedisService());
        // 初始化数据库
        $dbConf = Config::getInstance()->getConf('DATABASE');
        $capsule = new Capsule();
        // 创建链接
        $capsule->addConnection($dbConf);
        // 设置全局静态可访问
        $capsule->setAsGlobal();
        // 启动Eloquent
        $capsule->bootEloquent();
    }

    public static function mainServerCreate(ServerManager $server,EventRegister $register): void
    {
        // TODO: Implement mainServerCreate() method.
        EventHelper::registerDefaultOnMessage($register,\App\SocketParser::class);
    }

    public static function onRequest(Request $request,Response $response): void
    {
        // TODO: Implement onRequest() method.
    }

    public static function afterAction(Request $request,Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}