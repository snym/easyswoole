<?php
/**
 * Created by IntelliJ IDEA.
 * Users: qymeng
 * Date: 2018/9/19
 * Time: 22:20
 */

namespace App\Utility;


use EasySwoole\Config;
use Exception;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\WebProcessor;
use Monolog\Registry;

class Logger
{
    public static function getLog($name)
    {
        if (!Registry::hasLogger($name)) {
            $logger = new \Monolog\Logger($name);
            $logConfig = Config::getInstance()->getConf('LOGGER');
            if (empty($logConfig['logPath'])) {
                return SysConst::ERROR;
            }
            $formatter = new JsonFormatter();
            $formatter->includeStacktraces(true);

            try {
                $handler = new StreamHandler($logConfig['logPath'], $logConfig['level'], true, 0777);
            } catch (Exception $e) {
                return SysConst::ERROR;
            }

            $handler->setFormatter($formatter);
            $logger->pushHandler($handler);

            $logger->pushProcessor(new ProcessIdProcessor());
            $logger->pushProcessor(new WebProcessor());
            Registry::addLogger($logger);
        }

        return Registry::getInstance($name);
    }
}