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

class Users extends  Model
{
    public $timestamps = false;

    protected $table = 'users';


    public static function checkUserInfo($userInfo): string
    {
        if (empty($userInfo['name'])) {
            return 'name can not empty';
        }

        if (empty($userInfo['password'])) {
            return 'password can not empty';
        }

        return SysConst::OK;
    }

    public function addUser(array $userInfo): string
    {
        try {
            $this->user_name = $userInfo['name'];
            $this->password = md5($userInfo['password']);
            $this->save();
        } catch (\Exception $e) {
            Logger::getLog(__CLASS__ . __FUNCTION__)->error($e->getMessage());
            return SysConst::ERROR;
        }

        return SysConst::OK;
    }
}