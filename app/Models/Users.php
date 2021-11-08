<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "user";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /**  查看user信息数据
     */
    public static function wzh_userlook(){
        try {
            $data=self::get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  禁用user
     */
    public static function wzh_userclose($userid){
        try {
            $data=self::where('userid','=',$userid)->update(
                [
                    'state' => 1,
                ]
            );
            return $data;
        }
        catch (\Exception $e){
            logError('禁用失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  开放user
     */
    public static function wzh_useropen($userid){
        try {
            $data=self::where('userid','=',$userid)->update(
                [
                    'state' => 0,
                ]
            );
            return $data;
        }
        catch (\Exception $e){
            logError('开放失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  存入user数据库的基本信息
     */
    public static function createin($sys_level,$is_sys,$name,$userid,$deviceId){
        try {
            $data=self::create(
                [
                    'sys_level' => $sys_level,
                    'is_sys' => $is_sys,
                    'user_name' => $name,
                    'userid' => $userid,
                    'deviceld' => $deviceId,
                ]
            );
            return $data;
        }
        catch (\Exception $e){
            logError('开放失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  存入用户头像
     */
    public static function createchart($userid,$user_chart){
        try {
            $data=self::where('userid','=',$userid)->update(
                [
                    'user_chart' => $user_chart,
                ]
            );
            return $data;
        }
        catch (\Exception $e){
            logError('开放失败',[$e->getMessage()]);
            return false;
        }
    }
}
