<?php
/**
 * Created by IntelliJ IDEA.
 * Users: qymeng
 * Date: 2018/9/19
 * Time: 20:04
 */

namespace App\WebSocketController;


use App\Model\Rooms;
use App\Model\UserRoom;
use App\Model\Users;
use App\Utility\Logger;
use App\Utility\SysConst;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Socket\Response;
use EasySwoole\Core\Swoole\Task\TaskManager;

class Index extends WebSocketController
{
    function actionNotFound(?string $actionName)
    {
        $this->response()->write(json_encode([
            SysConst::CODE => SysConst::ERROR,
            SysConst::MESSAGE => "action call {$actionName} not found"
        ]));
    }

    public function userRegister()
    {
        $data = $this->request()->getArg('data');
        $res = Users::checkUserInfo($data);
        if ($res !== SysConst::OK) {
            $this->response()->write(json_encode([
                SysConst::CODE => SysConst::ERROR,
                SysConst::MESSAGE => $res
            ]));
            return;
        }
        $user = new Users();
        if ($user->addUser($data) === SysConst::OK) {
            $this->response()->write(json_encode([
                SysConst::CODE => SysConst::SUCCESS
            ]));
        }
        $this->response()->write(json_encode([
            SysConst::CODE => SysConst::ERROR
        ]));
    }

    public function createRoom()
    {
        $data = $this->request()->getArg('data');
        $res = Rooms::checkRoomInfo($data);
        if ($res !== SysConst::OK) {
            $this->response()->write(json_encode([
                SysConst::CODE => SysConst::ERROR,
                SysConst::MESSAGE => $res
            ]));
            return;
        }
        $room = new Rooms();
        if ($room->addRoom($data) === SysConst::OK) {
            $this->response()->write(json_encode([
                SysConst::CODE => SysConst::SUCCESS
            ]));
        }
        $this->response()->write(json_encode([
            SysConst::CODE => SysConst::ERROR
        ]));
    }

    public function joinRoom()
    {
        $data = $this->request()->getArg('data');
        $res = UserRoom::checkUserRoomsInfo($data);
        if ($res !== SysConst::OK) {
            $this->response()->write(json_encode([
                SysConst::CODE => SysConst::ERROR,
                SysConst::MESSAGE => $res
            ]));
            return;
        }
        $userRoom = new UserRoom();
        if ($userRoom->addUserRoom($data) === SysConst::OK) {
            $this->response()->write(json_encode([
                SysConst::CODE => SysConst::SUCCESS
            ]));
        }
        $this->response()->write(json_encode([
            SysConst::CODE => SysConst::ERROR
        ]));
    }

}
