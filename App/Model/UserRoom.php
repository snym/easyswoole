<?php
/**
 * Created by IntelliJ IDEA.
 * Users: qymeng
 * Date: 2018/9/18
 * Time: 0:44
 */

namespace App\Model;


use App\Utility\SysConst;
use  Illuminate\Database\Eloquent\Model;

class UserRoom extends  Model
{
    public $timestamps = false;

    protected $table = 'user_room';

    public static function checkUserRoomsInfo($userInfo): string
    {
        if (empty($userInfo['user_id'])) {
            return 'user can not empty';
        }

        if (empty($userInfo['room_id'])) {
            return 'room can not empty';
        }

        return SysConst::OK;
    }

    public function addUserRoom(array $userInfo): string
    {
        try {
            $user = new Users();
            $user->user_name = $userInfo['name'];
            $user->password = md5($userInfo['password']);
            $user->save();
        } catch (\Exception $e) {
            Logger::getLog(__CLASS__ . __FUNCTION__)->error($e->getMessage());
            return SysConst::ERROR;
        }

        return SysConst::OK;
    }
}