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

class ChattingRecord extends Model
{
    public $timestamps = false;

    protected $table = 'room_chatting_record';
}