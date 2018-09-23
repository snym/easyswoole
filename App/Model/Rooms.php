<?php
/**
 * Created by IntelliJ IDEA.
 * Users: qymeng
 * Date: 2018/9/18
 * Time: 0:44
 */

namespace App\Model;


use App\Utility\Logger;
use App\Utility\SysConst;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    public $timestamps = false;

    protected $table = 'rooms';

    public static function checkRoomInfo($roomInfo): string
    {
        if (empty($roomInfo['name'])) {
            return 'name can not empty';
        }

        if (empty($roomInfo['user_id'])) {
            return 'user can not empty';
        }

        return SysConst::OK;
    }

    public function addRoom(array $roomInfo): string
    {
        try {
            $this->room_name = $roomInfo['name'];
            $this->creator_id = $roomInfo['creator_id'];
            $this->save();
        } catch (\Exception $e) {
            Logger::getLog(__CLASS__ . __FUNCTION__)->error($e->getMessage());
            return SysConst::ERROR;
        };

        return SysConst::OK;
    }
}