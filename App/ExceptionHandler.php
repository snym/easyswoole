<?php
/**
 * Created by IntelliJ IDEA.
 * Users: qymeng
 * Date: 2018/9/16
 * Time: 16:04
 */

namespace App;

use EasySwoole\Core\Http\AbstractInterface\ExceptionHandlerInterface;
use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;

class ExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(\Throwable $exception, Request $request, Response $response)
    {
        var_dump($exception);
    }
}