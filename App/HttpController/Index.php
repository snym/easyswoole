<?php

namespace App\HttpController;

use App\Model\User;
use App\Utility\RedisService;
use EasySwoole\Core\Http\AbstractInterface\Controller;

/**
 * Class Index
 * @package App\HttpController
 */
class Index extends Controller
{
    /**
     * 首页方法
     * @author : evalor <master@evalor.cn>
     */
    function index()
    {
        $version = User::all();
        $redis = RedisService::getInstance();
        $redis->set('test', 'hello, world');
        $this->response()->write(json_encode(['hello, world']));
    }

    function test1()
    {
        $this->response()->write('this is a test');
    }

    function actionNotFound($action): void
    {
        parent::actionNotFound($action); // TODO: Change the autogenerated stub
        $this->response()->write('there is no action');
    }
}