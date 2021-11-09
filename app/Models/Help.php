<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    protected $table = "help";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /**  根据user查看个人发布数据
     */
    public static function wzh_helplook($userid){
        try {
            $data=self::where('userid','=',$userid)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }

    /**  根据user时间与state删除发布的数据
     */
    public static function wzh_helpdelete($userid,$created_at){
        try {
            $data=self::where('userid','=',$userid)->where('created_at','=',$created_at)->delete();
            return $data;
        }
        catch (\Exception $e){
            logError('删除失败',[$e->getMessage()]);
            return false;
        }
    }

    /**  根据数据类型和时间查看个人发布数据求助
     */
    public static function wzh_helpstatelook($userid,$created_at){
        try {
            $data=self::where('userid','=',$userid)->where('created_at','=',$created_at)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据userid和state查询时间
     */
    public static function wzh_helptime($userid,$state){
        try {
            $data=self::select('created_at')->where('userid','=',$userid)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据查询所有求助
     */
    public static function wzh_helpallqiuzhu(){
        try {
            $data=self::get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }

    /**  根据姓名查询求助
     */
    public static function wzh_helpnameqiuzhu($help_name){
        try {
            $data=self::where('help_name','=',$help_name)->get();
            return $data;
        }
        catch (\Exception $e){
            logError('查看失败',[$e->getMessage()]);
            return false;
        }
    }
    /**  根据user时间与删除发布的求助
     */
    public static function wzh_helpdeleteqiuzhu($userid,$created_at){
        try {
            $data=self::where('userid','=',$userid)->where('created_at','=',$created_at)->delete();
            return $data;
        }
        catch (\Exception $e){
            logError('删除失败',[$e->getMessage()]);
            return false;
        }
    }
}
